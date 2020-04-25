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
class  Sellergoodsonline extends Validate
{
    protected $rule = [
        ['goods_name', 'require', '商品名称不能为空'],
        ['goods_price', 'require', '商品价格不能为空'],
    ];

    protected $scene = [
        'edit_save_goods' => ['goods_name','goods_price'],
    ];
}