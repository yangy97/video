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
class  Sellerplate extends Validate
{
    protected $rule = [
        ['storeplate_name', 'require', '请填写版式名称'],
        ['storeplate_content', 'require', '请填写版式内容'],
    ];

    protected $scene = [
        'plate_add' => ['storeplate_name', 'storeplate_content'],
        'plate_edit' => ['storeplate_name', 'storeplate_content'],
    ];
}