<?php
namespace app\common\model;
use think\Model;
/**
 * ============================================================================
 *在线教育培训付费视频管理系统
 * ============================================================================
 * 版权所有 重庆师范大学计算机科学与技术杨玉印，并保留所有权利。
 * 网站地址: http://yyu.loveli.top

 * ============================================================================
 * 数据层模型
 */
class  Wechat extends Model
{
    public $page_info;
    public $wxconfig;
    public $error_message='';
    public $error_code=0;
    /**
     * 获取公众号配置信息
     * @access public
     * @author csdeshang
     * @return type
     */
    public function getOneWxconfig(){
        $this->wxconfig=db('wxconfig')->find();
        return $this->wxconfig;
    }

    /**
     * 增加微信配置
     * @access public
     * @author csdeshang
     */
    public function addWxconfig($data) {
        return db('wxconfig')->insert($data);
    }

    /**
     * 编辑微信配置
     * @access public
     * @author csdeshang
     */
    public function editWxconfig($condition, $data) {
        return db('wxconfig')->where($condition)->update($data);
    }

    /**
     * 获取微信菜单列表
     * @access public
     * @author csdeshang
     */
    public function getWxmenuList($condition, $order = 'id asc', $field = '*') {
        return db('wxmenu')->field($field)->where($condition)->order($order)->select();
    }

    /**
     * 关键字查询
     * @access public
     * @author csdeshang
     * @param type $field 字段
     * @param type $wh 条件
     * @param type $order 排序
     * @return type
     */
    public function getOneJoinWxkeyword($condition, $field = '', $order = 't.createtime DESC') {
        $condition['k.type'] = 'TEXT';
        $lists = db('wxkeyword')->alias('k')->join('__WXTEXT__ t', 't.id=k.pid', 'LEFT')->where($condition)->field($field)->order($order)->find();
        return $lists;
    }

    /**
     * 获取单个关键词回复
     * @param type $condition
     * @return type
     */
    public function getOneWxkeyword($condition) {
        return db('wxkeyword')->where($condition)->find();
    }

    /**
     * 获取关键词回复列表
     * @param type $condition
     * @param type $field
     * @param type $pagesize
     * @param type $order
     * @return type
     */
    public function getWxkeywordList($condition, $field = '*', $pagesize='', $order='t.createtime DESC') {
        if ($pagesize) {
            $lists = db('wxkeyword')->alias('k')->join('__WXTEXT__ t', 't.id=k.pid', 'LEFT')->where($condition)->field($field)->order($order)->paginate(10, false, ['query' => request()->param()]);
            $this->page_info = $lists;
            return $lists->items();
        } else {
            return $lists = db('wxkeyword')->alias('k')->join('__WXTEXT__ t', 't.id=k.pid', 'LEFT')->where($condition)->field($field)->order($order)->select();
        }
    }

    /**
     * 新增关键词回复
     * @param type $add
     * @return type
     */
    public function addWxkeyword($add) {
        return db('wxkeyword')->insert($add);
    }

    /**
     * 编辑关键词回复
     * @param type $condition
     * @param type $data
     * @return type
     */
    public function editWxkeyword($condition, $data) {
        return db('wxkeyword')->where($condition)->update($data);
    }

    /**
     * 删除关键词回复
     * @param type $condition
     * @return type
     */
    public function delWxkeyword($condition) {
        return db('wxkeyword')->where($condition)->delete();
    }

    /**
     * 新增文本回复
     * @param array $add
     * @return type
     */
    public function addWxtext($add) {
        return db('wxtext')->insertGetId($add);
    }

    /**
     * 编辑文本回复
     * @param type $condition
     * @param type $data
     * @return type
     */
    public function editWxtext($condition, $data) {
        return db('wxtext')->where($condition)->update($data);
    }

    /**
     * 删除文本回复
     * @param type $condition
     * @return type
     */
    public function delWxtext($condition) {
        return db('wxtext')->where($condition)->delete();
    }

    /**
     * 会员查询
     * @access public
     * @author csdeshang
     * @return type
     */
    public function getWxmemberList() {
        $info = db('member')->where('member_wxinfo','not null')->where('member_wxopenid','neq','')->where('member_wxunionid','neq','')->field('member_name,member_addtime,member_wxunionid,member_wxopenid,member_id')->paginate(8, false, ['query' => request()->param()]);
        $this->page_info = $info;
        return $info->items();
    }

    /**
     * 增加
     * @access public
     * @author csdeshang
     * @param type $data 数据
     * @return type 
     */
    public function addWxmsg($data) {
        db('wxmsg')->insertGetId($data);
    }

    /**
     * 获取列表
     * @access public
     * @author csdeshang
     * @param type $where 条件
     * @return type
     */
    public function getWxmsgList($where = '') {
        $res = db('wxmsg')->alias('w')->join('__MEMBER__ m', 'w.member_id=m.member_id', 'LEFT')->where($where)->field('w.*,m.member_name')->order('createtime DESC')->paginate(10, false, ['query' => request()->param()]);
        $this->page_info = $res;
        return $res->items();
    }

