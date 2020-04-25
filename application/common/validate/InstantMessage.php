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
class  InstantMessage extends Validate
{
    protected $rule = [
        'instant_message_type'=>'in:0',
        'instant_message'=>'require',
    ];
    protected $message  =   [
        'instant_message_type.in' => '消息类型错误',
        'instant_message' => '消息内容不能为空',
    ];
    protected $scene = [
        'instant_message_save' => ['instant_message_type', 'instant_message'],
    ];
}