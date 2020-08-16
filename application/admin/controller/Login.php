<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11 0011
 * Time: 下午 5:44
 */

namespace app\admin\controller;


use think\Controller;

class Login extends Controller
{
    public function index(){
        return view('login');
    }
    public function ajaxLogin(){
        $data=input('post.');
        //验证码验证
        if(!captcha_check($data['code'])){
            return json(['staut'=>0,'message'=>'验证码错误']);
        };
        $username=db('admin')->where('username','=',$data['username'])->find();
        if(!$username){
            return json(['staut'=>0,'message'=>'用户不存在']);
        }else{
            if($username['password']==$data['password']){
                session('id', $username['id']);
                session('username', $username['username']);
                return json(['staut'=>1,'message'=>'登录成功']);
            }
            else{
                return json(['staut'=>0,'message'=>'密码错误']);
            }
        }
    }
}