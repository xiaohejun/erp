<?php
namespace app\validate;

use think\Validate;

class UserValidate extends Validate
{
    protected $rule = [
        'username'   => 'require',
        'password'   => 'require', 
        'role'       => 'require', 
        'name'       => 'require', 
        'job_number' => 'require', 
        'sex'        => 'require', 
        'phone'      => 'require', 
        'address'    => 'require'
    ];

    protected $message  =   [
        'username.require'   => 'username is required.',
        'password.require'   => 'password is required.',
        'role.require'   => 'role is required.',
        'name.require'   => 'name is required.',
        'job_number.require'   => 'job_number is required.',
        'sex.require'   => 'sex is required.',
        'phone.require'   => 'phone is required.',
        'address.require'   => 'address is required.'
    ];
}