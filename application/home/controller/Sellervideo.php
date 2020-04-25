<?php

/**
 * 机构视频管理
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
class  Sellervideo extends BaseSeller {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'home/lang/' . config('default_lang') . '/sellervideo.lang.php');
    }

    /**
     * 显示机构所有视频列表
     */
    public function index() {

        $videoupload_model = model('videoupload');
        $condition['store_id'] = session('store_id');
        $videoupload_list = $videoupload_model->getVideouploadList($condition, '*', 10);


        $this->assign('show_page', $videoupload_model->page_info->render());
        $this->assign('videoupload_list', $videoupload_list);

        $this->setSellerCurItem('sellervideo_index');
        $this->setSellerCurMenu('sellervideo');
        return $this->fetch($this->template_dir . 'index');
    }

    /**
     * 获取腾讯客户端上传签名 
     * https://cloud.tencent.com/document/product/266/9221
     */
    public function getTencentSign() {
        // 确定 App 的云 API 密钥
        $secret_id = config('vod_tencent_secret_id');
        $secret_key = config('vod_tencent_secret_key');

        // 确定签名的当前时间和失效时间
        $current = TIMESTAMP;
        $expired = $current + 86400;  // 签名有效期：1天
        // 向参数列表填入参数
        $arg_list = array(
            "secretId" => $secret_id,
            "currentTimeStamp" => $current,
            "expireTime" => $expired,
            "random" => rand());

        // 计算签名
        $orignal = http_build_query($arg_list);
        $signature = base64_encode(hash_hmac('SHA1', $orignal, $secret_key, true) . $orignal);
        ds_json_encode(10000, '', $signature);
    }

    /**
     * 删除视频
     */
    public function del() {
    $videoupload_id = intval(input('param.id'));  
        if ($videoupload_id <= 0) {
            ds_json_encode(10001, '参数错误');
        }
        $videoupload_model = model('videoupload');
        $condition['store_id'] = session('store_id');
        $condition['videoupload_id'] = $videoupload_id;
       $result_video= $videoupload_model->delVideoupload($condition);
    if ($result_video) {

        ds_json_encode(10000, lang('videoupload_delsuss'));
    } else {
       
        ds_json_encode(10001, lang('videoupload_delfail'));
    }

       
    }

    /**
     * 视频上传是通过 Web端上传  先通过Web上传的返回的数据  存储到数据库中
     * https://cloud.tencent.com/document/product/266/9239
     */
    public function add() {
        $this->setSellerCurItem('sellervideo_add');
        $this->setSellerCurMenu('sellervideo');
        return $this->fetch($this->template_dir . 'add');
    }

    public function saveVideo() {
        $videoupload_fileid = input('param.file_id');
        $videoupload_url = input('param.url');
        $videoupload_type = intval(input('param.type'));
        $item_id = intval(input('param.item_id'));

        if (empty($videoupload_fileid) || empty($videoupload_url)) {
            ds_json_encode(10001, '参数错误');
        }

        $videoupload_model = model('videoupload');

        $data = array(
            'videoupload_fileid' => $videoupload_fileid,
            'videoupload_url' => $videoupload_url,
            'videoupload_type' => $videoupload_type,
            'videoupload_time' => TIMESTAMP,
            'item_id' => $item_id,
            'store_id' => session('store_id'),
        );
        $videoupload_model->addVideoupload($data);
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type 导航类型
     * @param string $menu_key 当前导航的menu_key
     * @return
     */
    function getSellerItemList() {
        $menu_array = array(
            array(
                'name' => 'sellervideo_index',
                'text' => lang('sellervideo_index'),
                'url' => url('Sellervideo/index')
            ),
            array(
                'name' => 'sellervideo_add',
                'text' => lang('sellervideo_add'),
                'url' => "javascript:ds_layer_open('" . url('Sellervideo/add') . "','添加视频')"
            ),
        );
        return $menu_array;
    }

}
