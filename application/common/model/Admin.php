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
class  Admin extends Model {

    public $page_info;
    /**
     * 管理员列表
     * @author csdeshang
     * @param array $condition 检索条件
     * @param array $pagesize 分页信息
     * @return array 数组类型的返回结果
     */
    public function getAdminList($condition,$pagesize) {
        if($pagesize){
            $result = db('admin')->alias('a')->join('__GADMIN__ g', 'g.gid = a.admin_gid', 'LEFT')->paginate($pagesize,false,['query' => request()->param()]);
            $this->page_info=$result;
            return $result->items();
        }else{
            $result = db('admin')->alias('a')->join('__GADMIN__ g', 'g.gid = a.admin_gid', 'LEFT')->select();
            return $result;
        }
    }

    /**
     * 取单个管理员的内容
     * @author csdeshang
     * @param array $conditions 检索条件
     * @return array 数组类型的返回结果
     */
    public function getOneAdmin($conditions) {
        return db('admin')->where($conditions)->find();
    }

    /**
     * 获取管理员信息
     * @author csdeshang
     * @param	array $condition 管理员条件
     * @param	string $field 显示字段
     * @return	array 数组格式的返回结果
     */
    public function infoAdmin($condition, $field = '*') {
        if (empty($condition)) {
            return false;
        }
        return db('admin')->field($field)->where($condition)->find();
    }

    /**
     * 新增
     * @author csdeshang
     * @param array $data 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function addAdmin($data) {
        if (empty($data)) {
            return false;
        }
        return db('admin')->insertGetId($data);
    }

    /**
     * 更新信息
     * @author csdeshang
     * @param array $data 更新数据
     * @param int $admin_id 管理员id
     * @return bool 布尔类型的返回结果
     */
    public function editAdmin($data,$admin_id) {
        if (empty($data)) {
            return false;
        }
        return db('admin')->where('admin_id',$admin_id)->update($data);
    }

    /**
     * 删除
     * @author csdeshang
     * @param array $conditions 检索条件
     * @return array $rs_row 返回数组形式的查询结果
     */
    public function delAdmin($conditions) {
        return db('admin')->where($conditions)->delete();
    }
    
    
    
    
    /**
     * 获取单个权限组
     * @author csdeshang
     * @param array $condition  条件
     * @return array 一维数组
     */
    public function getOneGadmin($condition){
        $gadmin = db('gadmin')->where($condition)->find();
        return $gadmin;
        
    }
    /**
     * 获取权限组列表
     * @author csdeshang
     * @param type $field
     * @return array 
     */
    public function getGadminList($field='*'){
        $gadmin_list = db('gadmin')->field($field)->select();
        return $gadmin_list;
    }
    /**
     * 增加权限组
     * @author csdeshang
     * @param array $data 参数内容
     * @return bool
     */
    public function addGadmin($data){
        return db('gadmin')->insertGetId($data);
    }
    
    /**
     * 删除权限组
     * @author csdeshang
     * @param array $condition 删除条件
     * @return bool
     */
    public function delGadmin($condition){
        return db('gadmin')->where($condition)->delete();
    }
    
    /**
     * 编辑权限组
     * @author csdeshang
     * @param array $condition 更新条件
     * @param array $data 更新数据
     * @return bool
     */
    public function editGadmin($condition,$data){
        return db('gadmin')->where($condition)->update($data);
    }
}

?>
