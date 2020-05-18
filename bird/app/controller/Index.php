<?php

namespace app\controller;

use app\BaseController;


class Index
{

    public function index()
    {   
        return view('/webapp/index');
    }

    public function welcome()
    {   
        return view('/webapp/welcome');
    }

    public function staff_manage()
    {
        return view("/webapp/user/staff_manage");
    }

    public function user_info()
    {
        return view("/webapp/user/user_info");
    }

    public function competitor_manage()
    {
        return view("/webapp/company/competitor_manage");
    }

    public function customer_manage()
    {
        return view("/webapp/company/customer_manage");
    }

    public function company_info()
    {
        return view("/webapp/company/company_info");
    }
    
}
