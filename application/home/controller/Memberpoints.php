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
class  Memberpoints extends BaseMember {

    public function _initialize() {
        parent::_initialize();
        Lang::load(APP_PATH . 'home/lang/'.config('default_lang').'/memberpoints.lang.php');
    }

    /**
     * 积分日志列表
     */
    public function index() {
        $condition_arr = array();
        $condition_arr['pl_memberid'] = session('member_id');
        if (input('param.stage')) {
            $condition_arr['pl_stage'] = input('param.stage');
        }

        $saddtime = input('get.stime');
        $etime = input('get.etime');
        $if_start_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $saddtime);
        $if_end_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $etime);
        $start_unixtime = $if_start_time ? strtotime($saddtime) : null;
        $end_unixtime = $if_end_time ? strtotime($etime) : null;
        if ($start_unixtime || $end_unixtime) {
            $condition_arr['pl_addtime'] = array('between', array($start_unixtime, $end_unixtime));
        }

        $pl_desc = input('get.description');
        if (!empty($pl_desc)) {
            $condition_arr['pl_desc'] = array('like', '%' . $pl_desc . '%');
        }
        //分页
        //查询积分日志列表
        $points_model = model('points');
        $list_log = $points_model->getPointslogList($condition_arr, '10', '*', '');
        $member_points=model('member')->getMemberInfo(array('member_id'=>session('member_id')),'member_points');
        /* 设置买家当前菜单 */
        $this->setMemberCurMenu('member_points');
        /* 设置买家当前栏目 */
        $this->setMemberCurItem('points');
        $this->assign('show_page', $points_model->page_info->render());
        $this->assign('list_log', $list_log);
        $this->assign('member_points', $member_points);
        return $this->fetch($this->template_dir . 'index');
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type 导航类型
     * @param string $menu_key 当前导航的menu_key
     * @param array $array 附加菜单
     * @return
     */
    protected function getMemberItemList() {
        $menu_array = array(
            array(
                'name' => 'points',
                'text' => lang('ds_member_path_points'),
                'url' => url('Memberpoints/index')
            ),
        );
        return $menu_array;
    }

}