    /**
     * 删除消息推送
     * @param type $condition
     * @return type
     */
    public function delWxmsg($condition){
        return db('wxmsg')->where($condition)->delete();
    }

        /**
     * 获取单个微信菜单
     * @param type $condition
     * @return type
     */
    public function getOneWxmenu($condition) {
        return db('wxmenu')->where($condition)->find();
    }

    /**
     * 获取微信菜单数量
     * @param type $condition
     * @return type
     */
    public function getWxmenuCount($condition) {
        return db('wxmenu')->where($condition)->count();
    }

    /**
     * 编辑微信菜单
     * @param type $condition
     * @param type $data
     * @return type
     */
    public function editWxmenu($condition, $data) {
        return db('wxmenu')->where($condition)->update($data);
    }

    /**
     * 新增微信菜单
     * @param type $data
     * @return type
     */
    public function addWxmenu($data) {
        return db('wxmenu')->insert($data);
    }

    /**
     * 删除微信菜单
     * @param type $condition
     * @return type
     */
    public function delWxmenu($condition) {
        return db('wxmenu')->where($condition)->delete();
    }

    /**
     * 获取微信菜单列表
     * @param type $condition
     * @return type
     */
    public function getMenulist($condition) {
        return db('wxmenu')->where($condition)->select();
    }
    //校验AccessToken 是否可用及返回新的
    public function getAccessToken($from='',$force=0) {
        
        if($from=='miniprogram'){
            $expires_in=$this->wxconfig['xcx_expires_in'];
            $appid=$this->wxconfig['xcx_appid'];
            $appsecret=$this->wxconfig['xcx_appsecret'];
            $access_token = $this->wxconfig['xcx_access_token'];
        }else{
            $expires_in=$this->wxconfig['expires_in'];
            $appid=$this->wxconfig['appid'];
            $appsecret=$this->wxconfig['appsecret'];
            $access_token = $this->wxconfig['access_token'];
        }
        
        
        //token过期，重新拉去
        if ($expires_in < TIMESTAMP + 7200) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
            $res = json_decode(http_request($url));
            if (isset($res->access_token)) {
		$access_token = $res->access_token;
                $this->error_message='';
                $this->error_code=0;
                $expire_time = TIMESTAMP + 7000;
                if($from=='miniprogram'){
                    $data=array('xcx_access_token' => $access_token, 'xcx_expires_in' => $expire_time);
                }else{
                    $data=array('access_token' => $access_token, 'expires_in' => $expire_time);
                }
                db('wxconfig')->where(array('id' => $this->wxconfig['id']))->update($data);
            }else{
                $this->error_message=$res->errmsg;
                $this->error_code=$res->errcode;
            }
        }
        
        return $access_token;
    }
    function getMiniProCode($scene,$page='pages/index/index'){
        $accessToken = $this->getAccessToken('miniprogram',0);
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=".$accessToken;
        $data = http_request($url,'POST', json_encode(array(
            'scene'=>$scene,
            'page'=>$page,
        )));
        if(isset($data->errcode) && $data->errcode=='42001'){
            $accessToken = $this->getAccessToken('miniprogram',0);
            $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=".$accessToken;
            $data = http_request($url,'POST', json_encode(array(
                'scene'=>$scene,
                'page'=>$page,
            )));

        }
        
        return $data;
        
    }
        function getJsapiTicket() {
            $ticket=$this->wxconfig['ticket'];
            if($this->wxconfig['ticket_expires_in'] < time()){
                $accessToken = $this->getAccessToken();
        
                $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$accessToken."&type=jsapi";
                $data = http_request($url);
                $data = json_decode($data, true);

                if(isset($data['ticket'])){
                    db('wxconfig')->where(array('id' => $this->wxconfig['id']))->update(array('ticket' => $data['ticket'], 'ticket_expires_in' => (time()+$data['expires_in'])));
                    $ticket=$data['ticket'];
                }else{
                    $this->error_message=$data['errmsg'];
                    $this->error_code=$data['errcode'];
                }
                
            }
        
        return $ticket;
    }
  public function getSignPackage($url='') {
    $jsapiTicket = $this->getJsapiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    if(!$url){
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    $timestamp = time();
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $nonceStr = "";
    for ($i = 0; $i < 16; $i++) {
      $nonceStr .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->wxconfig['appid'],
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

    /**
     * 发送模板消息
     * @param type $accessToken
     * @param type $openid
     * @param type $template_id
     * @param type $url
     * @param type $data
     * @param type $topcolor
     */
    function sendMessageTemplate($openid, $template_id, $url, $data, $topcolor = '#333') {

        $accessToken = $this->getAccessToken();
        if ($this->error_code) {
            return ds_callback(false, $this->error_message);
        }

        $template = array(
            'touser' => $openid,
            'template_id' => $template_id,
            'url' => $url,
            'topcolor' => $topcolor,
            'data' => $data
        );
        $json_template = json_encode($template);
        $post_url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $accessToken;
        $dataRes = http_request($post_url,'POST', $json_template);
        $dataRes= json_decode($dataRes,true);
        if ($dataRes['errcode']==0) {
            return ds_callback(true);
        } else {
            return ds_callback(false, $dataRes['errmsg']);
        }
    }
}