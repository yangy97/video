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
class  Mailtemplates extends Validate
{
    protected $rule = [
        ['code', 'require', '编号不能为空'],
        ['title', 'require', '标题不能为空'],
        ['content', 'require', '正文不能为空'],
    ];

    protected $scene = [
        'email_tpl_edit' => ['code','title', 'content'],
    ];
}