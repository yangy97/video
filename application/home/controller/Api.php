<?php

namespace app\home\controller;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 控制器
 */
class  Api {
    
    /* QQ登录 */
    public function oa_qq() {
        include PLUGINS_PATH . '/login/qq/oauth/qq_login.php';
    }
    /* QQ登录回调 */
    public function oa_qq_callback() {
        include PLUGINS_PATH . '/login/qq/oauth/qq_callback.php';
    }

    /* sina Login */
    public function oa_sina() {
        if (input('param.step') == 'callback') {
            include PLUGINS_PATH . '/login/sina/callback.php';
        } else {
            include PLUGINS_PATH . '/login/sina/index.php';
        }
    }


}