<?php

/**
 * 系统安全检测相关代码
 */

namespace app\admin\controller;

use think\Lang;
use think\Db;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 控制器
 */
class  Webscan extends AdminControl {

    public function _initialize() {
        parent::_initialize();
        $this->_prefix = config('database.prefix');
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/webscan.lang.php');
    }

    public function index()
    {
        $this->scan_member();
    }

    public function scan_member()
    {
        $output = array();
        //检测Member数据表中是否有重复的 用户名  邮箱  手机号
        $result = Db::query("select member_name,count(*) as count from {$this->_prefix}member group by member_name having count>1;");
    }
}
