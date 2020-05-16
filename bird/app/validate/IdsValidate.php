<?php
namespace app\validate;

use think\Validate;

class IdsValidate extends Validate
{
    protected $rule = [
        'ids'  =>  'require',
    ];

    protected $message  =   [
        'ids.require'   => 'Ids is required.'
    ];
}