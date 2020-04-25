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
class  Storedeposit extends Validate
{
    protected $rule = [
        ['store_id', 'require|number', '请输入店主用户名|店主信息错误'],
        ['amount', 'require|max:6', '请添加金额|金额小于6位'],
        ['operatetype', 'require', '请输入增减类型'],
    ];

    protected $scene = [
        'adjust' => ['store_id', 'amount','operatetype'],
    ];
}