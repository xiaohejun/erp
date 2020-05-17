<?php

namespace app\controller;

use app\BaseController;
use think\Request;
use app\model\User;
use app\validate\UserValidate;
use app\validate\EditUserValidate;
use app\validate\AddUserValidate;


class UserController extends BaseController
{
    protected $table = 'user';

    public function login()
    {   
        $data = $this->request->post();
        
        print_r( $data);
        // 构造json
        // $data = [
        //     'error' => 'None',
        //     'data' => [
        //         'email'    => 'thinkphp@qq.com',
        //         'nickname '=> '流年',
        //     ],
        //     'msg' => 'None'
        // ];
        return json($data);
    }

    // 增加
    public function add()
    {
        return $this->base_add($this->table, $this->request->post(), AddUserValidate::class);
    }

    
    // 删除
    public function delete()
    {
        return $this->base_delete($this->table, $this->request->post());
    }

    // 编辑
    public function edit()
    {
        return $this->base_edit($this->table, $this->request->post(), EditUserValidate::class);
    }


    // 详情，查询单个
    public function detail()
    {
        return $this->base_detail($this->table, $this->request->post());
    }

    // 模糊查询，分页
    public function query()
    {
        
    }
}
