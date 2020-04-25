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
class  Adminlog extends Model {

    public $page_info;

    /**
     * 获取日志记录列表
     * @author csdeshang
     * @param type $condition 查询条件
     * @param type $pagesize      分页信息
     * @param type $order     排序
     * @return type
     */
    public function getAdminlogList($condition, $pagesize = '', $order) {
        if ($pagesize) {
            $result = db('adminlog')->where($condition)->order($order)->paginate($pagesize, false, ['query' => request()->param()]);
            $this->page_info = $result;
            return $result->items();
        } else {
            return db('adminlog')->where($condition)->order($order)->select();
        }
    }

    /**
     * 删除日志记录
     * @author csdeshang
     * @param type $condition 删除条件
     * @return type
     */
    public function delAdminlog($condition) {
        return db('adminlog')->where($condition)->delete();
    }

    /**
     * 获取日志条数
     * @author csdeshang
     * @param type $condition 查询条件
     * @return type
     */
    public function getAdminlogCount($condition) {
        return db('adminlog')->where($condition)->count();
    }
    
    /**
     * 增加日子
     * @author csdeshang
     * @param type $data
     * @return type
     */
    public function addAdminlog($data) {
        return db('adminlog')->insertGetId($data);
    }

}
