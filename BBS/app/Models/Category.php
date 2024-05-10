<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];
    public $timestamps = false;
    public function topics(){
        return $this->belongsTo(Topic::class);
        //该方法是Topic模型 属于category模型
        //topics表与categoirs表连接起来
    }
    public function user(){
        return $this->belongsTo(User::class);
        //该方法是Topic模型 属于user模型
        //topics表与users表连接起来
    }
}
