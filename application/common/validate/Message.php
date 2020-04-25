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
class  Message extends Validate
{
    protected $rule = [
        ['to_member_name','require','收件人不能为空'],
        ['msg_content','require','内容不能为空'],
    ];

    protected $scene = [
        'savemsg' => ['to_member_name','msg_content'],
    ];
}