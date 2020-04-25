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
class  Mallconsult extends Validate
{
    protected $rule = [
        ['mallconsulttype_name', 'require', '请填写咨询类型名称'],
        ['mallconsulttype_sort', 'require|number', '请正确填写咨询类型排序'],
        ['type_id', 'require|number','请选择咨询类型'],
        ['consult_content', 'require', '请填写咨询内容']
    ];

    protected $scene = [
        'type_add' => ['mallconsulttype_name', 'mallconsulttype_sort'],
        'type_edit' => ['mallconsulttype_name', 'mallconsulttype_sort'],
        'save_mallconsult' => ['type_id', 'consult_content'],
    ];
}