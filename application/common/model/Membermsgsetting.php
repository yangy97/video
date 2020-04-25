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
class  Membermsgsetting extends Model
{
    public $page_info;
    /**
     * 用户消息模板列表
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $field 字段
     * @param number $pagesize 分页
     * @param string $order 排序
     * @return array
     */
    public function getMembermsgsettingList($condition, $field = '*', $pagesize = 0, $order = 'membermt_code asc') {
       $result= db('membermsgsetting')->field($field)->where($condition)->order($order)->paginate($pagesize,false,['query' => request()->param()]);
       $this->page_info=$result;
       return $result->items();
    }

    /**
     * 用户消息模板详细信息
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $field 字段
     * @return array
     */
    public function getMembermsgsettingInfo($condition, $field = '*') {
        return db('membermsgsetting')->field($field)->where($condition)->find();
    }

  
    /**
     * 编辑用户消息模板
     * @access public
     * @author csdeshang
     * @param type $data 数据
     * @return type
     */
    public function addMembermsgsettingAll($data) {
        return db('membermsgsetting')->insertAll($data);
    }
}