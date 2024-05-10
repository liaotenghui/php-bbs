<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
function route_class(){
  return str_replace('.','-',Route::currentRouteName());
}
function category_nav_active($category_id){
  return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}
function make_excerpt($value, $length = 200) 
{ $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value))); 
return Str::limit($excerpt, $length); }
function getSrc($topic_body){
  preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$topic_body,$match);
  return $match[1];
}
function removeQuotationMark($topic_body){
  $html = htmlentities($topic_body);
  return $html;
}