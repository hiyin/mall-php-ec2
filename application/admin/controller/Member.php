<?php


namespace app\admin\controller;


class Member extends Base
{

    public function index()
    {
        $admin=db('member')->paginate(10);
        $this->assign('admin',$admin);
        return view('member_list');
    }
}
