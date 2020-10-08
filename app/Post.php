<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    // Table
    protected $table = 'posts';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function User(){
        return Post::orderBy('created_at', 'desc')->paginate(10);
        return $this->belongsTo('App\User');    
    }
    

    public function getCreatedAtAttribute($date)
{
    return Carbon::parse($date)->addHour(1)->toDayDateTimeString();
}
    
}
