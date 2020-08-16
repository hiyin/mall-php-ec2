<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10 0010
 * Time: 上午 10:02
 */

namespace app\admin\controller;


class Article extends Base
{
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            //图片上传
            $image=request()->file('image');

            if($image){
                $data['image']=$this->upload($image,'article');
            }
            $data['data']=time();

            $res=db('article')->insert($data);
            if($res){
                $this->success('添加成功','article/index');
            }else{
                $this->error('添加失败');
            }
        }
        //分类数据
        $this->getArticleCate();
        return view('article_add');
    }
    public function index(){
        //查询所有数据
        $article=db('article')->field('a.*,c.catename')->alias('a')->join('cate c','a.pid=c.id','LEFT')->paginate(1);
        $this->assign('article',$article);
        //文章分类数据
        $this->getArticleCate();
        return view('article_list');
    }
    //编辑文章
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');
            //图片上传
            $image=request()->file('image');
            dump($image);
            if($image){
                $data['image']=$this->upload($image,'article');
            }
            $data['data']=time();
            $res=db('article')->where('id','=',$id)->update($data);
            if($res){
                $this->success('修改成功','article/index');
            }else{
                $this->error('修改失败');
            }
        }
        //分类数据
        $this->getArticleCate();
        $article=db('article')->where('id','=',$id)->find();
        $this->assign('article',$article);
        return view('article_edit');
    }
    //获取文章分类
    public function getArticleCate(){
        $data=db('cate')->select();
        $catetree=$this->catetree($data);
        $this->assign('catetree',$catetree);
    }

}