<?php


namespace app\admin\controller;


class Order extends Base
{
    public function index(){
        $order=db('order')->paginate(8)
            ->each(function($item, $key){
                $num = explode(',',$item['number'] );
                $attrid = explode(',',$item['attrid'] );
                $price = explode(',',$item['price'] );
                $allnum=0;
                foreach ($num as $k=>$v){

                    $shop[$k]=db('product_attr')->alias('a')
                        ->join('product p','p.id=a.product_id')
                        ->field('a.id as attrid,p.title,p.mainimage,a.attr_0,a.attr_1')
                        ->where('a.id','=',$attrid[$k])->find();
                    $shop[$k]['num']=$num[$k];
                    $shop[$k]['attrid']=$attrid[$k];
                    $shop[$k]['price']=$price[$k];
                    $allnum+=$num[$k];
                }
                $item['allnum']=$allnum;
                $item['shop']=$shop;
                return $item;
            });

        $this->assign('order',$order);
        return view("order_list");
    }
    public function  deliver(){
        $id=input('id');
        if(request()->isPost()){
            $logisitcs=input('logisitcs');
            $res=db('order')->where('id','=',$id)->update(['logisticsnum'=>$logisitcs,'status'=>3]);
            if($res){
                $this->success('发货成功','order/index');
            }else{
                $this->error('发货失败');
            }
        }


        $logisitcs=db('order')->where('id','=',$id)->field('logistics')->find();
        $this->assign('logisitcs',$logisitcs);

        return view('deliver');
    }
}
