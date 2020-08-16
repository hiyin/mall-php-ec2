<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/4 0004
 * Time: 下午 12:09
 */

namespace app\api\controller;
use app\Api\controller\Aes;
use think\Cache;
class Index extends Base
{
/*
 * 网站首页接口
 * 地址:http://www.mall.com/api/index
 * 请求方式Get
 */
   public function index(){
       if(request()->isGet()) {
            //获取轮播图信息
           $index['banner'] = db('banner')->select();
           //获取活动信息
           $index['active'] = db('active')->select();
            // 获取图标信息
           $index['icon'] = db('icon')->select();
            //获取楼层信息
           $index['floor']= db('floor')->select();
           //获取首页推荐信息
           $index['recommend_cate']=db('cate')->limit(4)->where('recommend',1)->field('id,catename')->select();
           $productDb=db('product');
           $cateContent=db('cate_content');
           foreach ($index['recommend_cate'] as $k=>$v){
               $index['cate'][$k]['content']=$cateContent->where('cateid',$v['id'])->select();
               $index['cate'][$k]['product']=$productDb
                   ->field('id,smalltitle,mainimage,tag,summary,price')
                   ->where('recommended',1)
                   ->where('pid',$v['id'])
                   ->limit(6)
                   ->select();
           }


          return json(['code' => 1,'msg'=>'success','data' => $index]);

       }else{
           return json(['code'=>0,'msg'=>'请求方式出错']);
       }
   }
   //根据id获取推荐分类数据
    public function getRecInfo(){
       $id=input('id');
        $cate=db('cate')->where('id','=',$id)->field('image')->find();
       $data['product']=db('product')
           ->field('summary,mainimage,smalltitle,id,price,tag')
           ->where('pid','=',$id)
           ->limit(10)
           ->select();
        $data['image']=$cate['image'];

       return json(['code'=>1,'data'=>$data]);
    }

   /*
  * 详情接口
  * 地址:http://www.mall.com/api/index/detail/id/:id
  * 请求方式Get
  */
   public function detail(){
        if(request()->isGet()){
            $id=input('id');
            $product=db('product')->where('id',$id)->find();
            $product['attr']=db('product_attr')->where('product_id',$id)->select();
            $product['image']=db('product_image')->field("othermain as image")->where('product_id',$id)->select();
            array_unshift($product['image'],["image"=>$product['mainimage']]);
            $product['spec']=db('product_spec')->where('product_id',$id)->select();

            //获取选中的值
            $checkValue['attr_0']=[];
            $checkValue['attr_1']=[];
            foreach ($product['attr'] as $k=>$v){
                if(!in_array($v['attr_0'],$checkValue['attr_0'])){
                    $checkValue['attr_0'][]=$v['attr_0'];
                }
                if(!in_array($v['attr_1'],$checkValue['attr_1'])){
                    $checkValue['attr_1'][]=$v['attr_1'];
                }
            }
            //获取分类属性
            $attr_id=explode(',',$product['attr_id']);
            $attrDb=db('attr');
            foreach($attr_id as $k=>$v){
                $attr[$k]=$attrDb->where('id',$v)->field('attrname')->find();
                $attr[$k]['value']=$checkValue['attr_'.$k];
            }
            $product['checkAttr']=$attr;
            //获取服务列表
            $service=explode(',',$product['service']);

            $product['servicelist']=db('product_service')->where('id','in',$service)->select();

            return json(['code' => 1,'msg'=>'success','data' => $product]);

        }else{
            return json(['code'=>0,'msg'=>'请求方式出错']);
        }
   }
    /*
   * 分类接口
   * 地址:http://www.mall.com/api/index/cate
   * 请求方式Get
   */
    public function cate(){
        if(request()->isGet()){

            $cate=db('cate')->select();
            $productDb=db('product');
            foreach ($cate as $k=>$v){
                $cate[$k]['product']=$productDb->where('pid',$v['id'])->field('id,smalltitle,mainimage,price,sale')->limit(5)->select();
            }
            return json(['code' => 1,'msg'=>'success','data' => $cate]);

         }else{
            return json(['code'=>0,'msg'=>'请求方式出错']);
        }

    }
    /*
   * 列表接口
   * 地址:http://www.mall.com/api/index/catelist/id/:id/page/1
   * 如：http://www.mall.com/api/index/catelist/id/1/page/3
   * 请求方式Get
   */
    public function catelist(){
        $id=input('id');
        if(request()->isGet()){

            $cate=db('cate')->where('id',$id)->find();
            $productDb=db('product');

            $cate['product']=$productDb->where('pid',$id)->field('id,smalltitle,mainimage,summary,tag,price')
                    ->paginate(4);

            return json(['code' => 1,'msg'=>'success','data' => $cate]);

        }else{
            return json(['code'=>0,'msg'=>'请求方式出错']);
        }
    }
    /*
  * 热门搜索接口
  * 地址:http://www.mall.com/api/index/search
  * 请求方式Get
  */
    public function search(){
        if(request()->isGet()){
            $search=db('search')->select();
            return json(['code' => 1,'msg'=>'success','data' => $search]);
        }else{
            return json(['code'=>0,'msg'=>'请求方式出错']);
        }
    }
    /*
* 热门搜索添加到接口
* 地址:http://www.mall.com/api/index/search_history/keyword/:keyword
* 数据:keyword:''
* 请求方式Get
*/
    public  function  search_history(){
       $keyword=input('keyword');
       $historyDb=db('search_history');
       $result=$historyDb->where('keyword',$keyword)->find();
       if($result){
           $historyDb->where('id',$result['id'])->update(['count'=>$result['count']+1]);
       }else{
           $historyDb->insert(['keyword'=>$keyword]);
       }
       return json(['code'=>1,'msg'=>'添加成功']);
    }
    /*
* 热门搜索添加到接口
* 地址:http://www.mall.com/api/index/search_list/keyword/:keyword
* 数据:keyword:''
* 请求方式Get
*/
    public  function  search_list(){
        $keyword=input('keyword');
        $type=input('type');
        if($type==''||!isset($type)){
            $type=1;
        }
        $oreder=[];
        //desc降序，asc升序

        switch ($type){
            case 1:
                $order=["id"=>'desc'];
                break;
            case 2:
                $order=["price"=>'asc'];
                break;
            case 3:
                $order=["price"=>'desc'];
                break;
            case 4:
                $order=["sale"=>'desc'];
                break;
            default:
                $order=["id"=>'desc'];
                break;
        }



        $data=db('product')
            ->field('id,price,title,mainimage,smalltitle,summary,sale,tag')
            ->where('title&smalltitle','like','%'.$keyword.'%')
            ->order($order)
            ->paginate(10);
        return json(['code'=>1,"data"=>$data]);

    }

