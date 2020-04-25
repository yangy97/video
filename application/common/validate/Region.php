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
class  Region extends Validate
{
    protected $rule = [
        ['area_name', 'require', '地区名称不能为空'],
        ['area_sort', 'between:0,255', '排序必须为0-255间数字'],
        ['area_region', 'length:0,9', '大区名称必须小于三个字符'],
    ];

    protected $scene = [
        'add' => ['area_name', 'area_sort', 'area_region'],
        'edit' => ['area_name', 'area_sort', 'area_region'],
    ];
}