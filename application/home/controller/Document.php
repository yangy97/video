<?php

/**
 * 系统文章
 */

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
class  Document extends BaseMall {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'home/lang/'.config('default_lang').'/index.lang.php');
    }

    public function index() {
        $code = input('param.code');
        
        if ($code == '') {
            $this->error(lang('param_error'));//'缺少参数:文章标识'
        }
        $document_model = model('document');
        $doc = $document_model->getOneDocumentByCode($code);
        $this->assign('doc', $doc);
        /**
         * 分类导航
         */
        $nav_link = array(
            array(
                'title' => lang('homepage'),
                'link' => HOME_SITE_URL
            ),
            array(
                'title' => $doc['document_title']
            )
        );
        $this->assign('nav_link_list', $nav_link);
        return $this->fetch($this->template_dir . 'index');
    }

}

?>
