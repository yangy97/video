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
class  Notice extends Validate
{
    protected $rule = [
        ['user_name', 'require', '会员列表不能为空'],
        ['content1', 'require', '通知内容不能为空']
    ];

    protected $scene = [
        'notice1' => ['user_name'],
        'notice2' => ['content1'],
    ];
}