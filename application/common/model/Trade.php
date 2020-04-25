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
class  Trade extends Model {

    /**
     * 订单处理天数
     * @access public
     * @author csdeshang
     * @param type $day_type 天数类型
     * @return int
     */
    public function getMaxDay($day_type = 'all') {
        $max_data = array(
            'order_refund' => 7, //收货完成后可以申请退款退货
            'refund_confirm' => 7, //卖家不处理退款退货申请时按同意处理
            'return_confirm' => 7, //卖家不处理收货时按弃货处理
            'return_delay' => 5 //退货的商品发货多少天以后才可以选择没收到
        );
        if ($day_type == 'all')
            return $max_data; //返回所有
        if (intval($max_data[$day_type]) < 1)
            $max_data[$day_type] = 1; //最小的值设置为1
        return $max_data[$day_type];
    }

    /**
     * 订单状态
     * @access public
     * @author csdeshang
     * @param type $type 类型
     * @return type
     */
    public function getOrderState($type = 'all') {
        $state_data = array(
            'order_cancel' => ORDER_STATE_CANCEL, //0:已取消
            'order_default' => ORDER_STATE_NEW, //10:未付款
            'order_paid' => ORDER_STATE_PAY, //20:已付款
            'order_shipped' => ORDER_STATE_SEND, //30:已发货
            'order_completed' => ORDER_STATE_SUCCESS //40:已收货
        );
        if ($type == 'all')
            return $state_data; //返回所有
        return $state_data[$type];
    }



}

?>
