<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\helpers;
class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request)
	{
		//显示话题列表
		$order = $request->query('order');
		if($order=='default'){
			$topics = Topic::orderBy('updated_at','desc')->paginate();
			//是pagenate方法进行分页——一页显示多少条数据
		//Topic模型就是topics表，对topics表进行分页查询，
		//查询话题所有数据并且一页显示15条数据
		return view('topics.index', compact('topics'));
		}else if($order=='new'){
			$topics = Topic::orderBy('created_at','desc')->paginate();
			return view('topics.index', compact('topics'));
		}else{
			//点击导航栏的话题的链接是没有?/order=default,应该设置一个没有order的情况
			$topics = Topic::orderBy('updated_at','desc')->paginate();
			return view('topics.index', compact('topics'));
		}
		
		
	}

    public function show(Topic $topic)
    {//显示话题
		//Topic $topic 意思$topic = Topic::find($id);
		//例如：$id=1,在topic表找到id=1的话题信息并赋值给$topic
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{//创建话题--显示数据--分类数据
		$category=Category::all();
		return view('topics.create_and_edit', compact('topic','category'));
	}

	public function store(TopicRequest $request,Topic $topic)
	{//存储创建对数据
		// 获取表单title，body，category_id值
		$title = $request->title;
		$body = $request->body;
		$category_id = $request->category_id;
		$user_id = Auth::id();
		//创建在Topic模型中 $topic = Topic::create(['title']=>$title,)
		// $topic = Topic::create(['user_id'=>$user_id,'title'=>$title,'body'=>$body,'category_id'=>$category_id]);
		
		//因为user_id不在白名单中，所以不能进行增加和修改，使用赋值方法
		// $topic = Topic::create($request->all());
		$topic->user_id=$user_id;
		$topic->title=$title;
		$topic->body=$body;
		$topic->category_id=$category_id;
		$topic->save();
		return redirect()->route('topics.show', $topic->id)->with('success', '创建帖子成功！');
	}

	public function edit(Topic $topic)
	{//编辑数据--显示所需要编辑的数据
		//Topic $topic
        $this->authorize('update', $topic);
		$category=Category::all();
		return view('topics.create_and_edit', compact('topic','category'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{//更新数据
		//TopicRequest $request  验证数据
		$this->authorize('update', $topic);
		// $topic是id为$id的信息，update是更新数据，更新的数据是编辑表单的所有数据
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('success', '帖子更新成功！');
	}

	public function destroy(Topic $topic)
	{//删除数据
		$this->authorize('destroy', $topic);
		$topic->delete();
		return redirect()->route('topics.index')->with('success', '删除成功！.');
	}
	public function uploadImage(ImageUploadHandler $upload,Request $request){
		//编辑器图片上传——要调用图片上传类--ImageUploadHander
		//初始化返回数据，默认是图片上传失败
		$data = [
			'success'=>false,
			'msg'=>'上传失败',
			'file_path'=>''
		];
		if($file=$request->upload_file){
			//如果上传的有地址
			$result = $upload->save($file,'topics',Auth::id(),1024);
			if($result){
				//如果蹄片上传成功，要对data赋值
				$data['success']=true;
				$data['msg']='上传成功';
				$data['file_path']=$result['path'];
			}
		}
		return $data;
	}
}