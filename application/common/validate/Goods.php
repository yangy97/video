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
class  Goods extends Validate
{
    protected $rule = [
        ['goods_name', 'require|max:200', '商品名称不能为空|商品名称不能超过200个字符'],
        ['goods_price', 'require', '商品价格不能为空'],
        ['gc_name', 'require', '分类标题为必填'],
        ['gc_sort', 'between:0,255', '排序应该在0至255之间'],
        ['goods_content', 'require', '咨询内容不能为空'],
    ];

    protected $scene = [
        'edit_save_goods' => ['goods_name', 'goods_price'],
        'goods_class_add' => ['gc_name', 'gc_sort'],//goodsclass
        'goods_class_edit' => ['gc_name', 'gc_sort'],//goodsclass
        'save_consult' => ['goods_content'],//home goods
    ];
}