    /*
* 购物车数据接口
* 地址:http://www.mall.com/api/index/cart
* 数据:cart:''
* 请求方式Get
*/
    public function cart(){
        $data=input('cart');
        //$cart=json_decode('[{"id":53,"num":1},{"id":51,"num":1}]',true);

        $cart=json_decode($data,true);
        $productAttrDb=db('product_attr');
        $productDb=db('product');

        $cartlist=[];
       foreach((array)$cart as $k=>$v){
           $cartlist[$k]=$productAttrDb->where('id',$v['id'])->find();
           $cartlist[$k]['attr_value']=$cartlist[$k]['attr_0'].$cartlist[$k]['attr_1'];
//           $cartlist[$k]['num']=$v['num'];
           $product=$productDb->where('id',$cartlist[$k]['product_id'])->field('title,mainimage')->find();
           $cartlist[$k]['title']=$product['title'];
           $cartlist[$k]['mainimage']=$product['mainimage'];
           $cartlist[$k]['check']=false;
       }
       return json($cartlist);
    }
    //aes测试
    public function test(){


        $key=config('config')['aesKey'];
        dump($key);
        $aes = new AES($key);
        $a= $aes->encode("Aes加解密测试 ok!");
        dump($a);
        $aes->decode($a);
        dump($aes->decode($a));


    }
//    用户注册
    public function register(){

        $data=input('post.');



        if(!isset($data['telphone'])||!isset($data['password'])||!isset($data['code'])){
            return json(['code'=>0,'msg'=>"参数错误"]);
        }
        if(!preg_match("/^04[0-9]{8}$/",$data["telphone"])){
            return json(['code'=>0,'msg'=>"手机格式有误"]);
        }
        if(strlen($data['password']<6)){
            return json(['code'=>0,'msg'=>"密码长度必须大于6位"]);
        }



        if(Cache::get($data['telphone'])!=$data['code']){
            return json(['code'=>0,'msg'=>"验证码有误"]);
        }
        //判断用户是否存在
        $result=db('member')->where('telphone','=',$data['telphone'])->find();
        if($result){
            return json(['code'=>0,'msg'=>"用户名已存在"]);
        }else{
            unset($data['code']);
            $data['time']=time();
            $data['password']=md5($data['password']);
            db('member')->insert($data);
            return json(['code'=>1,'msg'=>"注册成功"]);
        }

    }
//   获取短信验证码
    public function getSmsCode(){
        $telphone=input('telphone');
        $this->smsSend($telphone);

    }
    //用户登录
    public function login(){

        $telphone=input('telphone');
        $password=input('password');
        if(!isset($telphone)||!isset($password)){
            return json(['code'=>0,'msg'=>"参数错误"]);
        }
        if(!preg_match("/^04[0-9]{8}$/",$telphone)){
            return json(['code'=>0,'msg'=>"手机格式有误"]);
        }
        if(strlen($password)<6){
            return json(['code'=>0,'msg'=>"密码长度必须大于6位"]);
        }
        $result=db('member')->where('telphone','=',$telphone)->find();

        if(!$result){
            return json(['code'=>0,'msg'=>"用户名不存在"]);
        }
        if($result['password']!=md5($password)){
            return json(['code'=>0,'msg'=>"用户名或密码不正确"]);
        }
        $data=[
            'uid'=>$result['id'],
            "expire"=>time()+60*60
        ];

        $token=$this->signToken($data);
        Cache::set('token'.$result['id'],$token,10000);

        return json([
            'code'=>1,
            'data'=>["token"=>$token],
            "msg"=>'登录成功'
        ]);


    }
}
