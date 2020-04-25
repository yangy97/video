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
class  Storegrade extends Validate
{
    protected $rule = [
        ['storegrade_name', 'require', '机构等级名称必填'],
        ['storegrade_sort', 'require|number|between:1,255', '排序为必填|排序必须是数字|等级级别不能大于255']

    ];

    protected $scene = [
        'add' => ['storegrade_name', 'storegrade_sort'],
        'edit' => ['storegrade_name', 'storegrade_sort'],
    ];
}