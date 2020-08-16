<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10 0010
 * Time: 下午 3:35
 */

namespace app\admin\controller;


class Authrule extends Base
{
public function add(){
    if(request()->isPost()){
        $data=input('post.');
        $res=db('auth_rule')->insert($data);
        if($res){
            $this->success('添加成功','authrule/index');
        }else{
            $this->error('添加失败');
        }
    }
    $this->getCate();
    return view('auth_rule_add');
}
public function index(){
    $this->getCate();
    return view('auth_rule_list');
}
public function getCate(){
    $cate=db('auth_rule')->select();
    $catetree=$this->catetree($cate);
    $this->assign('catetree',$catetree);
}
public function edit($id){
    if(request()->isPost()){
        $data=input('post.');
        $res=db('auth_rule')->where('id','=',$id)->update($data);
        if($res){
            $this->success('修改成功','authrule/index');
        }else{
            $this->error('修改失败');
        }
        return;
    }
    $this->getCate();
    $authrule=db('auth_rule')->where('id','=',$id)->find();
    $this->assign('authrule',$authrule);
    return view('auth_rule_edit');
}
public function del($id){
    $res=db('auth_rule')->where('id','=',$id)->delete();
    if($res){
        $this->success('删除成功','Authrule/index');
    }
    else{
        $this->error('删除失败');
    }
}
}