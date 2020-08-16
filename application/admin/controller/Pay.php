<?php


namespace app\admin\controller;


class Pay extends Base
{
        public function index(){
            if(request()->isPost()){
                $data=input('post.');
                $res=db('pay')->where('id','=',1)->update($data);
                if($res){
                    if($res){
                        $this->success('设置成功','pay/index');
                    }else{
                        $this->error('添加失败');
                    }
                }

            }
            $pay=db('pay')->where('id','=',1)->find();
            $this->assign('pay',$pay);
            return view();
        }
}
