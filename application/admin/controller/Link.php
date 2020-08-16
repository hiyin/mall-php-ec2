<?php


namespace app\admin\controller;


class Link extends Base
{
    public function index(){
        $link=db('link')->select();
        $this->assign('link',$link);
        return view('link_list');
    }
    public function  add(){
        if(request()->isPost()){
            $data=input('post.');
            $res=db('link')->insert($data);
            if($res){
                $this->success('添加成功','Link/index');
            }else{
                $this->error('添加失败');
            }
        }
        return view('link_add');
    }
    public function  edit(){
        $id=input('id');

        if(request()->isPost()){
            $data=input('post.');
            $res=db('link')->where('id','=',$id)->update($data);
            if($res){
                $this->success('添加成功','Link/index');
            }else{
                $this->error('添加失败');
            }
        }
        $link=db('link')->where('id','=',$id)->find();
        $this->assign('link',$link);
        return view('link_edit');
    }
}
