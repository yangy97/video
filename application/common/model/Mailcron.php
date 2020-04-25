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
class  Mailcron extends Model
{
    /**
     * 新增机构消息任务计划
     * @access public
     * @author csdeshang
     * @param array $insert 插入数据
     */
    public function addMailCron($insert) {
        return db('mailcron')->insertGetId($insert);
    }
 
    /**
     * 查看机构消息任务计划
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param int $limit 限制
     * @param string $order 排序
     * @return array
     */
    public function getMailCronList($condition, $limit = 0, $order = 'mailcron_id asc') {
        return db('mailcron')->where($condition)->limit($limit)->order($order)->select();
    }

    /**
     * 删除机构消息任务计划
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @return bool
     */
    public function delMailCron($condition) {
        return db('mailcron')->where($condition)->delete();
    }
}