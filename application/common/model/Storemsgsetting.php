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
class  Storemsgsetting extends Model
{
    public $page_info;
 
    /**
     * 机构消息接收设置列表
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @param type $field 字段
     * @param type $key 键值
     * @param type $pagesize 分页
     * @param type $order 排序
     * @return type
     */
    public function getStoremsgsettingList($condition, $field = '*', $key = '', $pagesize = 0, $order = 'storemt_code asc') {
        $res=db('storemsgsetting')->field($field)->where($condition)->order($order)->paginate($pagesize,false,['query' => request()->param()]);
        $this->page_info=$res;
        $result= $res->items();
        return ds_change_arraykey($result,$key);

    }

    /**
     * 机构消息接收设置详细
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @param type $field 字段
     * @return type
     */
    public function getStoremsgsettingInfo($condition, $field = '*') {
        return db('storemsgsetting')->field($field)->where($condition)->find();
    }

    /**
     * 添加机构模板接收设置
     * @access public
     * @author csdeshang
     * @param array $data 新增数据
     * @return bool
     */
    public function addStoremsgsetting($data) {
        return db('storemsgsetting')->insert($data);
    }

    /**
     * 编辑机构模板接收设置
     * @access public
     * @author csdeshang
     * @param array $data 更新数据
     * @return bool
     */
    public function editStoremsgsetting($data, $condition) {
        return db('storemsgsetting')->where($condition)->update($data);
    }
}