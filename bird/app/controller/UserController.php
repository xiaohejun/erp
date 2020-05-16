<?php

namespace app\controller;

use app\BaseController;
use think\Request;
use app\model\User;
use app\validate\UserValidate;


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
        return $this->base_detail($this->table, $this->request->post());
    }

    // 编辑
    public function edit()
    {
        $data = $this->request->post();
        // 验证数据

        $user = User::findOrEmpty($data['id']);
        if($user->isEmpty())
        {
            return $this->info_msg([], 'No corresponding user found, forbidden to modify.');
        }
        $res = $user->save($data);
        if($res)
        {
            return $this->success_msg($user, 'User edited successfully.');
        }
        return $this->error_msg($user, 'Edit user failed.');
    }

    // 删除
    public function delete()
    {
        
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
