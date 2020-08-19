<?php


namespace app\api\controller;
use think\Request;
use app\Api\controller\Aes;
use think\Cache;

class Member extends Base
{
    //会员中心
    public function index(){
        $result=$this->check();

        if($result['tcode']==1){
            $data=db('member')->field("telphone,id,image,nickname")->where('id','=',$result['uid'])->find();

            //过期需要重新刷新token
            return json(['tcode'=>1,'msg'=>'获取用户信息成功','data'=>$data]);
        }else{
            return json($result);
        }
    }
    //地址列表
    public function addressList(){
        $result=$this->check();
        if($result['tcode']==1) {
            $data = db('address')->where('uid', '=', $result['uid'])->select();

            //过期需要重新刷新token
            return json(['tcode' => 1, 'msg' => '获取用户信息成功', 'data' => $data]);
        }else{
            return json($result);
        }
    }
    //添加地址
    public function addressAdd(){
        $result=$this->check();
        if($result['tcode']==1) {
            $data['username']=input('username');
            $data['telphone']=input('telphone');
            $data['city']=input('city');
            $data['address']=input('address');
            $data['default']=input("default");
            $data['sex']=input("sex");
            if(!isset($data['username'])||!isset($data['telphone'])||!isset($data['city'])||!isset($data['address'])){
                return json(['code'=>0,'msg'=>"参数错误"]);
            }
            if($data['username']==''){
                return json(['code'=>0,'msg'=>"用户名不能为空"]);
            }
            if(!preg_match("/^04[0-9]{8}$/",$data['telphone'])){
                return json(['code'=>0,'msg'=>"手机格式有误"]);
            }
            if($data['city']==''){
                return json(['code'=>0,'msg'=>"请选择城市地址"]);
            }
            if($data['address']==''){
                return json(['code'=>0,'msg'=>"请输入详细地址"]);
            }
            $data['uid']= $result['uid'];
            if( $data['default']==1){
                db('address')->where('default','=',1)
                    ->where('uid','=',$data['uid'])
                    ->update(['default'=>0]);
            }
            $res=db('address')->insert($data);
            if($res){
                return json(['code'=>1,'msg'=>'添加地址成功']);
            }
        }else{
            return json($result);
        }
    }
    //编辑地址
    public function addressEdit(){
        $result=$this->check();
        if($result['tcode']==1) {
            $data['username']=input('username');
            $data['telphone']=input('telphone');
            $data['city']=input('city');
            $data['address']=input('address');
            $data['default']=input("default");
            $data['id']=input('id');
            $data['sex']=input('sex');

            if(!isset($data['username'])||!isset( $data['telphone'])||!isset( $data['city'])||!isset( $data['address'])){
                return json(['code'=>0,'msg'=>"参数错误"]);
            }
            if($data['username']==''){
                return json(['code'=>0,'msg'=>"用户名不能为空"]);
            }
            if(!preg_match("/^04[0-9]{8}$/",$data['telphone'])){
                return json(['code'=>0,'msg'=>"手机格式有误"]);
            }
            if($data['city']==''){
                return json(['code'=>0,'msg'=>"请选择城市地址"]);
            }
            if($data['address']==''){
                return json(['code'=>0,'msg'=>"请输入详细地址"]);
            }
            $data['uid']= $result['uid'];

            if( $data['default']==1){
                db('address')->where('default','=',1)
                    ->where('uid','=',$data['uid'])
                    ->update(['default'=>0]);
            }
            $res=db('address')->where('id','=',$data['id'])->update($data);
            if($res){
                return json(['code'=>1,'msg'=>'修改地址成功']);
            }
        }else{
            return json($result);
        }
    }
    //根据id获取地址信息
    public function getAddressInfo(){
        $result=$this->check();
        if($result['tcode']==1) {
            $id=input('id');
            $res=db('address')->where('id','=',$id)->find();
            if($res){
                return json(['code'=>1,'msg'=>'获取地址成功',"data"=>$res]);
            }else{
                return json(['code'=>0,'msg'=>'没有对于地址信息']);
            }
        }else{
                return json($result);
        }
    }
    //删除地址
    public function addressDel(){

        $result=$this->check();
        if($result['tcode']==1) {
            $id=input('id');
            $res=db('address')->where('id','=',$id)->delete();
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }
        }
    }
    //获取默认地址
    public function getOrderAddress(){
        $result=$this->check();

        if($result['tcode']==1) {
            $id=input('id');
            //当id存在时获取对应id数据
            if($id!=""){
                $addressById=db('address')->where('id','=',$id)->find();
                if($addressById){
                    return json(['code'=>1,'data'=>$addressById,'msg'=>'获取地址成功']);
                }
                return json(['code'=>0,'msg'=>'没有相关数据']);
            }

            //当id为空时获取默认地址或者其中一个地址

            $address=db('address')->where('uid','=',$result['uid'])->find();

            if(!$address){
                return json(['code'=>0,'msg'=>'没有相关数据']);
            }
            //有默认地址选择默认地址
            $defaultAddress=db('address')->where('uid','=',$result['uid'])->where('default','=',1)->find();
            if($defaultAddress){
                return json(['code'=>1,'data'=>$defaultAddress]);
            }
            return json(['code'=>1,'data'=>$address]);

        }
        return json($result);
    }
    //获取下单商品信息
    public function getBuyShopInfo(){
        $result=$this->check();
        if($result['tcode']==1) {
            $data=input('data');
            $product=[];
            $allprice=0;
            $allNum=0;
            foreach (json_decode($data) as $k=>$v){
                $product['shop'][]=db('product_attr')
                    ->alias('a')
                    ->join('product p','a.product_id=p.id')
                    ->where('a.id','=',$v->attrid)
                    ->field('p.title,p.mainimage,a.*')
                    ->find();
                $product['shop'][$k]['num']=$v->num;
                $allprice+=$product['shop'][$k]['price']*$product['shop'][$k]['num'];
                $allNum+=$product['shop'][$k]['num'];
            }
            $product['logistics']=db('logistics')->select();
            $product['all']['price']=$allprice;
            $product['all']['num']=$allNum;
            return json(["code"=>1,"data"=>$product]);
        }
        return json($result);
    }

    public function check(){
        $header=Request::instance()->header('token');//获取请求头中的token数据
        if($header==''){
            return ['tcode'=>0,'msg'=>'请先登录'];
        }
        $result=$this->checkToken($header);
        if($result['tcode']==3){
            return $result;
        }
        $uid=$result['data']->uid;//用户id
        if(Cache::get("token".$uid)!=$header){

            $TokenVal=[
                'uid'=>$uid,
                "expire"=>time()+60*60
            ];
            $setToken=$this->signToken($TokenVal);
            Cache::set("token".$uid,$setToken,300);

            return ['tcode'=>2,'msg'=>'token过期,刷新token','token'=>$setToken];
        }
        return ['tcode'=>1,'uid'=>$uid];
    }




    //下单
    public function order(){
        $result=$this->check();
        if($result['tcode']==1) {
            $num    = array();
            $attrid = array();
            $price=array();
            $orderShop   = json_decode(input('orderShop'));
            $attrDb=db('product_attr');
            foreach ($orderShop as $k => $v) {
                $num[]=$orderShop[$k]->num;
                $attrid[]=$orderShop[$k]->attrid;
                $temp=$attrDb->where('id','=',$orderShop[$k]->attrid)
                    ->field('price')
                    ->find();
                $price[]=$temp['price'];
            }
            $order['uid']=$result['uid'];
            $order['ordernum']=date('Ymd').time();
            $order['attrid']=implode(",",$attrid);
            $order['number']=implode(",",$num);
            $order['price']=implode(",",$price);
            $order['allprice']=input('price');
            $order['time']=time();


            $logistics=db('logistics')->where('id','=',input('logistics'))->find();

            $order['logistics']=$logistics['name'];
            $order['logisticsprice']=$logistics['price'];
            $address=db('address')->where('id','=',input('addressid'))->find();
            $order['username']=$address['username'];
            $order['telphone']=$address['telphone'];
            $order['city']=$address['city'];
            $order['address']=$address['address'];
            $order['message']=input('message');
            $order['status']=1;
            $result=db('order')->insertGetId($order);
            if($result){
                return json(['code'=>1,'msg'=>"下单成功","data"=>["id"=>$result]]);
            }else{
                return json(['code'=>0,'msg'=>"下单失败"]);
            }
        }
        return json($result);
    }
    //加入到购物车
    public function addCart(){
        $result=$this->check();
        if($result['tcode']==1) {
            $data['num']= input('num');
            $data['attrid'] = input('attrid');
            $data['uid'] =$result['uid'];
            //判断数据库是否有相应数据
            $hasData=db('cart')->where('uid','=',$result['uid'])->where('attrid','=', $data['attrid'])->find();
            if($hasData){
                $res=db('cart')->where('id','=',$hasData['id'])->update(['num'=>( $data['num']+$hasData['num'])]);
            }else{
                $res=db('cart')->insert($data);
            }
            if($res){
                return json(['code'=>1,"msg"=>'加入购物车成功']);
            }else{
                return json(['code'=>0,"msg"=>'加入购物车失败']);
            }
        }
        return json($result);
    }
    //获取购物车列表数据
    public function cartlist(){
        $result=$this->check();
        if($result['tcode']==1) {

            $res=db('cart')
                ->alias('c')
                ->join('product_attr a','a.id=c.attrid')
                ->join("product p",'p.id=a.product_id')
                ->field("c.id,c.attrid,c.flag,c.num,a.attr_0,a.attr_1,a.price,a.stock,p.mainimage,p.title")
                ->where('c.uid','=',$result['uid'])
                ->order("c.id asc")->select();

            if($res){
                return json(['code'=>1,'data'=>$res,'msg'=>"获取购物车成功"]);
            }else{
                return json(['code'=>0,'data'=>'','msg'=>'没有相关数据']);
            }
        }
        return json($result);
    }
    //根据id删除购物车数据
    public function delcart(){
        $result=$this->check();
        if($result['tcode']==1) {
            $id=input('id');
            $res=db('cart')->where('uid','=',$result['uid'])
                ->where('id','in',$id)
                ->delete();
            if($res){
                return json(['code'=>1,"msg"=>'删除购物车数据成功']);
            }else{
                return json(['code'=>0,"msg"=>'删除购物车数据失败']);
            }
        }
        return json($result);
    }
    //保存购物车数据
    public function savecart(){

        $result=$this->check();
        if($result['tcode']==1) {
            $data=json_decode(input('data'));
            $inserData=[];
            foreach ($data as $k=>$v){
                $inserData[$k]['num']=$data[$k]->num;
                $inserData[$k]['attrid']=$data[$k]->attrid;
                $inserData[$k]['uid']=$result['uid'];
                $inserData[$k]['flag']=$data[$k]->flag;
            }

            db('cart')->where('uid','=',$result['uid'])->delete();
            $res=db('cart')->insertAll($inserData);
            return json(['code'=>1,"msg"=>'保存成功']);
        }
        return json($result);
    }
    //订单列表接口
    public function orderlist(){
        //订单状态1表示待支付，2表示已支付/待发货，3表示已完成 4取消 0表示全部
        $result=$this->check();
        if($result['tcode']==1) {
            $status=input('status');
            if($status==0){
                $where=[];
            }else{
                $where=['status'=>$status];
            }
            $result=db('order')
                ->where('uid','=',$result['uid'])
                ->where($where)
                ->field('id as orderid,allprice,logisticsprice,status,time,number,allprice,price,attrid')
                ->paginate(10)
                ->each(function($item, $key){
                    $num = explode(',',$item['number'] );
                    $attrid = explode(',',$item['attrid'] );
                    $price = explode(',',$item['price'] );
                    $item['time']=date('Y-m-d h:i:s',$item['time']);
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
            if($result){
                return json(['code'=>1,"data"=>$result,'msg'=>'获取订单成功']);
            }else{
                return json(['code'=>0,'msg'=>'获取订单失败']);
            }

        }
        return json($result);
    }
    //订单详情接口
    public function orderdetail(){
        $result=$this->check();
        if($result['tcode']==1) {
            $orderid=input('orderid');
            $order=db('order')->where('id',$orderid)->find();
            $attrid=explode(',',$order['attrid']);
            $number=explode(',',$order['number']);
            foreach ($attrid as $k=>$v){
                $order['shop'][$k]=db('product_attr')
                    ->alias('a')
                    ->join('product p','p.id=a.product_id')
                    ->field('a.id as attrid,a.product_id,p.title,p.mainimage,a.attr_0,a.attr_1,a.price')
                    ->where('a.id',$v)->find();
                $order['shop'][$k]['number']=$number[$k];
            }
            return json(["code"=>1,"data"=>$order,'msg'=>'获取订单详情成功']);
        }
        return json($result);
    }
    //订单取消接口
    public function orderCancel(){
        $result=$this->check();
        if($result['tcode']==1) {
            $orderid=input('orderid');
            $cause=input('cause');
            $res=db('order')->where('id','=',$orderid)->update(['cause'=>$cause,'status'=>6]);
            if($res){
                return json(['code'=>1,'msg'=>'订单取消成功']);
            }else{
                return json(['code'=>0,'msg'=>'订单取消失败']);
            }
        }
        return json($result);
    }
    //订单确定收货，把订单3改成4
    public function orderDeliver(){
        $result=$this->check();
        if($result['tcode']==1) {
            $orderid=input('orderid');

            $res=db('order')->where('id','=',$orderid)->update(['status'=>4]);
            if($res){
                return json(['code'=>1,'msg'=>'确定收货成功']);
            }else{
                return json(['code'=>0,'msg'=>'确定收货失败']);
            }
        }
        return json($result);
    }

    //物流信息
    public function logistics(){
        $result=$this->check();
        if($result['tcode']==1) {
        $orderid = input('orderid');
        $logisticsnum=db('order')->where('id','=',$orderid)->field('logisticsnum')->find();
        $host = "https://kuaidi101.market.alicloudapi.com";
        $path = "/getExpress";
        $method = "GET";
        $appcode = "f9e8e734c49046a2838b9bd53ff70fc7";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "NO=".$logisticsnum["logisticsnum"]."&TYPE=auto";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $data=curl_exec($curl);
        return json(['code' => 1, 'data' => $data]);
        }
        return json($result);
//        $result=$this->check();
//        if($result['tcode']==1) {
//            $orderid = input('orderid');
//            $logisticsnum=db('order')->where('id','=',$orderid)->field('logisticsnum')->find();
//
//            $host    = "https://jisukdcx.market.alicloudapi.com";
//            $path    = "/express/query";
//            $method  = "GET";
//            $appcode = "f9e8e734c49046a2838b9bd53ff70fc7";
//            $headers = array();
//            array_push($headers, "Authorization:APPCODE " . $appcode);
////        $querys = "mobile=mobile&number=73124853607476&type=auto";
//            $querys = "mobile=mobile&number=".$logisticsnum["logisticsnum"]."&type=auto";
//            $bodys  = "";
//            $url    = $host . $path . "?" . $querys;
//
//            $curl = curl_init();
//            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
//            curl_setopt($curl, CURLOPT_URL, $url);
//            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//            curl_setopt($curl, CURLOPT_FAILONERROR, false);
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
////        curl_setopt($curl, CURLOPT_HEADER, true);
//            if (1 == strpos("$" . $host, "https://")) {
//                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//            }
//            $data = curl_exec($curl);
//            return json(['code' => 1, 'data' => $data]);
////        }
//        return json($result);



    }
    //获取支付信息
    public function payinfo(){
        $result=$this->check();
        if($result['tcode']==1) {
            $id=input('id');
            $res=db('order')
                ->where('id','=',$id)
                ->field('id,ordernum,allprice,time as start_time')
                ->find();
            if($res){
                $res['end_time']=$res["start_time"]+600;
                $res['end_time']=date("Y-m-d h:i:s",$res['end_time']);
                $res['start_time']=date("Y-m-d h:i:s",$res['start_time']);
                return json(['code'=>1,'data'=>$res,'msg'=>"获取订单成功"]);
            }else{
                return json(['code'=>0,'msg'=>"获取订单失败"]);
            }


        }
        return json($result);
    }
    //修改订单信息
    public function changPayInfo(){
        if(request()->isPost()){
            $result=$this->check();
            if($result['tcode']==1) {
                $id=input('id');
                $res=db('order')->where('id','=',$id)->find();
                if($res['status']!=1){
                    return json(['code'=>2,'msg'=>"订单已支付,请勿重复提交"]);
                }
                $data['paytype']=input('paytype');
                $data['paytime']=time();
                $data['status']=2;
                $upres=db('order')->where('id','=',$id)->update($data);
                if($upres){
                    return json(['code'=>1,'msg'=>'支付成功']);
                }else{
                    return json(['code'=>0,'msg'=>'支付失败']);
                }
            }
            return json($result);
        }

    }
    //设置昵称
    public function setNickname(){

        if(request()->isPost()){
            $result=$this->check();
            if($result['tcode']==1) {
                $nickname = input("nickname");
                $res=db('member')->where('id','=',$result['uid'])->update(['nickname'=>$nickname]);
                if($res){
                    return json(['code'=>1,"msg"=>"修改昵称成功"]);
                }
            }
            return json($result);
        }

    }
    //修改头像
    public function setHead(){

        $result=$this->check();

        if($result['tcode']==1||$result['tcode']==2) {


            $image = request()->file('image');


            $imgPath = '';
            if ($image) {
                $imgPath = $this->upload((object)$image, 'member');
            }

//
            $res = db('member')->where('id', '=', $result['uid'])->update(['image' => $imgPath]);
            if ($res) {
                return json(['code' => 1, 'msg' => '头像修改成功', 'image' => $imgPath]);
            }

        }
        return json($result);

    }


    public function cashpay(){

        $res=db('order')->where('id','=',input('orderid'))
            ->update(['status'=>2,'paytype'=>3,'paytime'=>time()]);
        
        //$pay=db('order')->where('id','=',input('orderid'))->find();

        $result['paytime']=time();

        if($res){
            return json(['code'=>1,"msg"=>'现金支付成功',"orderid"=>input('orderid'),"data"=>$result]);
        }else{
            return json(['code'=>0,"msg"=>'现金支付失败']);
        }

    }
}
