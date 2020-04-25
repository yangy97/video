<?php

/*
 * 支付相关处理
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
class  Payment extends BaseMall {

    public function _initialize() {
        parent::_initialize(); // TODO: Change the autogenerated stub
        Lang::load(APP_PATH . 'home/lang/'.config('default_lang').'/buy.lang.php');
    }


    /**
     * 虚拟商品购买
     */
    public function vr_order() {
        $order_sn = input('post.order_sn');
        $payment_code = input('post.payment_code');
        $url = url('Membervrorder/index');

        if (!preg_match('/^\d{20}$/', $order_sn)) {
            $this->error(lang('param_error'));
        }

        $logic_payment = model('payment', 'logic');
        
        $result = $logic_payment->getPaymentInfo($payment_code);
        if (!$result['code']) {
            $this->error($result['msg'], $url);
        }
        $payment_info = $result['data'];
  
        //计算所需支付金额等支付单信息
        $result = $logic_payment->getVrOrderInfo($order_sn, session('member_id'));
        
        if (!$result['code']) {
            $this->error($result['msg'], $url);
        }

        if ($result['data']['order_state'] != ORDER_STATE_NEW || empty($result['data']['api_pay_amount'])) {
            $this->error(lang('no_payment_required_this_order'), $url);
        }
    //   dump($result['data']);
    //   die;
        $logic_vrorder = model('vrorder','logic');
    $diff_pay_amount =0;

        //如果所需支付金额为0，转到支付成功页
        if ($diff_pay_amount == 0) {
            $post['payment_code'] = 'alipay';
            $info=$logic_vrorder->changeOrderStatePay($result['data'], 'system',$post);
            $info_susc=$logic_vrorder-> changeOrderStateSuccess($result['data']['order_id']);

            $this->redirect('buyvirtual/pay_ok',['order_sn'=>$result['data']['order_sn'],'order_id'=>$result['data']['order_id'],'order_amount'=>ds_price_format($result['data']['order_amount'])]);
        }
       
    }

    /**
     * 预存款充值
     */
    public function pd_order() {
        $pdr_sn = input('param.pdr_sn');
        $payment_code = input('param.payment_code');
        $url = url('Predeposit/index');

        if (!preg_match('/^\d{20}$/', $pdr_sn)) {
            $this->error(lang('param_error'), $url);
        }

        $logic_payment = model('payment', 'logic');
        $result = $logic_payment->getPaymentInfo($payment_code);
      
        if (!$result['code']) {
            $this->error($result['msg'], $url);
        }
        $payment_info = $result['data'];
     
        $result = $logic_payment->getPdOrderInfo($pdr_sn, session('member_id'));
      
        if (!$result['code']) {
            $this->error($result['msg'], $url);
        }
        if ($result['data']['pdr_payment_state'] || empty($result['data']['api_pay_amount'])) {
            $this->error(lang('no_payment_required'), $url);
        }
        $result['data']['pdr_payment_state']=1;
     $logic_result=   $logic_payment->updatePdOrder(null,$payment_code,$result['data'],$result['data']['pdr_sn']);
 
       if ($logic_result) {
           
           $pay_ok_url = HOME_SITE_URL . '/predeposit/index';
        }
        else{
            $this->error(lang('param_error'));
        }
        header("Location:$pay_ok_url");
        exit;
        // $this->_api_pay($result['data'], $payment_info);
    }

    /**
     * 第三方在线支付接口
     *
     */
    private function _api_pay($order_info, $payment_info) {
        // try{
           
        // $payment_api = new $payment_info['payment_code']($payment_info);
        // }catch(\Exception $e){
        //     $this->error($e->getMessage());
        // }
        // if ($payment_info['payment_code'] == 'wxpay_native') {
        //     if (!extension_loaded('curl')) {
        //         $this->error(lang('please_check_system_configuration'));
        //     }

        //     if (array_key_exists('order_list', $order_info)) {
        //         $this->assign('order_list', $order_info['order_list']);
        //         $this->assign('args', 'buyer_id=' . session('member_id') . '&pay_id=' . $order_info['pay_id']);
        //     } else {
        //         $this->assign('order_list', array());
        //         if ($order_info['order_type'] == 'pd_order') {
        //             $this->assign('args', 'buyer_id=' . session('member_id') . '&pdr_sn=' . $order_info['pdr_sn']);
        //         } else {
        //             $this->assign('args', 'buyer_id=' . session('member_id') . '&order_id=' . (isset($order_info['order_id']) ? $order_info['order_id'] : ''));
        //         }
        //     }
        //     $this->assign('api_pay_amount', $order_info['api_pay_amount']);
        //     try{
        //     $pay_url=base64_encode(ds_encrypt($payment_api->get_payform($order_info), MD5_KEY));
        //     }catch(\Exception $e){
        //         $this->error($e->getMessage());
        //     }
            
        //     $this->assign('pay_url', $pay_url);
        //     $this->assign('nav_list', rkcache('nav', true));
        //     echo $this->fetch($this->template_dir . 'wxpay');
        // } else {
        //     try{
        //     $pay_url=$payment_api->get_payform($order_info);
        //     }catch(\Exception $e){
        //         $this->error($e->getMessage());
        //     }
        //     @header("Location: " . $pay_url);
        // }
        try{
            // dump($order_info);
            // die;
            dump(new $payment_info['payment_code']($payment_info));
            die;
            $payment_api = new $payment_info['payment_code']($payment_info);
            dump(123);
            die;
                $pay_url=$payment_api->get_payform($order_info);
               
                }catch(\Exception $e){
                    $this->error($e->getMessage());
                }
                @header("Location: " . $pay_url);
        exit();
    }
    
    /**
     * 二维码显示(微信扫码支付) 
     */
    public function qrcode() {
        $data = base64_decode(input('data'));
        $data = ds_decrypt($data, MD5_KEY, 30);
        import('qrcode.phpqrcode', EXTEND_PATH);
        \QRcode::png($data);
    }
    /**
     * 扫码支付结果判断
     */
    public function query_state() {
        if (intval(input('param.order_id')) > 0) {
            $info = model('vrorder')->getVrorderInfo(array(
                'order_id' => intval(input('param.order_id')),
                'buyer_id' => intval(input('param.buyer_id'))
            ));
            exit(json_encode(array(
                'state' => ($info['order_state'] == '20'), 'pay_sn' => $info['order_sn'], 'type' => 'vr_order'
            )));
        } else {
            $result = model('payment', 'logic')->getPdOrderInfo(input('param.pdr_sn'), input('param.buyer_id'));
            exit(json_encode(array('state' => ($result['data']['pdr_payment_state'] == '1'), 'pdr_sn' => $result['data']['pdr_sn'], 'type' => 'pd_order')));
        }
    }

    /**
     * 
     * @param type $payment_code  共用回调方法
     * @param type $show_code  实际支付方式名称
     */
    public function notify($payment_code,$show_code='') {
        $logic_payment = model('payment', 'logic');
        $result = $logic_payment->getPaymentInfo($payment_code);
        $payment_info = $result['data'];

        //创建支付接口对象
        $payment_api = new $payment_info['payment_code']($payment_info);

        //对进入的参数进行远程数据判断
        $verify = $payment_api->verify_notify();
        if ($verify['trade_status'] != 1) {
            exit;
        }
        $out_trade_no = $verify['out_trade_no']; #内部订单号
        // $trade_no = $verify['trade_no']; #交易订单号
        $order_type = $verify['order_type']; #交易类型

        // $update_result = $logic_payment->updateOrder($out_trade_no, $trade_no, $order_type, $show_code?$show_code:$payment_code);
        $update_result = $logic_payment->updateOrder($out_trade_no, null, $order_type, $show_code?$show_code:$payment_code);

        exit($update_result ? 'success' : 'fail');
    }


    /**
     * 支付接口同步返回路径
     */
    public function alipay_return() {
        $this->return_verify('alipay');
    }

    /**
     * 银联同步通知
     */
    public function unionpay_return() {
        $this->return_verify('unionpay');
    }
    
    
    public function return_verify($payment_code){

        $logic_payment = model('payment', 'logic');
        //取得支付方式
        $result = $logic_payment->getPaymentInfo($payment_code);
        if (!$result['code']) {
            $this->error($result['msg'], 'Membervrorder/index');
        }
        $payment_info = $result['data'];

        //创建支付接口对象
        $payment_api = new $payment_info['payment_code']($payment_info);

        //返回参数判断
        $verify = $payment_api->return_verify();
        if (!$verify || $verify['trade_status']=='0') {
            $this->error(lang('payment_data_validation_failed'), 'Membervrorder/index');
        }
        $order_type=$verify['order_type'];
        $out_trade_no=$verify['out_trade_no'];
        $order_amount=$verify['total_fee'];
        //支付成功后跳转
        if ($order_type == 'vr_order') {
            $pay_ok_url = HOME_SITE_URL . '/buyvirtual/pay_ok?order_sn=' . $out_trade_no . '&order_amount=' . ds_price_format($order_amount);
        } elseif ($order_type == 'pd_order') {
            $pay_ok_url = HOME_SITE_URL . '/predeposit/index';
        }
        header("Location:$pay_ok_url");
        exit;
    }

    /**
     * 银联异步通知
     */
    public function unionpay_notify(){
        $this->notify('unionpay');
    }
    /**
     * 微信扫码支付异步通知
     */
    public function wxpay_native_notify() {
        $this->notify('wxpay_native');
    }
     /**
     * 小程序支付异步通知
     */
    public function wxpay_minipro_notify() {
        $this->notify('wxpay_native','wxpay_minipro');
    }
     /**
     * 微信支付支付异步通知
     */
    public function wxpay_jsapi_notify() {
        $this->notify('wxpay_native','wxpay_jsapi');
    }
    /**
     * 微信H5支付异步通知
     */
    public function wxpay_h5_notify() {
        $this->notify('wxpay_native','wxpay_h5');
    }
    /**
     * 微信APP支付异步通知
     */
    public function wxpay_app_notify() {
        $this->notify('wxpay_native','wxpay_app');
    }
    /**
     * 通知处理(支付宝异步对账)
     */
    public function alipay_notify() {
        $this->notify('alipay');
    }
    /**
     * 支付宝APP支付异步通知
     */
    public function alipay_app_notify() {
        $this->notify('alipay_app');
    }
    /**
     * 支付宝wap支付异步通知
     */
    public function alipay_h5_notify() {
        $this->notify('alipay','alipay_h5');
    }
    

}

?>