<?php


namespace app\admin\controller;


class Search extends Base
{
    public  function index(){
        $search=db('search')->select();
        $this->assign('search',$search);
        return view('search_list');
    }
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $result=db('search')->insert($data);
            if($result){
                $this->success('添加成功','search/index');
            }else{
                $this->error('添加失败');
            }
        }
        return view('search_add');
    }
    public function edit(){
        $id=input('id');
        $searchDb=db('search');
        if(request()->isPost()){
            $data=input('post.');
            $result=$searchDb->where('id',$id)->update($data);
            if($result){
                $this->success('修改成功','search/index');
            }else{
                $this->error('修改失败');
            }
        }

        $search=$searchDb->where('id',$id)->find();
        $this->assign('search',$search);
        return view('search_edit');
    }
    //搜索记录
    public function search_history(){
        $search=db('search_history')->order('count desc')->paginate(10);
        $this->assign('search',$search);
        return view('search_history');
    }
}
