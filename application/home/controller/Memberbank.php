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
class Memberbank extends BaseMember {
    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'home/lang/'.config('default_lang').'/memberbank.lang.php');
    }
    
    public function index() {
        $memberbank_model=model('memberbank');
        $memberbank_list = $memberbank_model->getMemberbankList(array('member_id'=>session('member_id')));
        $this->assign('memberbank_list', $memberbank_list);

        /* 设置买家当前菜单 */
        $this->setMemberCurMenu('member_bank');
        /* 设置买家当前栏目 */
        $this->setMemberCurItem('memberbank_index');
        return $this->fetch($this->template_dir . 'index');
    }
    
    
    public function add() {
        if (!request()->isPost()) {
            $memberbank = array(
                'memberbank_type' => 'bank',
            );
            $this->assign('memberbank', $memberbank);
            /* 设置买家当前菜单 */
            $this->setMemberCurMenu('member_bank');
            /* 设置买家当前栏目 */
            $this->setMemberCurItem('memberbank_add');
            return $this->fetch($this->template_dir . 'form');
        } else {
            $data = array(
                'member_id' => session('member_id'),
                'memberbank_type' => input('post.memberbank_type'),
                'memberbank_truename' => input('post.memberbank_truename'),
                'memberbank_name' => input('post.memberbank_name'),
                'memberbank_no' => input('post.memberbank_no'),
            );
            $memberbank_validate = validate('memberbank');
            if (!$memberbank_validate->scene('add')->check($data)) {
                ds_json_encode(10001,$memberbank_validate->getError());
            }

            $memberbank_model=model('memberbank');
            $result = $memberbank_model->addMemberbank($data);
            if ($result) {
                ds_json_encode(10000,lang('ds_common_save_succ'));
            } else {
                ds_json_encode(10001,lang('ds_common_save_fail'));
            }
        }
    }

    public function edit() {

        $memberbank_id = intval(input('param.memberbank_id'));
        if (0 >= $memberbank_id) {
            ds_json_encode(10001,lang('param_error'));
        }
        $memberbank_model=model('memberbank');
        $memberbank = $memberbank_model->getMemberbankInfo(array('member_id' => session('member_id'), 'memberbank_id' => $memberbank_id));
        if (empty($memberbank)) {
            ds_json_encode(10001,lang('memberbank_does_not_exist'));
        }
        if (!request()->isPost()) {
            $this->assign('memberbank', $memberbank);
            /* 设置买家当前菜单 */
            $this->setMemberCurMenu('member_bank');
            /* 设置买家当前栏目 */
            $this->setMemberCurItem('memberbank_edit');
            return $this->fetch($this->template_dir . 'form');
        } else {
            $data = array(
                'memberbank_type' => input('post.memberbank_type'),
                'memberbank_truename' => input('post.memberbank_truename'),
                'memberbank_name' => input('post.memberbank_name'),
                'memberbank_no' => input('post.memberbank_no'),
            );
            $memberbank_validate = validate('memberbank');
            if (!$memberbank_validate->scene('edit')->check($data)) {
                ds_json_encode(10001,$memberbank_validate->getError());
            }

            $result = $memberbank_model->editMemberbank($data,array('member_id' => session('member_id'), 'memberbank_id' => $memberbank_id));
            if ($result) {
                ds_json_encode(10000,lang('ds_common_save_succ'));
            } else {
                ds_json_encode(10001,lang('ds_common_save_fail'));
            }
        }
    }
    public function drop() {
        $memberbank_id = intval(input('param.memberbank_id'));
        if (0 >= $memberbank_id) {
            ds_json_encode(10001,lang('empty_error'));
        }
        $memberbank_model=model('memberbank');
        $condition = array();
        $condition['memberbank_id'] = $memberbank_id;
        $condition['member_id'] = session('member_id');
        $result = $memberbank_model->delMemberbank($condition);
        if ($result) {
            ds_json_encode(10000,lang('ds_common_del_succ'));
        } else {
            ds_json_encode(10001,lang('ds_common_del_fail'));
        }
    }
    /**
     *    栏目菜单
     */
    function getMemberItemList() {
        $item_list = array(
            array(
                'name' => 'memberbank_index',
                'text' => lang('memberbank_index'),
                'url' => url('Memberbank/index'),
            ),
            array(
                'name' => 'memberbank_add',
                'text' => lang('memberbank_add'),
                'url' => url('Memberbank/add'),
            ),
        );
        if (request()->action() == 'edit') {
            $item_list[] = array(
                'name' => 'memberbank_edit',
                'text' => lang('memberbank_edit'),
                'url' => "javascript:void(0)",
            );
        }
        return $item_list;
    }
}