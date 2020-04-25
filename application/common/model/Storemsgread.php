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
class  Storemsgread extends Model
{
 
    /**
     * 新增机构纤细阅读
     * @access public
     * @author csdeshang
     * @param array $data 参数内容
     * @return bool
     */
    public function addStoremsgread($data)
    {
        $data['storemsg_readtime'] = TIMESTAMP;
        return db('storemsgread')->insert($data);
    }

    /**
     * 查看机构消息阅读详细
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @param type $field 字段
     * @return type
     */
    public function getStoremsgreadInfo($condition, $field = '*')
    {
        return db('storemsgread')->field($field)->where($condition)->find();
    }

    /**
     * 机构消息阅读列表
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $order 排序
     * @return array 
     */
    public function getStoremsgreadList($condition, $field = '*', $order = 'storemsg_readtime desc')
    {
        return db('storemsgread')->field($field)->where($condition)->order($order)->select();
    }

    /**
     * 删除机构消息阅读记录
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @return bool
     */
    public function delStoremsgread($condition)
    {
        db('storemsgread')->where($condition)->delete();
    }
}