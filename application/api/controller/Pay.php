<?php


namespace app\api\controller;


use AlipayTradeAppPayRequest;
use AopClient;

use app\api\controller\Wx;
use think\Controller;

class Pay extends Controller
{
    public function alipay(){
//        $result=$this->check();

//        if($result['tcode']==1) {

            require_once(EXTEND_PATH.'alipay/aop/AopClient.php');
            require_once(EXTEND_PATH.'alipay/aop/request/AlipayTradeAppPayRequest.php');

            // 获取支付金额
            $total = '0.1';
        $pay=db('order')->where('id','=',input('orderid'))->find();
//        echo $pay['ordernum'];

        $aop = new AopClient;
        $aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
        $aop->appId = "";
        $aop->rsaPrivateKey = '';
        $aop->format = "json";
        $aop->charset = "UTF-8";
        $aop->signType = "RSA2";
        $aop->alipayrsaPublicKey = '';

        //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay

            $request = new AlipayTradeAppPayRequest();

// 异步通知地址
//            $notify_url = urlencode($pay['alipay_url']);
//        $notify_url
// 订单标题
            $subject = '英特网络';
// 订单详情
            $body = 'DCloud致力于打造HTML5最好的移动开发工具，包括终端的Runtime、云端的服务和IDE，同时提供各项配套的开发者服务。';
// 订单号，示例代码使用时间值作为唯一的订单ID号
            $out_trade_no =time();
// dump($out_trade_no);
//SDK已经封装掉了公共参数，这里只需要传入业务参数
            $bizcontent = "{\"body\":\"" . $body . "\","
                . "\"subject\": \"" . $subject . "\","
                . "\"out_trade_no\": \"" . $out_trade_no . "\","
                . "\"timeout_express\": \"30m\","
                . "\"total_amount\": \"" . $total . "\","
                . "\"product_code\":\"QUICK_MSECURITY_PAY\""
                . "}";

            $request->setNotifyUrl($this->aliNotify());
            $request->setBizContent($bizcontent);

//这里和普通的接口调用不同，使用的是sdkExecute
            $response = $aop->sdkExecute($request);

// 注意：这里不需要使用htmlspecialchars进行转义，直接返回即可
            return $response;
//        }
//        return json($result);
    }
    public function aliNotify(){

        $out_trade_no=input('out_trade_no');
        db('order')->where('ordernum','=',$out_trade_no)
            ->update(['status'=>2,'paytype'=>1,'paytime'=>time()]);
    }
    public function wxpay(){

        require_once (EXTEND_PATH."wxpay/WxPay.Api.php");
        require_once (EXTEND_PATH."wxpay/WxPay.Data.php");
        // 获取支付金额


        $total = 200;

        // 商品名称
        $subject = 'DCloud项目捐赠';
        // 订单号，示例代码使用时间值作为唯一的订单ID号
        $out_trade_no = date('YmdHis', time());

        $unifiedOrder = new \WxPayUnifiedOrder();
        $unifiedOrder->SetBody($subject);//商品或支付单简要描述
        $unifiedOrder->SetOut_trade_no($out_trade_no);
        $unifiedOrder->SetTotal_fee($total);
        $unifiedOrder->SetTrade_type("APP");

        $pay=db('pay')->where('id','=',1)->find();

        $config['wxpay_appid']=$pay['wxpay_appid'];
        $config['wxpay_mchid']= $pay['wxpay_mchid'];
        $config['wxpay_url']=$pay['wxpay_url'];

        $result = \WxPayApi::unifiedOrder($unifiedOrder,$config);
        if(is_array($result)) {
//            print_r(json_encode($result)) ;
            $result['sign']=mb_substr($result['sign'],0,30);
            echo json_encode($result);
        }


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
