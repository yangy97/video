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
class  Sellermoney extends Validate
{
    protected $rule = [
        ['pdc_amount', 'require|number|min', '请填写取出金额|取出金额必须是数字|0.01']
    ];

    protected $scene = [
        'withdraw_add' => ['pdc_amount'],
    ];
}