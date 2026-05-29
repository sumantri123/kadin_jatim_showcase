<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Gambar;
use App\Models\GambarKategori;
use Auth;
use Session;
use Hash;
use File;

class GambarController extends Controller
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
			'subtitle' => 'Gallery', 
			'header' => 'Gallery Kadin Jatim',						
            'btnAdd' => 'Tambah Gambar',
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('kategori_gambar.index', compact('data'));                		
    }
	
	public function detGallery(Request $request, $id)
    {		      

        $data = array(
            'title' => 'Proses',                       
			'subtitle' => 'Gallery', 
			'header' => 'Gallery Kadin Jatim',						
            'btnAdd' => 'Tambah Gambar',
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped',
			'id' => $id
        );         
        
        return view('gallery.index', compact('data'));                		
    }

    public function getData(Request $request, $id)
    {
		
        $gambar = Gambar::where('id_kategori_gambar','=',base64_decode($id))->get();        
        if($gambar) {
            return response()->json([
                'status'=>'oke',
                'data' => $gambar
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }

    }
	
	public function getDataKat()
    {
		
        $gambar_kat = GambarKategori::orderBy('gambar_kategori_tanggal','DESC')->get();        
        if($gambar_kat) {
            return response()->json([
                'status'=>'oke',
                'data' => $gambar_kat
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }

    }
    
    public function add(Request $request, $id)
    {		
		
        $data = array(
            'title' => 'Proses',                       
			'act' => 'add',
			'subtitle' => 'Tambah Gambar',                       
            'btnAdd' => 'Tambah',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped',
			'id_kat' => $id // id Kategori
        );         
        
        return view('gallery.add', compact('data'));
    }
	
	public function edit(Request $request, $id)
    {				
        $data = array(
            'title' => 'Proses',                       
			'act' => 'edit',
			'subtitle' => 'Edit Gambar',                       
            'btnAdd' => 'Edit',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
		$gambar = Gambar::where('gambar_id','=',base64_decode($id))->get();		
        return view('gallery.add', compact('data','gambar'));                		
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
	
	public function save_kat(Request $request)
    {
        if($request->ajax()){            
						
            DB::beginTransaction();
            try {
					
				$insert = GambarKategori::create([
					"gambar_kategori_keterangan"=> $request->keterangan,
					"gambar_kategori_tanggal"=> date('Y-m-d', strtotime($request->tanggal)), 
					"gambar_kategori_status"=> 'y'							
				]);

				if($insert) {
					DB::commit();             
					return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
				} else {
					return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
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
					$path = "frontend/assets_4/images/gallery/";
					
					$request->file('file')-> move($path, $nama_file);
					$insert = Gambar::create([						
						"gambar_create_who"=> Session::get('user'),				
						"gambar_create_when"=> date("Y-m-d H:i:s"),
						"gambar_create_ip"=> $request->ip(),						
						"gambar_publish"=> "y",
						"gambar_name"=> $nama_file,
						"gambar_name_ori"=> $nama_file_ori,
						"gambar_path"=> $path,
						"gambar_exe"=> $ext,
						"id_kategori_gambar"=> base64_decode($request->id_kat)
					]);

					if($insert) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					$insert = Gambar::create([						
						"gambar_create_who"=> Session::get('user'),				
						"gambar_create_when"=> date("Y-m-d H:i:s"),
						"gambar_create_ip"=> $request->ip(),						
						"gambar_publish"=> $request->gambar_publish						
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
	
	public function update_kat(Request $request, $id)
    {
        if($request->ajax()){            
						
            DB::beginTransaction();
            try {				
										
				$updatex = GambarKategori::where('gambar_kategori_id', '=', base64_decode($id))->update([              
					"gambar_kategori_keterangan"=> $request->keterangan,
					"gambar_kategori_tanggal"=> date('Y-m-d', strtotime($request->tanggal)), 
				]);

				if($updatex) {
					DB::commit();             
					return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
				} else {
					return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
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
					$path = "frontend/assets_4/images/gallery/";
					
					$request->file('file')-> move($path, $nama_file);
					$updatex = Gambar::where('gambar_id', '=', decrypt($id))->update([              						
						"gambar_create_who"=> Session::get('user'),				
						"gambar_create_when"=> date("Y-m-d H:i:s"),
						"gambar_create_ip"=> $request->ip(),						
						"gambar_publish"=> $request->gambar_publish,
						"gambar_name"=> $nama_file,
						"gambar_name_ori"=> $nama_file_ori,
						"gambar_path"=> $path,
						"gambar_exe"=> $ext,
						"id_kategori_gambar"=> base64_decode($request->id_kat)						
					]);

					if($updatex) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					
					$updatex = Gambar::where('gambar_id', '=', decrypt($id))->update([              						
						"gambar_create_who"=> Session::get('user'),				
						"gambar_create_when"=> date("Y-m-d H:i:s"),
						"gambar_create_ip"=> $request->ip(),						
						"gambar_publish"=> $request->gambar_publish,
						"id_kategori_gambar"=> base64_decode($request->id_kat)                                               
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
														
				$updatex = Gambar::where('gambar_id', '=', $id)->update([              								
					"gambar_publish"=> $status,
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
	
	public function updateStatusKat(Request $request, $id, $status)
    {
        if($request->ajax()){            
						
            DB::beginTransaction();
            try {
														
				$updatex = GambarKategori::where('gambar_kategori_id', '=', $id)->update([              								
					"gambar_kategori_status"=> $status,
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
            $query = Gambar::find($id)->delete();
            if($query) {
                return response()->json(['status'=>'delete_successful']);
            } else {
                return response()->json(['status'=>'delete_failed']);
            }
        } else {
            return response()->json(['status'=>'delete_failed']);
        }
    }
	
	public function delete_kat(Request $request, $id)
    {
        if($request->ajax()){
            $query = GambarKategori::find($id)->delete();
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
