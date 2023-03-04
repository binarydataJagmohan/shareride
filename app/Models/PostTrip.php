<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTrip extends Model
{
    use HasFactory;
    protected $fillable = ['seats'];
    // public function user()
    // {
    // 	return $this->belongsTo('App\User','user_id','id');
    // }

    // public function vehicle()
    // {
    // 	return $this->belongsTo('App\vehicle_model','vehicle_id','id');
    // }
}
