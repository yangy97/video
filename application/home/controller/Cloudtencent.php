<?php

namespace app\home\controller;

use think\Lang;
use think\Loader;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 控制器
 */
class  Cloudtencent extends BaseMall {

    public function _initialize() {
        parent::_initialize();
    }

    public function sign() {
// 确定 App 的云 API 密钥
        $secret_id = "自己腾讯云id";
        $secret_key = "自己腾讯云key";

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

        ds_json_encode(10000,'',$signature);
    }

    public function test() {

        return $this->fetch($this->template_dir . 'test');
    }

}
