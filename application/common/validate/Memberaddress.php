<?php
namespace app\common\validate;
use think\Validate;/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 验证器
 */
class  Memberaddress extends Validate
{
    protected $rule = [
        ['city_id', 'gt:0', '请选择地区'],
        ['area_id', 'gt:0', '地区至少两级'],
        ['address_realname','require','姓名不能为空'],
        ['area_info','require','地区不能为空'],
        ['address_detail','require','地址不能为空'],
        ['address_mob_phone','checkMemberAddressMobPhone:1','联系方式不能为空']//

    ];
    protected $scene = [
        'add' => ['address_realname', 'city_id', 'area_id'],
        'edit' => ['address_realname', 'city_id', 'area_id'],
        'address_valid' => ['address_realname', 'area_info', 'address_detail', 'address_mob_phone'],//mobile
    ];

    protected function checkMemberAddressMobPhone($value)
    {
        if (empty(input('post.mob_phone'))&&empty(input('post.tel_phone'))){
            if (empty($value)) {
                return '联系方式不能为空';
            }
        }
        return true;
    }

}