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
class Feedback extends Model {
public $page_info;
    /**
     * 列表
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @param int $pagesize 分页数
     * @param string $order 排序
     * @return array
     */
    public function getFeedbackList($condition, $pagesize = null, $order = 'fb_id desc') {
        $list = db('feedback')->where($condition)->order($order)->paginate($pagesize,false,['query' => request()->param()]);
        $this->page_info=$list;
        return $list;
    }

    /**
     * 新增
     * @access public
     * @author csdeshang
     * @param array $data 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function addFeedback($data) {
        return db('feedback')->insertGetId($data);
    }

    /**
     * 删除
     * @access public
     * @author csdeshang
     * @param int $condition 条件
     * @return bool 布尔类型的返回结果
     */
    public function delFeedback($condition) {
        return db('feedback')->where($condition)->delete();
    }

}

?>
