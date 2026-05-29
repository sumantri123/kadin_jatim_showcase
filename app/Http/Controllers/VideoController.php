<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Video;
use Auth;
use Session;
use Hash;
use File;

class VideoController extends Controller
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
			'subtitle' => 'Video',
			'header' => 'Video Kadin Jatim',
            'btnAdd' => 'Tambah Video',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('video.index', compact('data'));                
		/* $returnHTML = view('berita/index',compact('data'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) ); */
    }

    public function getData()
    {
		
        $video = Video::get();        
        if($video) {
            return response()->json([
                'status'=>'oke',
                'data' => $video
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
			'subtitle' => 'Tambah Video',                       
            'btnAdd' => 'Tambah',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('video.add', compact('data'));
    }
	
	public function edit(Request $request, $id)
    {				
        $data = array(
            'title' => 'Proses',                       
			'act' => 'edit',
			'subtitle' => 'Edit Video',                       
            'btnAdd' => 'Edit',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
		$video = Video::where('video_id','=',base64_decode($id))->get();		
        return view('video.add', compact('data','video'));                		
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
					$size = $request->file('file')->getSize();						
					$path = "frontend/assets_4/images/video/";
					
					$request->file('file')-> move($path, $nama_file);
					$insert = Video::create([
						"video_deskripsi"=> $request->deskripsi,						
						"video_link"=> $request->video_link,						
						"video_create_who"=> Session::get('user'),				
						"video_create_when"=> date("Y-m-d H:i:s"),
						"video_create_ip"=> $request->ip(),						
						"video_publish"=> "y",
						"video_name"=> $nama_file,
						"video_name_ori"=> $nama_file_ori,
						"video_path"=> $path,
						"video_size"=> $size,
						"video_exe"=> $ext
					]);

					if($insert) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					$insert = Video::create([
						"video_deskripsi"=> $request->deskripsi,
						"video_link"=> $request->video_link,
						"video_create_who"=> Session::get('user'),				
						"video_create_when"=> date("Y-m-d H:i:s"),
						"video_create_ip"=> $request->ip(),						
						"video_publish"=> $request->video_publish						
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
					$size = $request->file('file')->getSize();			
					$path = "frontend/assets_4/images/video/";
					
					$request->file('file')-> move($path, $nama_file);
					$updatex = Video::where('video_id', '=', decrypt($id))->update([              
						"video_deskripsi"=> $request->deskripsi,	
						"video_link"=> $request->video_link,						
						"video_update_who"=> Session::get('user'),				
						"video_update_when"=> date("Y-m-d H:i:s"),
						"video_update_ip"=> $request->ip(),						
						"video_publish"=> $request->video_publish,
						"video_name"=> $nama_file,
						"video_name_ori"=> $nama_file_ori,
						"video_path"=> $path,
						"video_size"=> $size,
						"video_exe"=> $ext                                                
					]);

					if($updatex) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					
					$updatex = Video::where('video_id', '=', decrypt($id))->update([              
						"video_deskripsi"=> $request->deskripsi,
						"video_link"=> $request->video_link,						
						"video_update_who"=> Session::get('user'),				
						"video_update_when"=> date("Y-m-d H:i:s"),
						"video_update_ip"=> $request->ip(),						
						"video_publish"=> $request->video_publish,
						                                               
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
														
				$updatex = Video::where('video_id', '=', $id)->update([              								
					"video_publish"=> $status,
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
            $query = Video::find($id)->delete();
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
