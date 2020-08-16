<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/19
 * Time: 12:25
 */

namespace app\admin\controller;
use think\Request;

class Mobile extends Base
{
    public function banner(){
        $banner=db('mobile_banner')->field('m.*,c.catename')->alias('m')->join('cate c','m.type=c.id','LEFT')->paginate(5);
        $this->assign('banner',$banner);
        return view('banner_list');
    }
    public function banneradd(){
        if(request()->isPost()){
            //获取提交数据
            $data=input('post.');
            //图片上传
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'mobile/banner');
            }
            //添加后台验证
            $checkRes=$this->checkData($data,'add');
            if($checkRes){
                $this->error($checkRes);
            }
            //插入数据
            $res=db('mobile_banner')->insert($data);
            if($res){
                $this->success('添加成功','mobile/banner');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        $cate=db('cate')->where('pid','=',0)->select();
        $this->assign('cate',$cate);
        return view('banner_add');
    }
    public function banneredit($id){
        if(request()->isPost()){
            //获取提交数据
            $data=input('post.');
            //图片上传

            $image=request()->file('image');

            if($image){
                $data['image']=$this->upload($image,'banner');
            }

            //添加后台验证
            $checkRes=$this->checkData($data,'edit');
            if($checkRes){
                $this->error($checkRes);
            }

            //修改数据
            $res=db('mobile_banner')->where('id','=',$id)->update($data);
            if($res){
                $this->success('修改成功','Mobile/banner');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $cate=db('cate')->where('pid','=',0)->select();
        $this->assign('cate',$cate);

        $bannerEdit=db('mobile_banner')->where('id','=',$id)->find();
        $this->assign('bannerEdit',$bannerEdit);
        return view('banner_edit');
    }
    public function bannerdel($id){
        $res=db('mobile_banner')->where('id','=',$id)->delete();
        if($res){
            $this->success('删除成功','Mobile/banner');
        }else{
            $this->error('删除失败');
        }
    }

    private function checkData($data,$scene){
        $bannerval=validate('banner');
        $res=$bannerval->scene($scene)->check($data);
        if(!$res){
            return $bannerval->getError();
        }
    }

}