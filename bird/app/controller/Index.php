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

    public function staff_info_manage()
    {
        return view("/webapp/staff_info_manage");
    }

    public function staff_info()
    {
        return view("/webapp/staff_info");
    }
    
}
