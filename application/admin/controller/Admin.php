<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10 0010
 * Time: 下午 2:36
 */

namespace app\admin\controller;


class Admin extends Base
{
    public function index(){
        $admin=db('admin')->paginate(10);
        $this->assign('admin',$admin);
        return view('admin_list');
    }
    public function add(){
        if(request()->isPost()){
            $data=input('post.');

            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'admin');
            }
            $data['data']=time();
            $res=db('admin')->insert($data);

            $group['group_id']=$data['group'];
            $group['uid']=db('admin')->getLastInsID();
            db('auth_group_access')->insert($group);

            if($res){
                $this->success('添加成功','admin/index');
            }else{
                $this->error('添加失败');
            }

            return;
        }
        $group=db('auth_group')->select();
        $this->assign('group',$group);
        return view("admin_add");
    }

    public function logout()
    {
        session('id', null);
        session('username', null);
        $this->success('退出成功', 'index/index/index');

    }
}