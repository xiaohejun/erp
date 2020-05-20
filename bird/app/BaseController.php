<?php
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;
use think\Facade\Db;
use app\validate\IdValidate;
use app\validate\IdsValidate;
use app\validate\EditUserValidate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

    protected function response_msg($status, $data, $msg)
    {
        return json([
            'status' => $status,
            'data'  => $data,
            'msg'   => $msg
        ]);
    }

    protected function error_msg($data, $msg)
    {
        return $this->response_msg('error', $data, $msg);
    }

    protected function success_msg($data, $msg)
    {
        return $this->response_msg('success', $data, $msg);
    }

    protected function info_msg($data, $msg)
    {
        return $this->response_msg('info', $data, $msg);
    }

    // 增
    protected function base_add($table, $data, $validate)
    {
        // 验证
        try {
            validate($validate)->check($data);
        } catch (ValidateException $e) {
            return $this->error_msg($e->getError(), 'Data verification failed.');
        }

        // 添加
        $res = Db::name($table)->save($data);
        if($res)
        {
            return $this->success_msg($data, "$table added successfully.");
        }
        return $this->error_msg($data, "Add $table failed.");
    }

    // 删
    protected function base_delete($table, $data)
    {
        // 验证数据
        try {
            validate(IdsValidate::class)->check($data);
        } catch (ValidateException $e) {
            return $this->error_msg($e->getError(), 'Data verification failed.');
        }

        // 删除
        $res = Db::table($table)->delete($data['ids']);
        if($res)
        {
            return $this->success_msg($res, 'Data successfully deleted');
        }
        else
        {
            return $this->info_msg($res, 'No data to delete.');
        }
    }

    // 改
    public function base_edit($table, $data, $validate)
    {
        // 验证
        try {
            validate($validate)->check($data);
        } catch (ValidateException $e) {
            return $this->error_msg($e->getError(), 'Data verification failed.');
        }
        
        // 查询
        $res = Db::table($table)->where('id', $data['id'])->findOrEmpty();
        if($res == [])
        {
            return $this->info_msg([], "No corresponding $table found, forbidden to modify.");
        }
        $flag = Db::name($table)->update($data);
        if($flag)
        {
            return $this->success_msg($data, "$table edited successfully.");
        }
        return $this->error_msg($data, "Edit $table failed.");
    }

    // 详情
    protected function base_detail($table, $data)
    {
        // 验证数据
        try {
            validate(IdValidate::class)->check($data);
        } catch (ValidateException $e) {
            return $this->error_msg($e->getError(), 'Data verification failed.');
        }
        // 查询
        $res = Db::table($table)->where('id', $data['id'])->findOrEmpty();
        if($res == [])
        {
            return $this->info_msg([], "No corresponding $table found.");
        }
        $table = ucfirst($table);
        return $this->success_msg($res, "$table details successfully found.");
    }

    // 分页列表模糊查询
    protected function base_query($table, $data)
    {
        // 组装查询条件
        $map = [];
        foreach($data['data'] as $k => $v)
        {
            $mid = gettype($v) == 'string' ? 'like' : '='; 
            if($mid == 'like')
            {
                $v = "%$v%";
            }
            array_push($map, [$k, $mid, $v]);
        }
        $list = Db::name($table)->where($map)->order('id', 'desc')->paginate([
            'list_rows'=> $data['per_page'],
            'page' => $data['page'],
        ]);
        return $this->success_msg($list, 'success');
    }
}
