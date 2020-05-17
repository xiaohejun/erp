<?php
namespace app\validate;

use think\Validate;

class EditUserValidate extends Validate
{
    protected $rule = [
        'id'  =>  'require',
    ];

    protected $message  =   [
        'id.require'   => 'Id is required.'
    ];
}