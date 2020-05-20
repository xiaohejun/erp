<?php

namespace app\controller;

use app\BaseController;
use app\model\Bid;
use app\validate\AddBidValidate;

class BidController extends BaseController
{
    protected $table = 'bid';

    // 增加
    public function add()
    {
        return $this->base_add($this->table, $this->request->post(), AddBidValidate::class);
    }

    // 模糊查询，分页
    public function query()
    {
        return $this->base_query($this->table, $this->request->post());
    }
}
