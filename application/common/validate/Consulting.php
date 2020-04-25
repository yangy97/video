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
class  Consulting extends Validate
{
    protected $rule = array(
       ['consulttype_name', 'require', '请填写咨询类型名称'],
       ['consulttype_sort', 'require|Number', '请正确填写咨询类型排序'],
    );

    protected $scene = [
        'type_add' => ['consulttype_name', 'sort'],
        'type_edit' => ['consulttype_name', 'sort'],
    ];
}