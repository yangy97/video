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
class  Exampaperlog extends Model {

    public $page_info;

    /**
     * 获取题库列表
     * @author csdeshang
     * @param type $condition 查询条件
     * @param type $pagesize      分页信息
     * @param type $order     排序
     * @return type
     */
    public function getExampaperlogList($condition, $pagesize = '', $order='') {
        if ($pagesize) {
            $result = db('exampaperlog')->where($condition)->order($order)->paginate($pagesize, false, ['query' => request()->param()]);
            $this->page_info = $result;
            return $result->items();
        } else {
            return db('exampaperlog')->where($condition)->order($order)->select();
        }
    }

    /**
     * 删除题库
     * @author csdeshang
     * @param type $condition 删除条件
     * @return type
     */
    public function delExampaperlog($condition) {
        return db('exampaperlog')->where($condition)->delete();
    }
    
    /**
     * 获取单条题库
     * @author csdeshang
     * @param type $condition 条件
     * @return type
     */
    public function getOneExampaperlog($condition) {
        return db('exampaperlog')->where($condition)->find();
    }
    
    
    /**
     * 增加题库
     * @author csdeshang
     * @param type $data
     * @return type
     */
    public function addExampaperlog($data) {
        return db('exampaperlog')->insertGetId($data);
    }
    /**
     * 更新信息
     * @access public
     * @author csdeshang
     * @param array $data 更新数据
     * @return bool 布尔类型的返回结果
     */
    public function editExampaperlog($condition,$data){
        $result = db('exampaperlog')->where($condition)->update($data);
        return $result;
    }

}
