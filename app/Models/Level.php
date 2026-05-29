<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'level_user';

    protected $primaryKey = 'level_id';

    public $timestamps = false;
    protected $fillable = [
        'level_id',
		'level_nama'		
    ];	       
	
	public function User()
    {
        return $this->belongsTo('App\Models\Level');
    }
}
