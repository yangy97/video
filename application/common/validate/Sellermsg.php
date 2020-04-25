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
class  Sellermsg extends Validate
{
    protected $rule = [
        ['storems_short_number', '^1[0-9]{10}$', '请填写正确的手机号码'],
        ['storems_mail_number', 'email', '请填写正确的邮箱']
    ];

    protected $scene = [
        'save_msg_setting' => ['storems_short_number','storems_mail_number'],
    ];
}