<?php

namespace app\common\model;

use think\Model;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 数据层模型
 */
class  Inviterclass extends Model {

    //获取分销员所对应的等级
    public function getInviterclass($inviterclass_amount){
        $inviterclass_name='';
        $inviterclass_list=db('inviterclass')->order('inviterclass_amount asc')->select();
        foreach($inviterclass_list as $inviterclass){
            if($inviterclass_amount>=$inviterclass['inviterclass_amount']){
                $inviterclass_name=$inviterclass['inviterclass_name'];
            }
        }
        return $inviterclass_name;
    }

}
