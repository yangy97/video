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
class  Memberinvoice extends BaseMember {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'home/lang/' . config('default_lang') . '/memberinvoice.lang.php');
    }

    /*
     * 收货地址列表
     */

    public function index() {
        $invoice_model = model('invoice');
        $invoice_list = $invoice_model->getInvoiceList(array('member_id' => session('member_id')));
        $this->assign('invoice_list', $invoice_list);

        /* 设置买家当前菜单 */
        $this->setMemberCurMenu('member_invoice');
        /* 设置买家当前栏目 */
        $this->setMemberCurItem('my_invoice');
        return $this->fetch($this->template_dir . 'index');
    }

    private function get_data() {
        $data = array();
        $data['invoice_state'] = input('post.invoice_state');
        $data['invoice_title'] = input('post.invoice_title');
        $data['invoice_content'] = input('post.invoice_content');
        $data['invoice_code'] = input('post.invoice_code');
        $data['invoice_company'] = input('post.invoice_company');
        $data['invoice_company_code'] = input('post.invoice_company_code');
        $data['invoice_reg_addr'] = input('post.invoice_reg_addr');
        $data['invoice_reg_phone'] = input('post.invoice_reg_phone');
        $data['invoice_reg_bname'] = input('post.invoice_reg_bname');
        $data['invoice_reg_baccount'] = input('post.invoice_reg_baccount');
//                $data['invoice_rec_name'] = input('post.invoice_rec_name');
//                $data['invoice_rec_mobphone'] = input('post.invoice_rec_mobphone');
//                $data['invoice_rec_province'] = input('post.area_info');
//                $data['invoice_goto_addr'] = input('post.invoice_goto_addr');
        return $data;
    }

    public function add() {
        if (!request()->isPost()) {

            $invoice = $this->get_data();
            $invoice['invoice_state']=1;
            $this->assign('invoice', $invoice);
            /* 设置买家当前菜单 */
            $this->setMemberCurMenu('member_invoice');
            /* 设置买家当前栏目 */
            $this->setMemberCurItem('my_invoice_add');
            return $this->fetch($this->template_dir . 'form');
        } else {
            $data = $this->get_data();
            $data['member_id'] = session('member_id');
            $memberinvoice_validate = validate('invoice');
            $scene='';
            if($data['invoice_state']==1){
                $scene = 'invoice_1_update';
            }else{
                $scene = 'invoice_2_update';
            }
            if (!$memberinvoice_validate->scene($scene)->check($data)) {
                ds_json_encode(10001, $memberinvoice_validate->getError());
            }

            $invoice_model = model('invoice');
            $result = $invoice_model->addInvoice($data);
            if ($result) {
                ds_json_encode(10000, lang('ds_common_save_succ'));
            } else {
                ds_json_encode(10001, lang('ds_common_save_fail'));
            }
        }
    }

    public function edit() {

        $invoice_id = intval(input('param.invoice_id'));
        if (0 >= $invoice_id) {
            ds_json_encode(10001, lang('param_error'));
        }
        $invoice_model = model('invoice');
        $invoice = $invoice_model->getInvoiceInfo(array('member_id' => session('member_id'), 'invoice_id' => $invoice_id));
        if (empty($invoice)) {
            ds_json_encode(10001, lang('invoice_does_not_exist'));
        }
        if (!request()->isPost()) {

            $this->assign('invoice', $invoice);
            /* 设置买家当前菜单 */
            $this->setMemberCurMenu('member_invoice');
            /* 设置买家当前栏目 */
            $this->setMemberCurItem('my_invoice_edit');
            return $this->fetch($this->template_dir . 'form');
        } else {
            $data = $this->get_data();
            $memberinvoice_validate = validate('invoice');
            $scene='';
            if($data['invoice_state']==1){
                $scene = 'invoice_1_update';
            }else{
                $scene = 'invoice_2_update';
            }
            if (!$memberinvoice_validate->scene($scene)->check($data)) {
                ds_json_encode(10001, $memberinvoice_validate->getError());
            }

            $result = $invoice_model->editInvoice($data, array('member_id' => session('member_id'), 'invoice_id' => $invoice_id));
            if ($result) {
                ds_json_encode(10000, lang('ds_common_save_succ'));
            } else {
                ds_json_encode(10001, lang('ds_common_save_fail'));
            }
        }
    }

    public function drop() {
        $invoice_id = intval(input('param.invoice_id'));
        if (0 >= $invoice_id) {
            ds_json_encode(10001, lang('empty_error'));
        }
        $invoice_model = model('invoice');
        $result = $invoice_model->delInvoice(array('invoice_id' => $invoice_id));
        if ($result) {
            ds_json_encode(10000, lang('ds_common_del_succ'));
        } else {
            ds_json_encode(10001, lang('ds_common_del_fail'));
        }
    }

    /**
     *    栏目菜单
     */
    function getMemberItemList() {
        $item_list = array(
            array(
                'name' => 'my_invoice',
                'text' => lang('my_invoice'),
                'url' => url('Memberinvoice/index'),
            ),
            array(
                'name' => 'my_invoice_add',
                'text' => lang('new_invoice'),
                'url' => url('Memberinvoice/add'),
            ),
        );
        if (request()->action() == 'edit') {
            $item_list[] = array(
                'name' => 'my_invoice_edit',
                'text' => lang('edit_invoice'),
                'url' => "javascript:void(0)",
            );
        }

        return $item_list;
    }

}

?>
