<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class UsersController extends Controller
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
    public function show(User $user)
    {
        //$user是链接中的id
        //User模型---数据库中的表——-users,一个模型对应一张表
        //User $user 找到users表中id值对应的所有数据

        return view('users.show', compact('user'));
        //compact('user') user 是id值对应的一行数据
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // dd($request->avatar);
        //上传图片
        //1.移动图片到laravel项目中
        $avatar = $request->avatar;
        if($avatar){
            $uploader = new ImageUploadHandler();//类不能直接使用（除了静态类）必须实例化
            $result = $uploader->save($avatar,'avatars',$id,416);
            if($result){
                $avatar = $result['path'];//文件上传后具体的地址,然后更新avatar
        }
        }else{
            //否则，没有获取到图像，获取原图像地址，在users表中找到该id值的数据，并找出avatar
            $user = User::find($id);
            $avatar = $user->avatar;
        }
       
        //2.保存到数据中

        //数据更新
        //1.获取表单数据
        $name = $request->name;
        $email = $request->email;
        $introduction = $request->introduction;
        //2.把数据更新到对应字段
        // 法1
        // $affected = DB::table('users')
        // ->where('id', $id)
        // ->update([
        //             'name' => $name,
        //             'email'=>$email,
        //             'introduction'=>$introduction
        //         ]);
        //法2,模型相当于一张表可以对数据进行操作-条件更新的是登录人的数据$id
        User::where('id',$id)->update(['name'=>$name,'email'=>$email,'introduction'=>$introduction,'avatar'=>$avatar,]);
        //3.成功报成功信息
        // echo "<script>alert('修改成功！');window.location.href='/users/$id'</script>";
        return redirect()->route('users.show',$id)->with('success','更新数据成功！');
       
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
