<?php

/**
 * 公共用户可以访问的类(不需要登录)
 */

namespace app\home\controller;
use think\Lang;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 控制器
 */
class  BaseMall extends BaseHome {

    public function _initialize() {
        parent::_initialize();
        $this->template_dir = 'default/mall/'.  strtolower(request()->controller()).'/';
    }
}

?>
