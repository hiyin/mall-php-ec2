<?php
namespace app\admin\controller;

class Cate extends Base
{

    public function index(){
       $this->getCate();
        return view('cate_list');
    }
    public function add(){
        if(request()->isPost()){
            $data=input('post.');

            //图片上传
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'cate');
            }

            $res=db('cate')->insert($data);
            if($res){
                $this->success('添加成功','cate/index');
            }else{
                $this->error('添加失败');
            }
        }
        $this->getCate();
        return view('cate_add');
    }
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');

            //图片上传
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'cate');
            }
            $res=db('cate')->where('id','=',$id)->update($data);
            if($res){
                $this->success('修改成功','cate/index');
            }else{
                $this->error('修改失败');
            }
        }


        $cate=db('cate');
        $currentCate=$cate->find($id);
        $this->assign(['currentCate'=>$currentCate]);
        $this->getCate();
        return view('cate_edit');
    }
    public function del($id){
        $res=db('cate')->delete($id);
        if($res){
            $this->success('删除成功','cate/index');
        }else{
            $this->error('删除失败');
        }
    }
    public function getCate(){
        $cate=db('cate')->select();
        $this->assign('catetree',$cate);
    }
    public function getCateById(){
        $id=input('id');
        $data=db('cate')->where('pid',$id)->select();
        return json($data);
    }
    //推荐
    public function recommend(){
        $data=input('post.');
        $result=db('cate')->where('id','=',$data['id'])->update(['recommend'=>$data['recommend']]);
        if ($result){
            return json('修改成功');
        }else{
            return json('修改失败');
        }
    }
    //分类内容
    public function cateContent(){
        $id=input('id');
        if(request()->isPost()){
            $data=input('post.');
            $image=request()->file('image');

            foreach ($data['title'] as $k=>$v){
                $cate[$k]['title']=$data['title'][$k];
                $cate[$k]['img']='';
                if(isset($image[$k])){
                    $cate[$k]['img']=$this->upload($image[$k],'cate');
                }else{
                    if(isset($data['editImg'][$k])){
                        $cate[$k]['img']=$data['editImg'][$k];
                    }
                }
                $cate[$k]['url']=$data['url'][$k];
                $cate[$k]['name']=$data['name'][$k];
                $cate[$k]['summary']=$data['summary'][$k];
                $cate[$k]['price']=$data['price'][$k];
                $cate[$k]['bg']=$data['bg'][$k];
                $cate[$k]['cateid']=$id;
            }
            db('cate_content')->where('cateid',$id)->delete();

            $result=db('cate_content')->insertAll($cate);
            if($result){
                $this->error('操作成功');
            }else{
                $this->error('操作失败');
            }

        }
        $link=db('link')->select();
        $catecontent=db('cate_content')->where('cateid',$id)->order('id asc')->select();
        $this->assign(['catecontent'=>$catecontent,"link"=>$link]);
//        $this->assign('catecontent',$catecontent);
        return view('cate_content');
    }

}
