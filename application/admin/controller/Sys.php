<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/13
 * Time: 22:09
 */

namespace app\admin\controller;


class Sys extends Base
{
 public function index(){
     $sysDb=db('sys');
     $sys=$sysDb->order('sort asc')->select();
     $this->assign('sys',$sys);
     if(request()->isPost()){
         $data=input('post.');
         dump($data['sort']);
         foreach($data['sort'] as $k=>$v){
             $sysDb->where('id','=',$k)->update(['sort'=>$v]);
         }
         $this->redirect('sys/index');
     }
    return view('sys_list');
 }
 public function add(){
     if(request()->isPost()){
         $data=input('post.');
         $res=db('sys')->insert($data);
         if($res){
             $this->success('添加成功','sys/index');
         }
         else{
             $this->error('添加失败');
         }
         return;
     }
     return view('sys_add');
 }
public function sys(){
     if(request()->isPost()){
         $data=input('post.');
         $sys=db('sys');
         foreach($data['image'] as $k=>$v){
             $image=request()->file($v);
            if($image){
                $data[$v]=$this->upload($image,'sys');
            }
         }

         foreach ($data as $k=>$v){
             $sys->where('enname','=',$k)->update(['result'=>$v]);
         }
         $this->success('修改成功','Sys/sys');

     }
     $sys=db('sys')->order('sort asc')->select();
     //$sys['value']=explode(',',$sys['value']);
    foreach ($sys as $k=>$v){
        if($v['value']){
            $v['value']=11;
        }
    }
    $this->assign('sys',$sys);
    return view('sys');
}
}