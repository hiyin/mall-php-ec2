<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize()
    {
        if(!session('username')){
            $this->success('请先登录',url('Login/index'));
        }


        $auth=new Auth();
        $group=$auth->getGroups(session('id'));
        $rules=explode(",",$group[0]['rules']);
        $authgroup=db('auth_rule');
        $rulesName=[];
        foreach ($rules as $k=>$v){
            $name=$authgroup->field('name')->find($v);
            $rulesName[]=$name['name'];
        }
        $this->assign('rulesName',$rulesName);



//        $request= \think\Request::instance();
//        $controller = $request->controller();//控制器名
//        $action = $request->action();
//        $name=$controller.'/'.$action;
//        $notCheck=array('Index/index','Index/console','Admin/logout');
//        if(!in_array($name,$notCheck)){
//
//            $res=$auth->check($name,session('id'));
//
//            if(!$res){
//                $this->success('没有相应权限','admin/index/index');
//            }
//        }
    }

    //图片上传
    public function upload($image,$path){
        // 获取表单上传文件 例如上传了001.jpg
//        $file = request()->file('image');
        $file=$image;
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/'.$path);
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                //return $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $temp=$info->getSaveName();
                $result=str_replace('\\','/',$temp);
                //dump($result);
                return $path."/".$result;
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getFilename();
            }else{
                // 上传失败获取错误信息
                return $file->getError();
            }
        }
    }
    //根据之元素id查找父元素id
    public function getparents($cateid){
        $cateres=db('cate')->field('id,pid,catename')->select();
        $cates=db('cate')->field('id,pid,catename')->find($cateid);
        $pid=$cates['pid'];
        $arrt=[];
        if($pid){
            $arrt=$this->_getparentsid($cateres,$pid);
        }
        //$arr[]=$cates;
        return $arrt;
    }

    public function _getparentsid($cateres,$pid){
        static $arr=[];
        foreach ($cateres as $k => $v) {
            if($v['id'] == $pid){
                $arr[]=$v;
                $this->_getparentsid($cateres,$v['pid']);
            }
        }

        return $arr;
    }
    //获取指定id的下级分类包含[当前分类]
    public function getchild($cateid){
        $data=db('cate')->select();
        //当前id的分类信息
        $current=db('cate')->where('id','=',$cateid)->find();
        $current['level']=0;
        $attr[]=$this->_getchild($data,$cateid);
        //将当前分类添加到数组头部
        array_unshift($attr[0],$current);
        return $attr;
    }
    private function _getchild($data,$cateid,$level=1){
        static $arr=[];
        foreach ($data as $k => $v) {
            if($v['pid'] == $cateid){
                $v['level']=$level;
                $arr[]=$v;
                $this->_getchild($data,$v['id'],$level+1);
            }
        }
        return $arr;
    }
    //无线级分类排序
    public function catetree($data,$pid=0,$level=0){
        static $attr=[];
        foreach ($data as $k=>$v){
            if($v['pid']==$pid){
                $v['level']=$level;
                $attr[]=$v;
                $this->catetree($data,$v['id'],$level+1);
            }
        }
        return $attr;
    }
}
