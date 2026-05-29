<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Level;
use App\Models\LevelDetail;
use Auth;
use Session;
use Hash;
use File;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    

    public function index()
    {		      

        $data = array(
            'title' => 'Master',                       
			'subtitle' => 'Level User',
			'header' => 'Level User Kadin Jatim',
            'btnAdd' => 'Tambah Level User',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('level.index', compact('data'));                
    }
	
	public function detail(Request $request, $id)
    {		      

        $data = array(
            'title' => 'Master',                       
			'subtitle' => 'Level User',
			'header' => 'Level User Kadin Jatim',
            'btnAdd' => 'Tambah Level User',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped',
			'id' => $id
        );         
        
        return view('level.detail', compact('data'));                
    }

    public function getData()
    {
		
        $level = Level::get();        
        if($level) {
            return response()->json([
                'status'=>'oke',
                'data' => $level
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }

    }
    
	 public function getDataDetail(Request $request, $id)
    {
			
		$level = DB::select (
			DB::raw('
				select b.*, a.*, c.submenu_nama as menu_nama 
				from submenu as b 
				left join level_menu_det as a on b.submenu_id = a.id_submenu and a.id_level = '.base64_decode($id).'
				left join submenu as c on b.submenu_parent = c.submenu_id 
				where b.submenu_status = "y" 
				and b.submenu_link is not null 
				order by c.submenu_id asc, b.submenu_order asc
			')
		);
		
        if($level) {
            return response()->json([
                'status'=>'oke',
                'data' => $level
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }

    }
	
    public function add()
    {		
		
        $data = array(
            'title' => 'Master',                       
			'act' => 'add',
			'subtitle' => 'Tambah Level User',                       
            'btnAdd' => 'Tambah',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('level.add', compact('data'));
    }
	
	
	public function edit(Request $request, $id)
    {				
        $data = array(
            'title' => 'Master',                       
			'act' => 'edit',
			'subtitle' => 'Edit Level User',                       
            'btnAdd' => 'Edit',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
		$level = Level::where('level_id','=',base64_decode($id))->get();		
        return view('level.add', compact('data','level'));                		
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
					
				$insert = Level::create([					
					"level_nama"=> $request->nama_level,
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
	
	public function saveMenu(Request $request, $idSubmenu, $status)
    {
        if($request->ajax()){            
						
            DB::beginTransaction();
            try {
				$id = explode("-",base64_decode($idSubmenu));
				$id_submenu = $id[0];
				$id_level = $id[1];
				
				$insert = LevelDetail::create([					
					"id_submenu"=> $id_submenu,
					"id_level"=> $id_level,
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
	
	public function update(Request $request, $id)
    {
        if($request->ajax()){            
						
            DB::beginTransaction();
            try {				
										
				$updatex = Level::where('level_id', '=', decrypt($id))->update([              
					"level_nama"=> $request->nama_level					
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

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            $query = Level::find($id)->delete();
            if($query) {
                return response()->json(['status'=>'delete_successful']);
            } else {
                return response()->json(['status'=>'delete_failed']);
            }
        } else {
            return response()->json(['status'=>'delete_failed']);
        }
    }   

	public function deleteMenu(Request $request, $id)
    {
        if($request->ajax()){
            $query = LevelDetail::find(base64_decode($id))->delete();
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
