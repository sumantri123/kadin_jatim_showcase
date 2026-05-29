<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\ProfilKadin;
use Auth;
use Session;
use Hash;
use File;

class ProfilKadinController extends Controller
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
			'subtitle' => 'Profil Kadin', 
			'header' => 'Profil Kadin Jatim',						
            'btnAdd' => 'Tambah Profil',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('profil_kadin.index', compact('data'));                		
    }

    public function getData()
    {
		
        $profilKadin = ProfilKadin::get();        
        if($profilKadin) {
            return response()->json([
                'status'=>'oke',
                'data' => $profilKadin
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
			'subtitle' => 'Tambah Profil',                       
            'btnAdd' => 'Tambah',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('profil_kadin.add', compact('data'));
    }
	
	public function edit(Request $request, $id)
    {				
        $data = array(
            'title' => 'Proses',                       
			'act' => 'edit',
			'subtitle' => 'Edit Profil Kadin',                       
            'btnAdd' => 'Edit',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
		$profilKadin = ProfilKadin::where('id','=',base64_decode($id))->get();		
        return view('profil_kadin.add', compact('data','profilKadin'));                		
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
					$nama_header = "header_".date("YmdHis");
					$nama_file_ori = $request->file('file')->getClientOriginalName();	
					$size = $request->file('file')->getSize();											
					$path = "frontend/assets_4/images/profil_kadin/";
					
					$request->file('file')-> move($path, $nama_file);
					$request->file('filex')-> move($path, $nama_header);
					
					$insert = ProfilKadin::create([
						"sejarah_singkat"=> $request->sejarah_singkat,
						"visi"=> $request->visi,
						"misi"=> $request->misi,
						"arti_logo"=> $request->arti_logo,
						"alamat"=> $request->alamat,
						"update_who"=> Session::get('user'),				
						"update_when"=> date("Y-m-d H:i:s"),
						"profil_logo_name"=> $nama_file,
						"profil_header_name"=> $nama_header,
						"profil_logo_name_ori"=> $nama_file_ori,
						"profil_path"=> $path,
						"profil_exe"=> $ext,
						"profil_size"=> $size
					]);

					if($insert) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					$insert = ProfilKadin::create([
						"sejarah_singkat"=> $request->sejarah_singkat,
						"visi"=> $request->visi,
						"misi"=> $request->misi,
						"arti_logo"=> $request->arti_logo,
						"alamat"=> $request->alamat,
						"update_who"=> Session::get('user'),				
						"update_when"=> date("Y-m-d H:i:s"),
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
					$nama_header = "header_".date("YmdHis");
					$nama_file_ori = $request->file('file')->getClientOriginalName();			
					$size = $request->file('file')->getSize();											
					$path = "frontend/assets_4/images/profil_kadin/";
					
					$request->file('file')-> move($path, $nama_file);
					$request->file('filex')-> move($path, $nama_header);
					
					$updatex = ProfilKadin::where('id', '=', decrypt($id))->update([              
						"sejarah_singkat"=> $request->sejarah_singkat,
						"visi"=> $request->visi,
						"misi"=> $request->misi,
						"arti_logo"=> $request->arti_logo,
						"alamat"=> $request->alamat,
						"update_who"=> Session::get('user'),				
						"update_when"=> date("Y-m-d H:i:s"),
						"profil_logo_name"=> $nama_file,
						"profil_logo_name_ori"=> $nama_file_ori,
						"profil_header_name"=> $nama_header,
						"profil_path"=> $path,
						"profil_exe"=> $ext,
						"profil_size"=> $size
					]);

					if($updatex) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					
					$updatex = ProfilKadin::where('id', '=', decrypt($id))->update([              
						"sejarah_singkat"=> $request->sejarah_singkat,
						"visi"=> $request->visi,
						"misi"=> $request->misi,
						"arti_logo"=> $request->arti_logo,
						"alamat"=> $request->alamat,
						"update_who"=> Session::get('user'),				
						"update_when"=> date("Y-m-d H:i:s"),
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

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            $query = ProfilKadin::find($id)->delete();
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
