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
        return view("/webapp/staff/staff_manage");
    }

    public function staff_info()
    {
        return view("/webapp/staff/staff_info");
    }

    public function competitor_manage()
    {
        return view("/webapp/competitor/competitor_manage");
    }

    public function competitor_info()
    {
        return view("/webapp/competitor/competitor_info");
    }
    
}
