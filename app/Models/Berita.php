<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $primaryKey = 'berita_id';

    public $timestamps = false;
    protected $fillable = [
        'berita_id',
		'berita_judul',
		'berita_isi',
        'berita_create_who',		
        'berita_create_when',		
        'berita_create_ip',		        
		'berita_update_who',
		'berita_update_when',
		'berita_update_ip',
		'berita_publish',
		'berita_gambar_name',
		'berita_path',
		'berita_exe',
		'berita_tanggal',
		'berita_view',
		'berita_gambar_name_ori',
		'berita_sumber',
		'id_kategori'
    ];	

	public function category() 
	{
		return $this->belongsTo('App\Models\Kategori');
	}
}
