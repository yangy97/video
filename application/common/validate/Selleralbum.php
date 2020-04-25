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
class  Selleralbum extends Validate
{
    protected $rule = [
        ['aclass_name', 'require', '相册名称必填'],
        ['aclass_des', 'require', '相册描述必填'],
        ['aclass_sort', 'require', '相册排序必填']
    ];

    protected $scene = [
        'album_add_save' => ['aclass_name','aclass_des','aclass_sort'],
        'album_edit_save' => ['aclass_name','aclass_des','aclass_sort']
    ];
}