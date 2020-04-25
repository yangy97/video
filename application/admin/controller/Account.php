<?php

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
class  Account extends AdminControl {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/account.lang.php');
        Lang::load(APP_PATH . 'admin/lang/'.config('default_lang').'/config.lang.php');
    }
    /**
     * 设置
     */
    public function setting() {
        $config_model = model('config');
        if (!request()->isPost()) {
            $list_config = rkcache('config', true);
            $this->assign('list_config', $list_config);
            /* 设置卖家当前栏目 */
            $this->setAdminCurItem('setting');
            return $this->fetch();
        } else {
            $update_array=array();
            $update_array['auto_register'] = input('post.auto_register');
            $result = $config_model->editConfig($update_array);
            if ($result) {
                $this->log(lang('ds_edit').lang('ds_account'),1);
                $this->success(lang('ds_common_save_succ'));
            }else{
                $this->log(lang('ds_edit').lang('ds_account'),0);
            }
        }
    }

    /**
     * 获取卖家栏目列表,针对控制器下的栏目
     */
    protected function getAdminItemList() {
        $menu_array = array(
            array(
                'name' => 'setting',
                'text' => lang('account_setting'),
                'url' => url('Account/setting')
            ),
        
        );
        return $menu_array;
    }

}

?>
