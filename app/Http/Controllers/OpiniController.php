<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Opini;
use Auth;
use Session;
use Hash;
use File;

class OpiniController extends Controller
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
			'subtitle' => 'Opini',
			'header' => 'Opini Kadin Jatim',			
            'btnAdd' => 'Tambah Opini',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('opini.index', compact('data'));                
		/* $returnHTML = view('opini/index',compact('data'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) ); */
    }

    public function getData()
    {
		
        $opini = Opini::orderBy('opini_id','DESC')->get();
        if($opini) {
            return response()->json([
                'status'=>'oke',
                'data' => $opini
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
			'subtitle' => 'Tambah Opini',                       
            'btnAdd' => 'Tambah',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('opini.add', compact('data'));
    }
	
	public function edit(Request $request, $id)
    {				
        $data = array(
            'title' => 'Proses',                       
			'act' => 'edit',
			'subtitle' => 'Edit Opini',                       
            'btnAdd' => 'Edit',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
		$opini = Opini::where('opini_id','=',base64_decode($id))->get();		
        return view('opini.add', compact('data','opini'));                		
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
					$path = "frontend/assets_4/images/opini/";
					
					$request->file('file')-> move($path, $nama_file);
					$insert = Opini::create([
						"opini_judul"=> $request->opini_judul,
						"opini_isi"=> $request->opini_isi,
						"opini_create_who"=> Session::get('user'),				
						"opini_create_when"=> date("Y-m-d H:i:s"),
						"opini_create_ip"=> $request->ip(),
						"opini_tanggal"=> date('Y-m-d', strtotime($request->opini_tanggal)), 
						"opini_publish"=> "y",
						"opini_gambar_name"=> $nama_file,
						"opini_gambar_name_ori"=> $nama_file_ori,
						"opini_path"=> $path,
						"opini_exe"=> $ext
					]);

					if($insert) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					$insert = Opini::create([
						"opini_judul"=> $request->opini_judul,
						"opini_isi"=> $request->opini_isi,
						"opini_create_who"=> Session::get('user'),				
						"opini_create_when"=> date("Y-m-d H:i:s"),
						"opini_create_ip"=> $request->ip(),
						"opini_tanggal"=> date('Y-m-d', strtotime($request->opini_tanggal)), 
						"opini_publish"=> $request->opini_publish						
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
					$path = "frontend/assets_4/images/opini/";
					
					$request->file('file')-> move($path, $nama_file);
					$updatex = Opini::where('opini_id', '=', decrypt($id))->update([              
						"opini_judul"=> $request->opini_judul,
						"opini_isi"=> $request->opini_isi,
						"opini_update_who"=> Session::get('user'),				
						"opini_update_when"=> date("Y-m-d H:i:s"),
						"opini_update_ip"=> $request->ip(),
						"opini_tanggal"=> date('Y-m-d', strtotime($request->opini_tanggal)), 
						"opini_publish"=> $request->opini_publish,
						"opini_gambar_name"=> $nama_file,
						"opini_gambar_name_ori"=> $nama_file_ori,
						"opini_path"=> $path,
						"opini_exe"=> $ext                                                
					]);

					if($updatex) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					
					$updatex = Opini::where('opini_id', '=', decrypt($id))->update([              
						"opini_judul"=> $request->opini_judul,
						"opini_isi"=> $request->opini_isi,
						"opini_update_who"=> Session::get('user'),				
						"opini_update_when"=> date("Y-m-d H:i:s"),
						"opini_update_ip"=> $request->ip(),
						"opini_tanggal"=> date('Y-m-d', strtotime($request->opini_tanggal)), 
						"opini_publish"=> $request->opini_publish,
						                                               
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
														
				$updatex = Opini::where('opini_id', '=', $id)->update([              								
					"opini_publish"=> $status,
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
            $query = Opini::find($id)->delete();
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
