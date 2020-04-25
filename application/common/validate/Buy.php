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
class  Buy extends Validate
{
    protected $rule = [
        ['address_realname', 'require', '真实姓名必填'],
        ['address_detail', 'require', '地址为必填'],
    ];

    protected $scene = [
        'add_addr' => ['address_realname', 'address_detail'],
    ];

}