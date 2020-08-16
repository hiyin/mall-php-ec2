<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/4 0004
 * Time: 下午 12:09
 */

namespace app\api\controller;
use \Firebase\JWT\JWT;


use think\Controller;
use think\Request;
use Qcloud\Sms\SmsSingleSender;
use think\Cache;
class Base extends Controller
{
    public  function  __construct(Request $request = null)
    {
//      header('Access-Control-Allow-Origin:*');
        header('Content-Type: text/html;charset=utf-8');
        header('Access-Control-Allow-Origin:*'); // *代表允许任何网址请求
        header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); // 允许请求的类型
        header('Access-Control-Allow-Credentials: true'); // 设置是否允许发送 cookies
        header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,token,X-Requested-with, Origin'); // 设置允许自定义请求头的字段
        parent::__construct($request);
    }

    public  function index(){


    }
    public function getToken(){
        $data['time']=input('time');
//        if((time()-$data['time'])>60)//提交时间与当前时间大于60秒时
//        {
//            return json(['code'=>400,'msg'=>'时间超时']);
//        }
        //第一次获取token时
        $data['token']=md5(uniqid());

        $res=db('token')->where('id',1)->update($data);
//        $redis=new Cache;
//        $redis->set('token',$data['token']);
//        $redis->set('time',$data['time']);

        if($res){
            return json(['code'=>200,'data'=>$data,'msg'=>'获取token成功']);
        }else{
            return json(['code'=>400,'msg'=>'获取token失败']);
        }
    }


    //    发送消息
    public function smsSend($telphone){
        // $appid $appkey $templateId $smsSign为官方demo所带，请修改为你自己的
        // 短信应用SDK AppID
        $appid = 1400135731;
        // 短信应用SDK AppKey
        $appkey = "328ff4cfe4d29623934204aa91467219";
        // 你的手机号码。
        $phoneNumber = $telphone;
        // 短信模板ID，需要在短信应用中申请
        $templateId = 185438;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
        // 签名
        $smsSign = "英特net"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
        // 短信模板 ID，需要在短信控制台中申请

        // 单发短信
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $code=rand(1000,9999);
            $params = [$code];

            Cache::set($telphone,$code,300);


            $result = $ssender->sendWithParam("61", $phoneNumber, $templateId,$params, $smsSign, "", "");
////            $rsp = json_decode($result);

            echo $result;


        } catch(\Exception $e) {
            echo var_dump($e);
        }

    }

    /*
         * 生成token
         * 接口地址：http://www.mall.com/api/login/signToken
         * 验证码接口地址：http://www.mymall.com/captcha.html
         */
    public function signToken($token)
    {

        $key = "huang";  //这里是自定义的一个随机字串，应该写在config文件中的，解密时也会用，相当    于加密中常用的 盐  salt
//        $token = [
//            "nbf" => time()+100, //在什么时候jwt开始生效  （这里表示生成100秒后才生效）
//            "exp" => time()+7200, //token 过期时间
//            "uid" => 123 //记录的userid的信息，这里是自已添加上去的，如果有其它信息，可以再添加数组的键值对
//        ];
        $jwt = JWT::encode($token,$key,"HS256"); //根据参数生成了 token
        return $jwt;

    }
    /*
  * 生成token
  * 接口地址：http://www.mall.com/api/login/deToken
  * 验证码接口地址：http://www.mymall.com/captcha.html
  */
//验证token
    public function checkToken($jwt)
    {
//        $jwt="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiIiLCJhdWQiOiIiLCJpYXQiOjE1ODE3MzkxNzYsIm5iZiI6MTU4MTczOTI3NiwiZXhwIjoxNTgxNzQ2Mzc2LCJ1aWQiOjEyM30.2V3aplaBOVweBkTLcYDMlwDpjEDSMy0ruZGHrjZJK_4";
        $key = "huang";  //上一个方法中的 $key 本应该配置在 config文件中的

        try{
            $Result = $info = JWT::decode($jwt,$key,["HS256"]); //解密jwt
            return ["tcode"=>1,'data'=>$Result];
        }
        catch(\Exception $exception){//如果解密失败，或者超过有效期则die
            return ['tcode'=>3,'msg'=>'token失效,请重新登陆'];
            die();
        }

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

}
