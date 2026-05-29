<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    protected $primaryKey = 'agenda_id';

    public $timestamps = false;
    protected $fillable = [
        'agenda_id',
		'agenda_judul',
		'agenda_isi',
        'agenda_create_who',		
        'agenda_create_when',		
        'agenda_create_ip',		        
		'agenda_update_who',
		'agenda_update_when',
		'agenda_update_ip',
		'agenda_publish',
		'agenda_gambar_name',
		'agenda_path',
		'agenda_exe',
		'agenda_tanggal',
		'agenda_view',
		'agenda_gambar_name_ori',
		'agenda_tempat',
		'agenda_waktu',
		'instansi',
    ];	       
}
