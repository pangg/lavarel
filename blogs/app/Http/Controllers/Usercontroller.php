<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class Usercontroller extends Controller
{
    /**
     * 添加用户
     */
    public function add()
    {
        //
        return view('admin.user.add');
    }

    /*
     * 用户添加
     * */
    public function insert(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'username' => 'required|regex:/\w{8,20}/',
            'email' => 'required|email',
            'password' => 'same:repassword'
        ],[
            'username.required' => '用户名不能省略',
            'username.regex'=>'用户名规则不正确 请填写8~20位字母数字下划线',
            'email.required' => '邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'password.same' => '两次密码不一致'
        ]);

        //数据库插入
        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user -> intro = $request->input('intro');

        //随机字符串标识
        $user -> remember_token = str_random('50');
        //处理图片上传
        if ($request->hasFile('profile')) {
            //文件的存放目录
            $path = './Uploads/'.date('Ymd');
            //获取后缀
            $suffix = $request->file('profile')->getClientOriginalExtension();
            //文件的名称
            $fileName = time().rand(100000, 999999).'.'.$suffix;
            $request->file('profile')->move($path, $fileName);
            $user -> profile = trim($path.'/'.$fileName,'.');
        }

        //执行插入
        if($user->save()) {
            return redirect('/user/index')->with('info', '添加成功');
        }else{
            return back()->with('info', '添加失败');
        }

    }

    /*
     * 用户列表
     * */
    public function index(Request $request)
    {
        echo '124';
    }
}
