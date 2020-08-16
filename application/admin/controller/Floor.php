<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/1 0001
 * Time: 上午 10:43
 */

namespace app\admin\controller;


class Floor extends Base
{
    public function index(){
        $active=db('floor')->select();
        $this->assign('floor',$active);
        return view('floor_list');
    }
    public function add(){
        if(request()->isPost()){
            //获取提交数据
            $data=input('post.');
            $data['link']=$data['link'.$data['link_type']];
            unset($data['link1']);
            unset($data['link2']);
            //图片上传
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'floor');
            }

            //插入数据
            $res=db('floor')->insert($data);
            if($res){
                $this->success('添加成功','floor/index');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        $link=db('link')->select();
        $this->assign('link',$link);
        return view('floor_add');
    }
    public function del($id){
        $res=db('floor')->where('id','=',$id)->delete();
        if($res){
            $this->success('删除成功','floor/index');
        }else{
            $this->error('删除失败');
        }
    }
    public function edit($id){
        if(request()->isPost()){
            //获取提交数据
            $data=input('post.');
            $data['link']=$data['link'.$data['link_type']];
            unset($data['link1']);
            unset($data['link2']);
            //图片上传
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'floor');
            }

            //修改数据
            $res=db('floor')->where('id','=',$id)->update($data);
            if($res){
                $this->success('修改成功','floor/index');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $link=db('link')->select();
        $floorEdit=db('floor')->where('id','=',$id)->find();
        $type=db('link')->field('type,router')->where('id',$floorEdit['link_type'])->find();
        $floorEdit['type']=$type['type'];
        $floorEdit['router']=$type['router'];
        $this->assign(['floorEdit'=>$floorEdit,'link'=>$link]);


        return view('floor_edit');
    }
//推荐
    public function recommend(){
        $data=input('post.');
        $result=db('floor')->where('id','=',$data['id'])->update(['display'=>$data['recommend']]);
        if ($result){
            return json('修改成功');
        }else{
            return json('修改失败');
        }
    }

}
