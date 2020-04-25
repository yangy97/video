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
class  Storecost extends Model {
    public  $page_info;
 
    /**
     * 读取列表
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param int $pagesize 分页
     * @param string $order 排序
     * @param string $field 字段
     * @return array
     */
    public function getStorecostList($condition, $pagesize = '', $order = '', $field = '*') {
        if($pagesize){
            $result = db('storecost')->field($field)->where($condition)->order($order)->paginate($pagesize,false,['query' => request()->param()]);
            $this->page_info = $result;
            return $result->items();
        }else{
            $result = db('storecost')->field($field)->where($condition)->order($order)->select();
            return $result;
        }
    }

    /**
     * 读取单条记录
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $fields 字段
     * @return array
     */
    public function getStorecostInfo($condition, $fields = '*') {
        $result = db('storecost')->where($condition)->field($fields)->find();
        return $result;
    }

    /**
     * 增加 
     * @access public
     * @author csdeshang
     * @param array $data 数据
     * @return bool
     */
    public function addStorecost($data) {
        return db('storecost')->insertGetId($data);
    }

    /**
     * 删除
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @return bool
     */
    public function delStorecost($condition) {
        return db('storecost')->where($condition)->delete();
    }

    /**
     * 更新
     * @access public
     * @author csdeshang
     * @param array $data 更新数据
     * @param array $condition 条件
     * @return bool
     */
    public function editStorecost($data, $condition) {
        return db('storecost')->where($condition)->update($data);
    }

}

?>
