<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10 0010
 * Time: 下午 3:21
 */

namespace app\admin\controller;


class Authgroup extends Base
{
    public function index(){
        $authgroup=db('auth_group')->select();
        $this->assign('authgroup',$authgroup);
        return view('auth_group_list');
    }
    public function add(){
       if(request()->isPost()){
           $data=input('post.');
           $data['rules']=implode(',',$data['rules']);
           $res=db('auth_group')->insert($data);
           if($res){
               $this->success('添加成功','authgroup/index');
           }else{
               $this->error('添加失败');
           }
       }
        $cate=db('auth_rule')->select();
        $catetree=$this->catetree($cate);
        $this->assign('catetree',$catetree);
        return view('auth_group_add');
    }
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');

            $data['rules']=implode(',',$data['rules']);
            $res=db('auth_group')->where('id','=',$id)->update($data);
            if($res){
                $this->success('修改成功','authgroup/index');
            }else{
                $this->error('修改失败');
            }
        }

        $groupcheck=db('auth_group')->find($id);
        $groupcheck['rules']=explode(',',$groupcheck['rules']);
        $cate=db('auth_rule')->select();
        $catetree=$this->catetree($cate);
        $this->assign(
            array('catetree'=>$catetree, 'groupcheck'=>$groupcheck['rules'],'group'=>$groupcheck['title']
            ));
        return view('auth_group_edit');
    }
}