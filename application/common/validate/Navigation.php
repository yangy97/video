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
class  Navigation extends Validate
{
    protected $rule = [
        ['nav_sort', 'number', '排序只能为数字'],
        ['nav_title', 'require', '标题不能为空'],
    ];

    protected $scene = [
        'add' => ['nav_sort', 'nav_title'],
        'edit' => ['nav_sort', 'nav_title'],
    ];
}