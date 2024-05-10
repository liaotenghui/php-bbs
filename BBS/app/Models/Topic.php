<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];
    public function category(){
        return $this->belongsTo(Category::class);
        //该方法是Topic模型 属于category模型
        //topics表与categoirs表连接起来
    }
    public function user(){
        return $this->belongsTo(User::class);
        //该方法是Topic模型 属于user模型
        //topics表与users表连接起来
    }
}
