<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $order = $request->query('order');
        if($order=='default'){
            $topics = Topic::where('category_id',$id)->orderBy('updated_at','desc')->paginate(5);//查询分类id为1的帖子并且分页
        //显示分类的帖子--查询topics中为分享的帖子，为教程的帖子···
		return view('topics.index', compact('topics'));
        }else if($order=='new'){
            $topics = Topic::where('category_id',$id)->orderBy('created_at','desc')->paginate(5);//查询分类id为1的帖子并且分页
            return view('topics.index', compact('topics'));
        }else{
            $topics = Topic::where('category_id',$id)->orderBy('updated_at','desc')->paginate(5);
            return view('topics.index', compact('topics'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
