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
class  Informsubject extends Model
{
    public $page_info;
    
    /**
     * 增加投诉主题
     * @access public
     * @author csdeshang
     * @param array $data 参数内容
     * @return bool
     */
    public function addInformsubject($data)
    {
        return db('informsubject')->insertGetId($data);
    }

    /**
     * 更新
     * @access public
     * @author csdeshang
     * @param array $update_array 数据
     * @param array $where_array  条件
     * @return bool
     */
    public function editInformsubject($update_array, $where_array)
    {
        return db('informsubject')->where($where_array)->update($update_array);
    }

    /**
     * 删除
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @return bool
     */
    public function delInformsubject($condition)
    {
        return db('informsubject')->where($condition)->delete();
    }

    /**
     * 获得列表
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @param int $pagesize 分页
     * @param string $field 字段
     * @param string $order 排序
     * @return array
     */
    public function getInformsubjectList($condition = '', $pagesize = '', $field = '',$order='informsubject_id asc')
    {
        $res = db('informsubject')->field($field)->where($condition)->order($order)->paginate($pagesize,false,['query' => request()->param()]);
        $this->page_info = $res;
        return $res->items();
    }
    
    /**
     * 获取单个信息
     * @access public
     * @author csdeshang
     * @param type $condition 查询条件
     * @return type
     */
    public function getOneInformsubject($condition){
        return db('informsubject')->where($condition)->find();
    }
    
}