<?php

/*
 * 商品的类
 */

namespace app\home\controller;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 控制器
 */
class  BaseGoods extends BaseStore {

    protected $store_info;

    public function _initialize() {
        parent::_initialize();
        //输出会员信息
        $this->getMemberAndGradeInfo(false);
    }
    
    protected function getStoreInfo($store_id, $goods_info = null) {
        $store_model = model('store');
        $store_info = $store_model->getStoreOnlineInfoByID($store_id);
        if (empty($store_info)) {
            $this->error(lang('ds_store_close'));
        }
            $storejoinin_model=model('storejoinin');
            if(!$store_info['is_platform_store']){
                $storejoinin_info=$storejoinin_model->getOneStorejoinin(array('member_id'=>$store_info['member_id']));
                //营业执照
                if($storejoinin_info){
                    $store_info['business_licence_number_electronic']=$storejoinin_info['business_licence_number_electronic']?get_store_joinin_imageurl($storejoinin_info['business_licence_number_electronic']):'';
                }  
            }
        $this->outputStoreInfo($store_info, $goods_info);
    }
}

?>
