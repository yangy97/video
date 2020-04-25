<?php

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
class  Qrcode extends BaseMall {

    public function index() {
       import('qrcode.phpqrcode', EXTEND_PATH);
        $value = htmlspecialchars_decode(input('get.url'));
        $errorCorrectionLevel = "L";
        $matrixPointSize = "4";
        \QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize,2);
        exit;
    }

}
