<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Investasi;
use App\Models\Kategori;
use Auth;
use Session;
use Hash;
use File;

class InvestasiController extends Controller
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
			'subtitle' => 'Investasi',
			'header' => 'Investasi Kadin Jatim',			
            'btnAdd' => 'Tambah Investasi',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('investasi.index', compact('data'));                		
    }

    public function getData()
    {
		        
		$investasi =DB::table('investasi as a')
                ->join('berita_kategori as b','a.id_kategori', '=', 'b.kategori_id')                
                ->select('*')				
				->orderBy('investasi_id','DESC')					
                ->get();
        if($investasi) {
            return response()->json([
                'status'=>'oke',
                'data' => $investasi
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
			'subtitle' => 'Tambah Investasi',                       
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
        return view('investasi.add', compact('data','kategori'));
    }
	
	public function edit(Request $request, $id)
    {				
        $data = array(
            'title' => 'Proses',                       
			'act' => 'edit',
			'subtitle' => 'Edit Investasi',                       
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
		$investasi = Investasi::where('investasi_id','=',base64_decode($id))->get();		
        return view('investasi.add', compact('data','investasi','kategori'));                		
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
					
					// membuat nama file unik image
					$ext = $request->file('file')->getClientOriginalExtension();
					$nama_file = date("YmdHis");
					$nama_file_ori = $request->file('file')->getClientOriginalName();			
					$path = "frontend/assets_4/images/investasi/";
					
					// membuat nama file unik audio
					$ext_audio = $request->file('audio_file')->getClientOriginalExtension();
					$nama_file_audio = "audio_".date("YmdHis");
					$nama_file_ori_audio = $request->file('audio_file')->getClientOriginalName();			
					
					
					$request->file('file')-> move($path, $nama_file);
					$request->file('audio_file')-> move($path, $nama_file_audio);
					
					$insert = Investasi::create([
						"investasi_judul"=> $request->investasi_judul,
						"investasi_isi"=> $request->investasi_isi,
						"investasi_create_who"=> Session::get('user'),				
						"investasi_create_when"=> date("Y-m-d H:i:s"),
						"investasi_create_ip"=> $request->ip(),
						"investasi_tanggal"=> date('Y-m-d', strtotime($request->investasi_tanggal)), 
						"investasi_publish"=> "y",
						"investasi_gambar_name"=> $nama_file,
						"investasi_gambar_ori"=> $nama_file_ori,
						"investasi_path"=> $path,
						"investasi_exe"=> $ext,						
						"id_kategori"=> $request->kategori_id,
						"investasi_audio_name"=> $nama_file_audio,
						"investasi_audio_ori"=> $nama_file_ori_audio,
						"investasi_audio_exe"=> $ext_audio,					
					]);

					if($insert) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					$insert = Investasi::create([
						"investasi_judul"=> $request->investasi_judul,
						"investasi_isi"=> $request->investasi_isi,
						"investasi_create_who"=> Session::get('user'),				
						"investasi_create_when"=> date("Y-m-d H:i:s"),
						"investasi_create_ip"=> $request->ip(),
						"investasi_tanggal"=> date('Y-m-d', strtotime($request->investasi_tanggal)), 
						"investasi_publish"=> "y",
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
					$path = "frontend/assets_4/images/investasi/";
					
					$request->file('file')-> move($path, $nama_file);
					$updatex = Investasi::where('investasi_id', '=', decrypt($id))->update([              
						"investasi_judul"=> $request->investasi_judul,
						"investasi_isi"=> $request->investasi_isi,
						"investasi_update_who"=> Session::get('user'),				
						"investasi_update_when"=> date("Y-m-d H:i:s"),
						"investasi_update_ip"=> $request->ip(),
						"investasi_tanggal"=> date('Y-m-d', strtotime($request->investasi_tanggal)), 
						"investasi_publish"=> $request->investasi_publish,
						"investasi_gambar_name"=> $nama_file,
						"investasi_gambar_ori"=> $nama_file_ori,
						"investasi_path"=> $path,						
						"investasi_exe"=> $ext                                                
					]);

					if($updatex) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					
					$updatex = Investasi::where('investasi_id', '=', decrypt($id))->update([              
						"investasi_judul"=> $request->investasi_judul,
						"investasi_isi"=> $request->investasi_isi,
						"investasi_update_who"=> Session::get('user'),				
						"investasi_update_when"=> date("Y-m-d H:i:s"),
						"investasi_update_ip"=> $request->ip(),
						"investasi_tanggal"=> date('Y-m-d', strtotime($request->investasi_tanggal)), 
						"investasi_publish"=> $request->investasi_publish,						
						                                               
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
														
				$updatex = Investasi::where('investasi_id', '=', $id)->update([              								
					"investasi_publish"=> $status,
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
            $query = Investasi::find($id)->delete();
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
