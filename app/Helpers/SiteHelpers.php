<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Crypt;
use Session;
use DB;

class SiteHelpers
{
	public static function main_menu(){
				
		/* $main_menu = DB::table('level_menu_det as a')
        ->join('submenu as b', 'a.id_submenu', '=', 'b.submenu_id')        
		->join('menu as c', 'b.id_menu', '=', 'c.menu_id')        
        ->select('menu_nama','menu_id','menu_icon')
		->where('a.id_level', '=', Session::get('levelId'))
		->where('b.submenu_status', '=', 'y')
		->where('c.menu_status', '=', 'y')
		->groupBy('menu_nama','menu_id','menu_icon')
		->orderBy('menu_order','asc')
        ->get(); */
		
		$main_menu = DB::table('submenu as a')        
		->join('level_menu_det as b', 'a.submenu_id', '=', 'b.id_submenu')        
		->join('submenu as c', 'a.submenu_parent', '=', 'c.submenu_id')        
        ->select('c.submenu_nama','a.submenu_parent','c.submenu_link','c.submenu_icon')		
		->where('a.submenu_status', '=', 'y')				
		->where('b.id_level', '=', Session::get('levelId'))	
		->groupBy('c.submenu_nama','a.submenu_parent','c.submenu_link','c.submenu_icon')
		->orderBy('c.submenu_order','asc')
        ->get();
 		
        return $main_menu;
	}

	public static function side_menu($id){

		/* $side_menu = DB::table('level_menu_det as a')
        ->join('submenu as b', 'a.id_submenu', '=', 'b.submenu_id')        
		->join('menu as c', 'b.id_menu', '=', 'c.menu_id')        
        ->select('submenu_nama','submenu_id','submenu_link','submenu_link_name','menu_nama')
		->where('a.id_level', '=', Session::get('levelId'))	
		->where('b.id_menu', '=', $id)	
		->where('b.submenu_status', '=', 'y')
		->orderBy('menu_order','asc')
		->orderBy('submenu_order','asc')
        ->get(); */
		
		$side_menu = DB::table('level_menu_det as a')
        ->join('submenu as b', 'a.id_submenu', '=', 'b.submenu_id')        		
        ->select('*')
		->where('a.id_level', '=', Session::get('levelId'))	
		->where('b.submenu_child', '=', 'y')				
		->where('b.submenu_status', '=', 'y')
		->where('b.submenu_parent', '=', $id)			
		->orderBy('submenu_order','asc')
        ->get();
		
        return $side_menu;
	}
}
