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
class  Membermsgtpl extends Model {
    
  
    /**
     * 用户消息模板列表
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $field 字段
     * @param int $order 排序
     * @return array
     */
    public function getMembermsgtplList($condition, $field = '*', $order = 'membermt_code asc') {
        return db('membermsgtpl')->field($field)->where($condition)->order($order)->select();
    }
    
    /**
     * 用户消息模板详细信息
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $field 字段
     */
    public function getMembermsgtplInfo($condition, $field = '*') {
        return db('membermsgtpl')->field($field)->where($condition)->find();
    }
    
    /**
     * 编辑用户消息模板
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param unknown $update 更新数据
     * @return bool
     */
    public function editMembermsgtpl($condition, $update) {
        return db('membermsgtpl')->where($condition)->update($update);
    }
    
    
}
?>
