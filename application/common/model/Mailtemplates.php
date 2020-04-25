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
class  Mailtemplates extends Model {
    
    /**
     * 取单条信息
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $fields 字段
     */
    public function getTplInfo($condition = array(), $fields = '*') {
        return db('mailmsgtemlates')->where($condition)->field($fields)->find();
    }

    /**
     * 模板列表
     * @access public
     * @author csdeshang
     * @param array $condition 检索条件
     * @return array 数组形式的返回结果
     */
    public function getTplList($condition = array()) {
        return db('mailmsgtemlates')->where($condition)->select();
    }
    
    /**
     * 编辑模板
     * @access public
     * @author csdeshang
     * @param type $data 参数内容
     * @param type $condition 条件
     * @return type
     */
    public function editTpl($data = array(), $condition = array()) {
        return db('mailmsgtemlates')->where($condition)->update($data);
    }

}

?>
