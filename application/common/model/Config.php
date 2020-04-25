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
class  Config extends Model
{


    /**
     * 读取系统设置信息
     * @access public
     * @author csdeshang
     * @param string $name 系统设置信息名称
     * @return array 数组格式的返回结果
     */
    public function getOneConfigByCode($code){
        $where	= "code='".$code."'";
        $result=db('config')->where($where)->select();
        if(is_array($result) and is_array($result[0])){
            return $result[0];
        }
        return false;
    }
  
    /**
     * 读取系统设置列表
     * @access public
     * @author csdeshang 
     * @return type
     */
    public function getConfigList()
    {
        $result = db('config')->select();
        if (is_array($result)) {
            $list_config = array();
            foreach ($result as $k => $v) {
                $list_config[$v['code']] = $v['value'];
            }
        }
        return $list_config;
    }

    /**
     * 更新信息
     * @access public
     * @author csdeshang
     * @param array $data 更新数据
     * @return bool 布尔类型的返回结果
     */
    public function editConfig($data)
    {
        if (empty($data)) {
            return false;
        }
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $tmp = array();
                $specialkeys_arr = array('statistics_code');
                $tmp['value'] = (in_array($k, $specialkeys_arr) ? htmlentities($v, ENT_QUOTES) : $v);
                $result = db('config')->where('code', $k)->update($tmp);
            }
            dkcache('config');
            return true;
        } else {
            return false;
        }
    }

}

?>
