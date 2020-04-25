<?php

/**
 * 商品管理
 */

namespace app\admin\controller;

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
class LiveSetting extends AdminControl {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/' . config('default_lang') . '/live_setting.lang.php');
    }

    public function index() {
        $config_model = model('config');
        if (!request()->isPost()) {
            $list_config = rkcache('config', true);
            $this->assign('list_config', $list_config);
            $this->setAdminCurItem('index');
            return $this->fetch();
        } else {
            $update_array=array();
            $update_array['instant_message_gateway_url'] = input('param.instant_message_gateway_url');
            $update_array['instant_message_register_url'] = input('param.instant_message_register_url');
            $update_array['instant_message_verify'] = input('param.instant_message_verify');
            $update_array['live_push_domain'] = input('param.live_push_domain');
            $update_array['live_push_key'] = input('param.live_push_key');
            $update_array['live_play_domain'] = input('param.live_play_domain');
            $result = $config_model->editConfig($update_array);
            if ($result) {
                dkcache('config');
                $this->log(lang('ds_edit') . lang('live_setting'), 1);
                $this->success(lang('ds_common_save_succ'));
            } else {
                $this->log(lang('ds_edit') . lang('live_setting'), 0);
            }
        }
    }
    /**
     * 获取卖家栏目列表,针对控制器下的栏目
     */
    protected function getAdminItemList() {
        $menu_array = array(
            array(
                'name' => 'index',
                'text' => lang('ds_setting'),
                'url' => url('LiveSetting/setting')
            ),
        );
        return $menu_array;
    }

}

?>
