<?php

namespace app\controller;

use app\BaseController;
use app\model\User;
use think\Facade\Db;
use app\validate\EditUserValidate;
use app\validate\AddUserValidate;
use think\facade\Session;

class UserController extends BaseController
{
    protected $table = 'user';

    public function login()
    {   
        $data = $this->request->post();        
        $username = $data["username"];
        $password = $data["password"]; 
        $res = Db::name('user')->where('username', $username)->findOrEmpty();
        if($res != [] && $res['password'] == $password) {
            $res['password'] = '';
            Session::set('userinfo', $res);
            return $this->success_msg($res,  'login successful.');
        }
        return $this->info_msg([], 'Incorrect username or password.');
    }

    public function get_login_user()
    {
        return $this->success_msg(Session::get('userinfo'), 'success');
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
        return $this->base_query($this->table, $this->request->post());
    }
}
