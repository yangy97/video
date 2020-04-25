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
class  Wechat extends Validate
{
    protected $rule = [
        ['name', 'require', '菜单名称不能为空'],
        ['sort', 'number','排序只能为数字'],
        ['type', 'require', '类型不能为空'],
        ['value', 'checkValue:1', 'URL地址错误']
    ];

    protected $scene = [
        'menu_add' => ['name', 'sort', 'type', 'value'],
        'menu_edit' => ['name', 'sort', 'type', 'value'],
    ];

    protected function checkValue($value){
        if(input('post.menu_type') == 'view'){
            if (empty($value)){
                return 'URL地址格式不能为空';
            }
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$value)) {
                return "URL地址格式不正确";
            }
        }
        return true;
    }
}