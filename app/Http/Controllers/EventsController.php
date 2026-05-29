<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Agenda;
use App\Models\AgendaPeserta;
use Auth;
use Session;
use Hash;
use File;

class EventsController extends Controller
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
			'subtitle' => 'Event',                       
			'header' => 'Agenda Kadin Jatim',			
            'btnAdd' => 'Tambah Event',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('agenda.index', compact('data'));                		
    }
	
	public function info(Request $request, $id)
    {		      

        $data = array(
            'title' => 'Proses',                       
			'subtitle' => 'Event',                       
			'header' => 'Info Peserta Agenda Kadin Jatim',			
            'btnAdd' => 'Tambah Event',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped',
			'idAgenda' => $id
        );         
        
        return view('agenda.info', compact('data'));                		
    }

    public function getData()
    {
		
        $agenda = Agenda::orderBy('agenda_id', 'DESC')->get();        
        if($agenda) {
            return response()->json([
                'status'=>'oke',
                'data' => $agenda
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }

    }
	
	public function getDataPeserta(Request $request, $id)
    {
		
        $agendaPeserta = AgendaPeserta::where('id_agenda','=',base64_decode($id))->get();        
        if($agendaPeserta) {
            return response()->json([
                'status'=>'oke',
                'data' => $agendaPeserta
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
			'subtitle' => 'Tambah Event',                       
            'btnAdd' => 'Tambah',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
        return view('agenda.add', compact('data'));
    }
	
	public function edit(Request $request, $id)
    {				
        $data = array(
            'title' => 'Proses',                       
			'act' => 'edit',
			'subtitle' => 'Edit Event',                       
            'btnAdd' => 'Edit',			
            'btnClass' => 'btn btn-primary btn-sm px-4',
			'btnClassBack' => 'btn btn-inverse btn-sm px-4',
			'btnClassSuccess' => 'btn btn-success btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',            
            'classTable' => 'table table-sm table-striped'
        );         
        
		$agenda = Agenda::where('agenda_id','=',base64_decode($id))->get();		
        return view('agenda.add', compact('data','agenda'));                		
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
					$path = "frontend/assets_4/images/agenda/";
					
					$request->file('file')-> move($path, $nama_file);
					$insert = Agenda::create([
						"agenda_judul"=> $request->agenda_judul,
						"agenda_tempat"=> $request->agenda_tempat,
						"agenda_waktu"=> $request->agenda_waktu,
						"agenda_isi"=> $request->agenda_isi,
						"instansi"=> $request->instansi,
						"agenda_create_who"=> Session::get('user'),				
						"agenda_create_when"=> date("Y-m-d H:i:s"),
						"agenda_create_ip"=> $request->ip(),
						"agenda_tanggal"=> date('Y-m-d', strtotime($request->agenda_tanggal)), 
						"agenda_publish"=> "y",
						"agenda_gambar_name"=> $nama_file,
						"agenda_gambar_name_ori"=> $nama_file_ori,
						"agenda_path"=> $path,
						"agenda_exe"=> $ext
					]);

					if($insert) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					$insert = Agenda::create([
						"agenda_judul"=> $request->agenda_judul,
						"agenda_tempat"=> $request->agenda_tempat,
						"agenda_waktu"=> $request->agenda_waktu,
						"agenda_isi"=> $request->agenda_isi,
						"instansi"=> $request->instansi,
						"agenda_create_who"=> Session::get('user'),				
						"agenda_create_when"=> date("Y-m-d H:i:s"),
						"agenda_create_ip"=> $request->ip(),
						"agenda_tanggal"=> date('Y-m-d', strtotime($request->agenda_tanggal)), 
						"agenda_publish"=> $request->agenda_publish						
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
					$path = "frontend/assets_4/images/agenda/";
					
					$request->file('file')-> move($path, $nama_file);
					$updatex = Agenda::where('agenda_id', '=', decrypt($id))->update([              
						"agenda_judul"=> $request->agenda_judul,
						"agenda_isi"=> $request->agenda_isi,
						"agenda_update_who"=> Session::get('user'),				
						"agenda_update_when"=> date("Y-m-d H:i:s"),
						"agenda_update_ip"=> $request->ip(),
						"instansi"=> $request->instansi,
						"agenda_waktu"=> $request->agenda_waktu,
						"agenda_tanggal"=> date('Y-m-d', strtotime($request->agenda_tanggal)), 
						"agenda_publish"=> $request->agenda_publish,
						"agenda_gambar_name"=> $nama_file,
						"agenda_gambar_name_ori"=> $nama_file_ori,
						"agenda_path"=> $path,
						"agenda_exe"=> $ext                                                
					]);

					if($updatex) {
						DB::commit();             
						return response()->json(['status'=>'insert_successful','msg'=>'Data Berhasil Ditambahkan']);                    
					} else {
						return response()->json(['status'=>'insert_failed','msg'=>'Data Gagal Ditambahkan']);
					}
				} else {
					
					$updatex = Agenda::where('agenda_id', '=', decrypt($id))->update([              
						"agenda_judul"=> $request->agenda_judul,
						"agenda_isi"=> $request->agenda_isi,
						"instansi"=> $request->instansi,
						"agenda_waktu"=> $request->agenda_waktu,
						"agenda_update_who"=> Session::get('user'),				
						"agenda_update_when"=> date("Y-m-d H:i:s"),
						"agenda_update_ip"=> $request->ip(),
						"agenda_tanggal"=> date('Y-m-d', strtotime($request->agenda_tanggal)), 
						"agenda_publish"=> $request->agenda_publish,
						                                               
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
														
				$updatex = Agenda::where('agenda_id', '=', $id)->update([              								
					"agenda_publish"=> $status,
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
            $query = Agenda::find($id)->delete();
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
