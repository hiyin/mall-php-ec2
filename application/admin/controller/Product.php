<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10 0010
 * Time: 上午 10:02
 */

namespace app\admin\controller;


class Product extends Base
{
    //商品列表
    public function index(){
        $product=db('product')
            ->field('p.*,c.catename')
            ->alias('p')
            ->join('cate c','c.id=p.pid')
            ->select();
        //获取分类列表
        $this->getCate();
        $this->assign('product',$product);
        return view('product_list');
    }
    //商品选择弹窗列表
    public function selectShop(){
        $porduct=db('product')->paginate(5);
        $this->assign('proudct',$porduct);
        return view('select_shop');
    }
    //添加商品
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            //处理商品基本信息并添加到数据库
            $product=$this->product($data);
            db('product')->insert($product);
            //添加其他主图信息
            $productId = db('product')->getLastInsID();
            $this->productImg($productId,1);
           //添加商品属性
            $this->productAttr($data,$productId,1);
            //添加商品规格
            $this->productSpec($data,$productId,1);
            $this->success('添加成功','product/index');
        }
        //获取分类列表
        $this->getCate();
        //获取所以服务
        $service=db('product_service')->field('id,title')->select();
        $this->assign('service',$service);
        return view('product_add');
    }
    //编辑商品
    public function edit(){
        $id=input('id');
        if(request()->isPost()){
            $data=input('post.');
            //处理商品基本信息并修改到数据库
            $product=$this->product($data);
            db('product')->where('id','=',$id)->update($product);
            //添加其他主图信息
            $productId = db('product')->getLastInsID();
            $this->productImg($id,2);
            //添加商品属性
            $this->productAttr($data,$id,2);
            //添加商品规格
            $this->productSpec($data,$id,2);
            $this->success('修改成功','product/index');
        }

        $this->getEditData($id);
        $this->getCate();
        //获取所以服务
        $service=db('product_service')->field('id,title')->select();
        $this->assign('service',$service);
        return view('product_edit');
    }
    //删除商品
    public function del(){
        $id=input('id');
        $uploadPath='.'.config('view_replace_str')['__UPLOADS__'].'/';
        //删除主图
        $mainimage=db('product')->field('mainimage')->where('id',$id)->find();
        @unlink($uploadPath.$mainimage['mainimage']);
        //删除其他主图
        $othermain=db('product_image')->where('product_id',$id)->select();
        foreach ($othermain as $k=>$v){
            @unlink($uploadPath.$othermain[$k]['othermain']);
        }

        //删除商品基本信息
        db('product')->where('id',$id)->delete();
        //删除其他主图信息
        db('product_image')->where('product_id',$id)->delete();
        //删除属性
        db('product_attr')->where('product_id',$id)->delete();
        //删除规格
        db('product_spec')->where('product_id',$id)->delete();
        $this->success('删除成功','product/index');
    }
    //获取编辑数据
    public function getEditData($id){
        $product=db('product')->where('id','=',$id)->find();
        $productimg=db('product_image')->where('product_id','=',$id)->select();
        $productspec=db('product_spec')->where('product_id','=',$id)->select();
        //获取分类属性id并获取对应的属性值
        //$cateattr=db('attr')->where('id','in',explode(',',$product['attr_id']))->select();
        $attrDb=db('attr');
        //获取所有当前分类属性
        $cateAllAttr=$attrDb->where('cateid','=',$product['pid'])->select();
        //获取选中的分类属性
        $attrid=explode(',',$product['attr_id']);
        $checkAttrId=[];
        foreach ($attrid as $k=>$v){
            $cateattr[$k]=$attrDb->where('id','=',$v)->find();
            if(isset( $cateattr[$k])){
                $cateattr[$k]['attr_value']=explode('|',$cateattr[$k]['attrvalue']);
                $checkAttrId[$k]= $cateattr[$k]['id'];
            }
        }

        //获取选中的属性值
        $productattr=db('product_attr')->where('product_id','=',$id)->order('id asc')->select();
        $checkValue['attr_0']=[];
        $checkValue['attr_1']=[];
        foreach ($productattr as $k=>$v){
            if(!in_array($productattr[$k]['attr_0'],$checkValue['attr_0'])){
                $checkValue['attr_0'][]=$productattr[$k]['attr_0'];
            }
            if(!in_array($productattr[$k]['attr_1'],$checkValue['attr_1'])){
                $checkValue['attr_1'][]=$productattr[$k]['attr_1'];
            }
        }
        $this->assign([
            'product'=>$product,
            'productimg'=>$productimg,
            'productattr'=>$productattr,
            'productspec'=>$productspec,
            'cateattr'=>$cateattr,
            'cateAllAttr'=>$cateAllAttr,
            'checkAttrId'=>$checkAttrId,
            'checkValue'=>$checkValue,
            'checkSevice'=>explode(',',$product['service'])
        ]);
    }
    //处理商品基本信息
    public function product($data){
        //添加商品基本信息
        $product['pid']=$data['pid'];
        $product['title']=$data['title'];
        $product['smalltitle']=$data['smalltitle'];
        $product['tag']=$data['tag'];
        $product['recommended']=$data['recommended'];
        $product['summary']=$data['summary'];
        $product['content']=$data['content'];
        if(isset($data['attr_id'])){
            $product['attr_id']=$data['attr_id'];
        }
        $product['price']=$data['base_price'];
        $product['market_price']=$data['market_price'];
        $product['data']=time();
        $mainimage=request()->file('mainimage');
        if($mainimage){
            $product['mainimage']=$this->upload($mainimage,'product');
        }
        //处理商品服务信息
        $product['service']=implode(',',$data['service']);
        return $product;
    }

    //处理主图信息type=1表示添加操作,type==2表示编辑操作
    public function productImg($id,$type=1){
        $othermain=request()->file('othermain');
        if($othermain){
            foreach ($othermain as $k=>$v){
                $productimg[$k]['product_id']=$id;
                $productimg[$k]['othermain']=$this->upload($othermain[$k],'product');
            }
            if($type==2){
                db('product_image')->where('product_id','=',$id)->delete();
            }
            db('product_image')->insertAll($productimg);
        }
    }
    //处理商品属性type=1表示添加操作,type==2表示编辑操作
    public function productAttr($data,$id,$type=1){
        if(isset($data['attr_0'])){
            foreach ($data['attr_0'] as $k=>$v){
                $productAttr[$k]['attr_0']=$data['attr_0'][$k];
                if(isset($data['attr_1'][$k])) {
                    $productAttr[$k]['attr_1'] = $data['attr_1'][$k];
                }
                $productAttr[$k]['price']=$data['price'][$k];
                $productAttr[$k]['stock']=$data['stock'][$k];
                $productAttr[$k]['product_num']=$data['product_num'][$k];
                $productAttr[$k]['remark']=$data['remark'][$k];
                $productAttr[$k]['product_id']=$id;
            }
            //编辑操作
            if($type==2){
                db('product_attr')->where('product_id','=',$id)->delete();
            }
            db('product_attr')->insertAll($productAttr);
        }
    }
    //处理商品规格type=1表示添加操作,type=2表示编辑操作
    public function productSpec($data,$id,$type=1){
        if(isset($data['specname'])){
            foreach ($data['specname'] as $k=>$v){
                $productspec[$k]['specname']=$data['specname'][$k];
                $productspec[$k]['specvalue']=$data['specvalue'][$k];
                $productspec[$k]['product_id']=$id;
            }
            //编辑操作
            if($type==2){
                db('product_spec')->where('product_id','=',$id)->delete();
            }
            db('product_spec')->insertAll($productspec);
        }
    }
    //获取所有分类
    function getCate(){
        $cate=db('cate')->select();
        $this->assign('cate',$cate);
    }
    //根据分类id选择对应属性接口
    public function getAttrByCateId(){
        if(request()->isPost()){
            $data=input('post.');
            $attr=db('attr')->where('cateid','=',$data['cateid'])->select();
            return json($attr);
        }
    }
    //产品服务添加
    public function serviceAdd(){
        if(request()->isPost()){
            $data=input('post.');
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'product_service');
            }
            $result=db('product_service')->insert($data);
            if($result){
                $this->success('添加成功','product/serviceList');
            }else{
                $this->error('添加失败');
            }

        }
        return view('product_service_add');
    }
    //产品服务列表
    public function serviceList(){
        $service=db('product_service')->select();
        $this->assign('service',$service);
        return view('product_service_list');
    }
    //产品服务修改
    public function  seviceEdit(){
        $id=input('id');
        $serviceDb=db('product_service');
        if(request()->isPost()){
            $data=input('post.');
            $image=request()->file('image');
            if($image){
                $data['image']=$this->upload($image,'product_service');
            }
            $result=$serviceDb->where('id',$id)->update($data);
            if($result){
                $this->success('修改成功','product/serviceList');
            }else{
                $this->error('修改失败');
            }
        }
        $service=$serviceDb->where('id',$id)->find();
        $this->assign('service',$service);
        return view('product_service_edit');
    }
    //产品服务删除
    public function  seviceDel(){
        $id=input('id');
        $result=db('product_service')->where('id',$id)->delete();
        if($result){
            $this->success('删除成功','product/serviceList');
        }else{
            $this->error('删除失败');
        }
    }
}
