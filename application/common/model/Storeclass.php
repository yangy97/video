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
class  Storeclass extends Model {
    
    public $page_info;
  
    /**
     * 取机构类别列表
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @param type $pagesize 分页
     * @param type $limit 限制
     * @param type $order 排序
     * @return type
     */
    public function getStoreclassList($condition = array(), $pagesize = '', $limit = '', $order = 'storeclass_sort asc,storeclass_id asc') {
        
        if($pagesize){
            $list = db('storeclass')->where($condition)->order($order)->paginate($pagesize,false,['query' => request()->param()]);
            $this->page_info = $list;
            return $list->items();
        }else{
            return db('storeclass')->where($condition)->order($order)->limit($limit)->select();
        }
        
    }

    /**
     * 取得单条信息
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @return type
     */
    public function getStoreclassInfo($condition = array()) {
        return db('storeclass')->where($condition)->find();
    }

    /**
     * 删除类别
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @return type
     */
    public function delStoreclass($condition = array()) {
        return db('storeclass')->where($condition)->delete();
    }

    /**
     * 增加机构分类
     * @access public
     * @author csdeshang
     * @param array $data 数据
     * @return bool
     */
    public function addStoreclass($data) {
        return db('storeclass')->insertGetId($data);
    }

    /**
     * 更新分类
     * @access public
     * @author csdeshang
     * @param array $data 数据 
     * @param array $condition 条件
     * @return bool
     */
    public function editStoreclass($data = array(),$condition = array()) {
        return db('storeclass')->where($condition)->update($data);
    }
    
}
?>
