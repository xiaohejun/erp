<?php
namespace app\validate;

use think\Validate;

class UserValidate extends Validate
{
    protected $rule = [
        'username'   => '',
        'password'   => '', 
        'role'       => '', 
        'name'       => '', 
        'job_number' => '', 
        'sex'        => '', 
        'phone'      => '', 
        'address'    => ''
    ];

    protected $message  =   [
        'id.require'   => 'Id is required.'
    ];
}