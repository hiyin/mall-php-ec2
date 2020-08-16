<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/1 0001
 * Time: 上午 10:05
 */

namespace app\admin\controller;


class Active extends Base
{
    public function index(){
        //获取列表所有数据
        $active=db('active')->select();
        $this->assign('active',$active);
        return view('active_list');
    }
    public function add(){
        if(request()->isPost()){
            //获取提交数据
            $data=input('post.');
            //图片上传
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'active');
            }

            //插入数据
            $res=db('active')->insert($data);
            if($res){
                $this->success('添加成功','active/index');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        return view('active_add');
    }
    public function del($id){
        $res=db('active')->where('id','=',$id)->delete();
        if($res){
            $this->success('删除成功','active/index');
        }else{
            $this->error('删除失败');
        }
    }
    public function edit($id){
        if(request()->isPost()){
            //获取提交数据
            $data=input('post.');
            //图片上传
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'active');
            }

            //修改数据
            $res=db('active')->where('id','=',$id)->update($data);
            if($res){
                $this->success('修改成功','active/index');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $bannerEdit=db('active')->where('id','=',$id)->find();
        $this->assign('activeEdit',$bannerEdit);
        return view('active_edit');
    }

    //是否显示
    public function recommend(){
        $data=input('post.');
        $result=db('active')->where('id','=',$data['id'])->update(['display'=>$data['recommend']]);
        if ($result){
            return json('修改成功');
        }else{
            return json('修改失败');
        }
    }
}
