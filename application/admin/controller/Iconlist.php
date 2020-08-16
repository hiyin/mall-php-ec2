<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/8 0008
 * Time: 下午 6:06
 */

namespace app\admin\controller;


class Iconlist extends Base
{
    public function index(){
        //获取列表所有数据
        $banner=db('icon')->paginate(10);
        $this->assign('icon',$banner);
        return view('icon_list');
    }
    public function add(){
        if(request()->isPost()){
            //获取提交数据
            $data=input('post.');
            //获取提交数据
            $data['link']=$data['link'.$data['link_type']];
            unset($data['link1']);
            unset($data['link2']);
            //图片上传
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'banner');
            }
            //添加后台验证
            $checkRes=$this->checkData($data,'add');
            if($checkRes){
                $this->error($checkRes);
            }
            //插入数据
            $res=db('icon')->insert($data);
            if($res){
                $this->success('添加成功','iconlist/index');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        $link=db('link')->select();
        $this->assign('link',$link);
        return view('icon_add');
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
                $data['image']=$this->upload($image,'icon');
            }
            //添加后台验证
            $checkRes=$this->checkData($data,'edit');
            if($checkRes){
                $this->error($checkRes);
            }
            //修改数据
            $res=db('icon')->where('id','=',$id)->update($data);
            if($res){
                $this->success('修改成功','iconlist/index');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $iconEdit=db('icon')->where('id','=',$id)->find();
        $link=db('link')->select();
        $type=db('link')->field('type,router')->where('id',$iconEdit['link_type'])->find();
        $iconEdit['type']=$type['type'];
        $iconEdit['router']=$type['router'];
        $this->assign(['iconEdit'=>$iconEdit,'link'=>$link]);
        return view('icon_edit');
    }
    public function del($id){
        $res=db('icon')->where('id','=',$id)->delete();
        if($res){
            $this->success('删除成功','iconlist/index');
        }else{
            $this->error('删除失败');
        }
    }

    private function checkData($data,$scene){
//        $bannerval=validate('icon');
//        $res=$bannerval->scene($scene)->check($data);
//        if(!$res){
//            return $bannerval->getError();
//        }
    }
    //推荐
    public function recommend(){
        $data=input('post.');
        $result=db('icon')->where('id','=',$data['id'])->update(['display'=>$data['recommend']]);
        if ($result){
            return json('修改成功');
        }else{
            return json('修改失败');
        }
    }
}
