<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/2 0002
 * Time: 下午 5:11
 */

namespace app\admin\controller;


class Attr extends Base
{
    public function index(){
        $attr=db('attr')->field('a.*,c.catename')->alias('a')->join('cate c','a.cateid=c.id')->paginate(10);

//        $attr=db('attr')->paginate(10);
        $this->assign('attr',$attr);
        return view('attr_list');
    }
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $res=db('attr')->insert($data);
            if($res){
                $this->success('添加成功','attr/index');
            }else{
                $this->error('添加失败');
            }
            return;
        }


        $cate=db('cate')->select();
        $this->assign('cate',$cate);
        return view('attr_add');
    }
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');
            $res=db('attr')->where('id',$id)->update($data);
            if($res){
                $this->success('修改成功','attr/index');
            }else{
                $this->error('修改失败');
            }
        }
        $attr=db('attr')->where('id',$id)->find();
        $cate=db('cate')->select();
        $this->assign(['attr'=>$attr,'cate'=>$cate]);
        return view('attr_edit');
    }

}
