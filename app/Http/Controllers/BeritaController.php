<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Berita;
use App\Models\Kategori;
use Auth;
use Session;
use Hash;
use File;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    

    public function index()
    {		      

        $data = array(
            'title' => 'Proses',                       
			'subtitle' => 'Berita',
			'header' => 'Berita Kadin Jatim',			
            'btnAdd' => 'Tambah Berita',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('berita.index', compact('data'));                
		/* $returnHTML = view('berita/index',compact('data'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) ); */
    }

    public function getData()
    {
		        
		$berita =DB::table('berita as a')
                ->join('berita_kategori as b','a.id_kategori', '=', 'b.kategori_id')                
                ->select('*')				
				->orderBy('berita_id','DESC')					
                ->get();
        if($berita) {
            return response()->json([
                'status'=>'oke',
                'data' => $berita
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }

    }
    
    public function add()
    {		
		
        $data = array(
            'title' => 'Proses',                       
			'act' => 'add',
			'subtitle' => 'Tambah Berita',                       
            'btnAdd' => 'Tambah',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        $kategori = Kategori::where('kategori_status','=','y')->get();
        return view('berita.add', compact('data','kategori'));
    }
	
	public function edit(Request $request, $id)
    {				
        $data = array(
            'title' => 'Proses',                       
			'act' => 'edit',
			'subtitle' => 'Edit Berita',                       
            'btnAdd' => 'Edit',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );        
		
        $kategori = Kategori::where('kategori_status','=','y')->get();
		$berita = Berita::where('berita_id','=',base64_decode($id))->get();		
        return view('berita.add', compact('data','berita','kategori'));                		
    }

    private function validateRequest($request, $id=0){

        $messages = [
            'required' => 'Kolom <b>:attribute</b> harus diisi.',
            'min' => 'Panjang minimal <b>:attribute</b> huruf.',
            'numeric' => 'Inputan harus angka.',
            'unique' => 'Data <b>:attribute</b> ":input" sudah ada, tidak boleh sama.',
        ];

        return Validator::make($request->all(), [
//            "nomor_rekening" => "required|unique:t_rekening_nasabah,nomor_rekening".($id ? ",".$id.",id" : "" ),            
        ], $messages);
    }

    public function store(Request $request)
    {
        if($request->ajax()){            
						
            DB::beginTransaction();
            try {
				
				if($request->file('file')){				
					
					// membuat nama file unik
					$ext = $request->file('file')->getClientOriginalExtension();
					$nama_file = date("YmdHis");
					$nama_file_ori = $request->file('file')->getClientOriginalName();			
					$path = "frontend/assets_4/images/berita/";
					
					$request->file('file')-> move($path, $nama_file);
					$insert = Berita::create([
						"berita_judul"=> $request->berita_judul,
						"berita_isi"=> $request->berita_isi,
						"berita_create_who"=> Session::get('user'),				
						"berita_create_when"=> date("Y-m-d H:i:s"),
						"berita_create_ip"=> $request->ip(),
						"berita_tanggal"=> date('Y-m-d', strtotime($request->berita_tanggal)), 
						"berita_publish"=> "y",
						"berita_gambar_name"=> $nama_file,
						"berita_gambar_name_ori"=> $nama_file_ori,
						"berita_path"=> $path,
						"berita_exe"=> $ext,
						"berita_sumber"=> $request->sumber,
						"id_kategori"=> $request->kategori_id
					]);

					if($insert) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					$insert = Berita::create([
						"berita_judul"=> $request->berita_judul,
						"berita_isi"=> $request->berita_isi,
						"berita_create_who"=> Session::get('user'),				
						"berita_create_when"=> date("Y-m-d H:i:s"),
						"berita_create_ip"=> $request->ip(),
						"berita_tanggal"=> date('Y-m-d', strtotime($request->berita_tanggal)), 
						"berita_publish"=> $request->berita_publish						
					]);
					
					if($insert) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				}
                
            } catch (\Throwable $e) {
                DB::rollback();            
                throw $e;            
                return response()->json(['status'=>'insert_failed']);
            }
			
        } else {
            return redirect('asset/');
        }

    }
	
	public function update(Request $request, $id)
    {
        if($request->ajax()){            
						
            DB::beginTransaction();
            try {
				if($request->file('file')){
					
					// membuat nama file unik
					$ext = $request->file('file')->getClientOriginalExtension();
					$nama_file = date("YmdHis");
					$nama_file_ori = $request->file('file')->getClientOriginalName();			
					$path = "frontend/assets_4/images/berita/";
					
					$request->file('file')-> move($path, $nama_file);
					$updatex = Berita::where('berita_id', '=', decrypt($id))->update([              
						"berita_judul"=> $request->berita_judul,
						"berita_isi"=> $request->berita_isi,
						"berita_update_who"=> Session::get('user'),				
						"berita_update_when"=> date("Y-m-d H:i:s"),
						"berita_update_ip"=> $request->ip(),
						"berita_tanggal"=> date('Y-m-d', strtotime($request->berita_tanggal)), 
						"berita_publish"=> $request->berita_publish,
						"berita_gambar_name"=> $nama_file,
						"berita_gambar_name_ori"=> $nama_file_ori,
						"berita_path"=> $path,
						"berita_sumber"=> $request->sumber,
						"berita_exe"=> $ext                                                
					]);

					if($updatex) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					
					$updatex = Berita::where('berita_id', '=', decrypt($id))->update([              
						"berita_judul"=> $request->berita_judul,
						"berita_isi"=> $request->berita_isi,
						"berita_update_who"=> Session::get('user'),				
						"berita_update_when"=> date("Y-m-d H:i:s"),
						"berita_update_ip"=> $request->ip(),
						"berita_tanggal"=> date('Y-m-d', strtotime($request->berita_tanggal)), 
						"berita_publish"=> $request->berita_publish,
						"berita_sumber"=> $request->sumber,
						                                               
					]);
					
					if($updatex) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				}
                
            } catch (\Throwable $e) {
                DB::rollback();            
                throw $e;            
                return response()->json(['status'=>'insert_failed']);
            }
			
        } else {
            return redirect('asset/');
        }

    }
	
	public function updateStatus(Request $request, $id, $status)
    {
        if($request->ajax()){            
						
            DB::beginTransaction();
            try {
														
				$updatex = Berita::where('berita_id', '=', $id)->update([              								
					"berita_publish"=> $status,
				]);

				if($updatex) {
					DB::commit();     
					$msg = ($status == 'y') ? "Berhasil Di Publish":"Berhasil Di Non Publish";
					return response()->json(['status'=>'insert_successful','msg'=>$msg]);                    
				} else {
					return response()->json(['status'=>'insert_failed','msg'=>'Status Publish Gagal Dirubah']);
				}				
                
            } catch (\Throwable $e) {
                DB::rollback();            
                throw $e;            
                return response()->json(['status'=>'insert_failed']);
            }
			
        } else {
            return redirect('asset/');
        }

    }
	
    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            $query = Berita::find($id)->delete();
            if($query) {
                return response()->json(['status'=>'delete_successful']);
            } else {
                return response()->json(['status'=>'delete_failed']);
            }
        } else {
            return response()->json(['status'=>'delete_failed']);
        }
    }

    
}
