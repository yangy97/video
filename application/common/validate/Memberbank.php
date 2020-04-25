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
class  Memberbank extends Validate
{
    protected $rule = [
        ['memberbank_type','require','账户类型不能为空'],
        ['memberbank_truename','require','开户名不能为空'],
        ['memberbank_no','require','账号不能为空'],

    ];
    protected $scene = [
        'add' => ['memberbank_type', 'memberbank_truename', 'memberbank_no'],
        'edit' => ['memberbank_type', 'memberbank_truename', 'memberbank_no'],
    ];


}