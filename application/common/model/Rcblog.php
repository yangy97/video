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
class  Rcblog extends Model
{
    public $page_info;
    
    /**
     * 获取列表
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @param string $pagesize 分页
     * @param string $order 排序
     * @return array
     */
    public function getRechargecardBalanceLogList($condition, $pagesize, $order)
    {
        $res =db('rcblog')->where($condition)->order($order)->paginate($pagesize,false,['query' => request()->param()]);
        $this->page_info=$res;
        return $res->items();
    }
}