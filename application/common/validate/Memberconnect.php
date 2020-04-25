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
class  Memberconnect extends Validate
{
    protected $rule = [
        ['new_password', 'require|length:6,20', '新密码为必填|密码长度必须为6-20之间'],
        ['confirm_password', 'require|requireIf:new_password,1', '新密码与确认密码不相同，请从重新输入'],
    ];

    protected $scene = [
        'qqunbind' => ['new_password', 'confirm_password'],
        'sinaunbind' => ['new_password', 'confirm_password'],
        'weixinunbind' => ['new_password', 'confirm_password'],
    ];

}