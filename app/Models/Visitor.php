<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitor';

    //protected $primaryKey = '';

    public $timestamps = false;
    protected $fillable = [
        'visitor_ip',
		'visitor_date',
		'visitor_hits',
        'visitor_online',		
        'visitor_time'        
    ];	       
}
