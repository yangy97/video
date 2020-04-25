<?php

namespace app\home\controller;

use think\Lang;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 控制器
 */
class  Category extends BaseMall {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'home/lang/'.config('default_lang').'/category.lang.php');
    }

    /*
     * 显示商品分类列表
     */

    public function goods() {
        //获取全部的商品分类
        //导航
        $nav_link = array(
            '0' => array('title' => lang('homepage'), 'link' => HOME_SITE_URL),
            '1' => array('title' => lang('category_index_goods_class'))
        );
        $this->assign('nav_link_list', $nav_link);

        $this->assign('html_title', config('site_name') . ' - ' . lang('category_index_goods_class'));
        return $this->fetch($this->template_dir . 'goods_category');
    }

    /*
     * 显示机构分类列表
     */

    public function store() {
        //导航
        $nav_link = array(
            '0' => array('title' => lang('homepage'), 'link' => HOME_SITE_URL),
            '1' => array('title' => lang('category_index_store_class'))
        );
        $this->assign('nav_link_list', $nav_link);
        
        $sc_list = model('storeclass')->getStoreclassList();
        $this->assign('sc_list', $sc_list);
        return $this->fetch($this->template_dir . 'store_category');
    }

}
