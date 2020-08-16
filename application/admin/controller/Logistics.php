<?php


namespace app\admin\controller;


class Logistics extends Base
{
    public function index(){
        $logistics=db('logistics')->select();
        $this->assign('logistics',$logistics);
        return view();
    }
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $result=db('logistics')->where('name','=',$data['name'])->find();
            if($result){
                return json(['code'=>0,"msg"=>"该物流已存在"]);
            }else{
                $logistics=db('logistics')->insert($data);
                if($logistics){
                    $this->success('添加成功','logistics/index');
                }else{
                    $this->error('添加失败');
                }
            }
        }
        return view();
    }
    public function edit(){
        $id=input('id');

        if(request()->isPost()){
            $data=input('post.');
            $result=db('logistics')->where('name','=',$data['name'])->find();
            if($result){
                return json(['code'=>0,"msg"=>"该物流已存在"]);
            }else{
                $logistics=db('logistics')->where('id','=',$id)->update($data);
                if($logistics){
                    $this->success('修改成功','logistics/index');
                }else{
                    $this->error('修改失败');
                }
            }
        }
        $logistics=db('logistics')->where('id','=',$id)->find();
        $this->assign('logistics',$logistics);
        return view();
    }
    public function recommend(){
        $data=input('post.');
        $result=db('logistics')->where('id','=',$data['id'])->update(['use'=>$data['recommend']]);
        if ($result){
            return json('修改成功');
        }else{
            return json('修改失败');
        }
    }
}
