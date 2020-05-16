<?php

namespace app\controller;

use app\BaseController;

class GoodsController extends BaseController
{
    protected $table = 'goods';

    // 增加
    public function add()
    {

    }

    // 编辑
    public function edit()
    {

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
