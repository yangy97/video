<?php

namespace app\common\validate;


use think\Validate;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 验证器
 */
class  Admin extends Validate
{
    protected  $rule = [
        ['admin_name', 'require|length:3,12', '登录名必填|登录名长度在3到12位|登录名已存在'],
        ['admin_password', 'require|min:6', '密码为必填|密码长度至少为6位'],
        ['admin_gid', 'require', '权限组为必填'],
        ['captcha', 'require|min:3', '验证码为必填|验证码长度至少为3位'],
    ];

    protected $scene = [
        'admin_add' => ['admin_name', 'admin_password', 'admin_gid'],
        'index' => ['admin_name', 'admin_password', 'captcha'],//login index
    ];
}