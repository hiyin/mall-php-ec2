<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9 0009
 * Time: 上午 11:32
 */

namespace app\admin\validate;


use think\Validate;

class Banner extends Validate
{
    protected $rule =   [
        'title'=> 'require|unique:banner',
        'link' => 'require',
    ];

    protected $message  =   [
        'title.require' => '名称不能为空',
        'title.unique'  => '名称已存在',

        'link.require'  => '链接地址不能为空',

    ];
    protected $scene = [
        'add'  =>  ['title','image','link'],
        'edit'  =>  ['title'=>'require','link'],
    ];
}