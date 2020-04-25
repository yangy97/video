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
class  Account extends Validate
{
    protected $rule = [
        ['qq_appid', 'require', '请添加应用标识'],
        ['qq_appkey', 'require', '请添加应用密钥'],
        ['sina_wb_akey', 'require', '请添加应用标识'],
        ['sina_wb_skey', 'require', '请添加应用密钥'],
        ['weixin_appid', 'require', '请添加应用标识'],
        ['weixin_secret', 'require', '请添加应用密钥']
    ];

    protected $scene = [
        'qq' => ['qq_appid', 'qq_appkey'],
        'sina' => ['sina_wb_akey', 'sina_wb_skey'],
        'wx' => ['weixin_appid', 'weixin_secret']
    ];
}