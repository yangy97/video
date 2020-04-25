<?php
/**
 * 验证码
 *
 */

namespace app\home\controller;


use think\captcha\Captcha;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 控制器
 */
class  Seccode
{
    /**
     *产生验证码
     */
    public function makecode()
    {
        $config = [
            'fontSize' => 20, // // 验证码字体大小
            'length' => 4, // 验证码位数
            'useNoise' => false,//是否添加杂点
            'useCurve' =>true,
            'imageH' => 50,//高度
            'imageW' => 150,
        ];

        $captcha = new Captcha($config);
        return $captcha->entry();
    }

    /**
     * AJAX验证
     */
    public function check()
    {
        $config = config('captcha');
        if(input('param.reset')=='false'){
            //验证成功之后,验证码是否失效,验证成功后是否重置
            $config['reset'] = FALSE;
        }
        $captcha = new Captcha($config);
        $code = input('param.captcha');
        if ($captcha->check($code)) {
            exit('true');
        }
        else {
            exit('false');
        }
    }
}