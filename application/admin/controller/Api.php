<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/20
 * Time: 12:27
 */

namespace app\admin\controller;


use think\Controller;

class Api extends Controller
{
    public function index(){
        $api=db('api')->paginate(10);
        $this->assign('api',$api);
        return view('api_list');
    }
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $res=db('api')->insert($data);
            if($res){
                $this->success('添加成功','api/index');
            }else{
                $this->error('添加失败');
            }

        }
        return view('api_add');
    }
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');
            $res=db('api')->where('id','=',$id)->update($data);
            if($res){
                $this->success('修改成功','api/index');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        $apiEdit=db('api')->where('id','=',$id)->find();
        $this->assign('apiEdit',$apiEdit);
        return view('api_edit');
    }
    //移动端获取首页轮播图接口
    public function indexBanner(){

            $data=db('mobile_banner')->where(array('type'=>0,'display'=>1))->select();
            return json($data);

    }
    //移动端获取顶级分类的轮播图
    public function childBanner($id){
        if(request()->isPost()){
            $data=db('mobile_banner')->where(array('type'=>$id,'display'=>1))->find();
            return json($data);
        }
    }
    //移动端获取所有顶级分类信息
    public function topCate($num=0){
        if(request()->isPost()) {
            $data = db('cate')->where('pid', '=', 0)->limit($num)->select();
            return json($data);
        }
    }
    //移动端获取所有产品信息
    public function product($pid=0){
        if(request()->isPost()) {
            if($pid==0){
                $data = db('product')->select();
            }else{
                $data = db('product')->where('pid','=',$pid)->select();
            }
            return json($data);
        }
    }
    //移动端获取所有文章信息
    public function article($pid=0){

            if($pid==0){
                $data = db('article')->paginate(5);
            }else{
                $data = db('article')->paginate(5);
            }
            return json($data);

    }
    //获取子分类(二级分类)信息
    public function getChildCate($id){
        if(request()->isPost()){
            $data=db('cate')->where('pid','=',$id)->select();
            return json($data);
        }
    }
    //根据文章id获取文章信息
    public function getArticle($id){
        $data=db('article')->where('id','=',$id)->find();
        return json($data);
    }
    //根据文章id获取文章信息
    public function getArticleByCate($id){
        $data=db('article')->where('pid','=',$id)->find();
        return json($data);
    }
    //根据id获取分类信息
    public function getCate($id){
        $data=db('cate')->field('catename,enname,id')->find($id);
        $image=db('mobile_banner')->where('type','=',$id)->find();
        $data['image']=$image['image'];
//        $data=db('cate')->alias('c')->field('c.catename,c.enname,c.id,m.image')
//            ->join('mobile_banner m','c.id=m.type')->find($id);
        return json($data);
    }

}