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
class  Article extends Validate
{
    protected $rule = [
        ['article_sort', 'number', '排序只能为数字'],
        ['article_title', 'require', '标题名称不能为空'],
        ['ac_name', 'require', '分类名称不能为空'],
        ['ac_sort', 'number', '分类排序仅能为数字']
    ];

    protected $scene = [
        'add' => ['article_sort', 'article_title'],
        'edit' => ['article_sort', 'article_title'],
        'article_class_add' => ['ac_name', 'ac_sort'],
        'article_class_edit' => ['ac_name', 'ac_sort'],
    ];
}