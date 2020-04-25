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
class  Examclass extends Validate
{
    protected $rule = [
        ['examclass_name', 'require', '分类名称不能为空'],
        ['examclass_sort', 'number', '分类排序仅能为数字']
    ];

    protected $scene = [
        'add' => ['examclass_name', 'examclass_sort'],
        'edit' => ['examclass_name', 'examclass_sort'],
    ];
}