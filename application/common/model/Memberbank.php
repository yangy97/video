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
class Memberbank extends Model {


    /**
     * 取得单条提现账户
     * @author csdeshang 
     * @param array $condition 条件
     * @param type $order 排序  
     * @return string
     */
    public function getMemberbankInfo($condition, $order = '') {
        $addr_info = db('memberbank')->where($condition)->order($order)->find();
        return $addr_info;
    }

    /**
     * 读取提现账户列表
     * @author csdeshang
     * @param array $condition 查询条件
     * @param type $order 排序
     * @return array  数组格式的返回结果
     */
    public function getMemberbankList($condition, $order = 'memberbank_id desc') {
        $memberbank_list = db('memberbank')->where($condition)->order($order)->select();
        return $memberbank_list;
    }

    /**
     * 取数量
     * @author csdeshang
     * @param array $condition 条件
     * @return int
     */
    public function getMemberbankCount($condition = array()) {
        return db('memberbank')->where($condition)->count();
    }

    /**
     * 新增提现账户
     * @author csdeshang
     * @param array $data 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function addMemberbank($data) {
        return db('memberbank')->insertGetId($data);
    }

    /**
     * 取单个提现账户
     * @author csdeshang
     * @param int $id 提现账户ID
     * @return array 数组类型的返回结果
     */
    public function getOneMemberbank($id) {
        if (intval($id) > 0) {
            $result = db('memberbank')->where('memberbank_id',intval($id))->find();
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 更新提现账户
     * @author csdeshang
     * @param array $update 更新数据
     * @param array $condition 更新条件
     * @return bool 布尔类型的返回结果
     */
    public function editMemberbank($update, $condition) {
        return db('memberbank')->where($condition)->update($update);
    }


    /**
     * 删除提现账户
     * @author csdeshang
     * @param array $condition记录ID
     * @return bool 布尔类型的返回结果
     */
    public function delMemberbank($condition) {
        return db('memberbank')->where($condition)->delete();
    }

}

?>
