<?php

namespace app\controller;

use app\BaseController;
use app\model\Company;
use app\validate\EditCompanyValidate;
use app\validate\AddCompanyValidate;


class CompanyController extends BaseController
{
    protected $table = 'company';

    // 增加
    public function add()
    {
        return $this->base_add($this->table, $this->request->post(), AddCompanyValidate::class);
    }

    
    // 删除
    public function delete()
    {
        return $this->base_delete($this->table, $this->request->post());
    }

    // 编辑
    public function edit()
    {
        return $this->base_edit($this->table, $this->request->post(), EditCompanyValidate::class);
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
