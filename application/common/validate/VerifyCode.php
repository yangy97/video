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
class  VerifyCode extends Validate
{
    protected $rule = [
        'verify_code'=>'require|length:6',
        'verify_code_type'=>'require|in:1,2,3',
    ];

    protected $message  =   [
        'verify_code.require' => '验证码必填',
        'verify_code.length' => '验证码长度为6位',
				'verify_code_type.require' => '验证码类型必填',
        'verify_code_type.in' => '验证码类型错误',
        
    ];
    protected $scene = [
        'verify_code_search' => ['verify_code'],
        'verify_code_send' => ['verify_code_type'],
    ];
}