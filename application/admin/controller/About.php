<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/25 0025
 * Time: 上午 11:23
 */

namespace app\admin\controller;


use think\Controller;

class About extends Base
{
    public  function index(){
        $about=db('about');
        if(request()->isPost()){
            $data=input('post.');
            $num=$about->count();
            if($num!=0){
                $res=$about->where('id','=',1)->update($data);
            }else{
                $res=$about->insert($data);
            }
            if($res){
                $this->redirect('About/index');
            }
        }
        $aboutRes=$about->find(1);
        dump($aboutRes);
        $this->assign('about',$aboutRes);
        return view('about_add');
    }
}