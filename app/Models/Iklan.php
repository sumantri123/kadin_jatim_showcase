<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
    protected $table = 'iklan';

    protected $primaryKey = 'iklan_id';

    public $timestamps = false;
    protected $fillable = [
        'iklan_id',
		'iklan_judul',
		'iklan_keterangan',
        'iklan_create_who',		
        'iklan_create_when',		
        'iklan_create_ip',		        
		'iklan_update_who',
		'iklan_update_when',
		'iklan_update_ip',
		'iklan_publish',
		'iklan_name',
		'iklan_path',
		'iklan_exe',
		'iklan_tanggal_awal',
		'iklan_tanggal_akhir',
		'iklan_name_ori'
    ];	       
}
