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
class  Predeposit extends Validate
{
    protected $rule = [
        ['member_id', 'require|number', '用户名必须存在|用户名错误'],
        ['amount', 'require', '金额为必填'],
        ['operatetype', 'require', '增减类型为必填'],
        ['pdc_amount','require|min:0.01','提现金额为大于或者等于0.01的数字'],
        ['password','require', '请输入支付密码']
    ];

    protected $scene = [
        'pd_add' => ['member_id', 'amount', 'operatetype'],
        'pd_cash_add' => ['pdc_amount','password'],
    ];
}