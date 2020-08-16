<?php
namespace app\admin\controller;

class Index extends Base
{
    public function index(){

        $this->assign('username',session('username'));
        $this->assign('userid',session('id'));
        return view();
    }
    public function console(){
        $article=db('article');
        $articleNum=$article->count();
        $todayArticle=$article->whereTime('data','today')->count();
        $product=db('product');
        $procductNum=$product->count();
        $todayProduct=$product->whereTime('data','today')->count();
        //dump($articleNum);
        $this->assign(array(
            'articleNum'=>$articleNum,
            'todayArticle'=>$todayArticle,
            'productNum'=>$procductNum,
            'todayProduct'=>$todayProduct
        ));
        return view();
    }
}