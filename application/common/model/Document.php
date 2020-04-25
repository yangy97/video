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
class  Document extends Model {

    /**
     * 查询所有系统文章
     * @access public
     * @author csdeshang 
     * @return type
     */
    public function getDocumentList() {
        return db('document')->select();
    }

    /**
     * 根据编号查询一条
     * @access public
     * @author csdeshang 
     * @param int $id 文章id
     * @return array
     */
    public function getOneDocumentById($id) {
        return db('document')->where('document_id',$id)->find();
    }

    /**
     * 根据标识码查询一条
     * @access public
     * @author csdeshang
     * @param type $code 标识码
     * @return type
     */
    public function getOneDocumentByCode($code) {
        return db('document')->where('document_code',$code)->find();
    }

    /**
     * 更新
     * @access public
     * @author csdeshang
     * @param array $data 更新数据
     * @return bool
     */
    public function editDocument($data) {
        return db('document')->where('document_id',$data['document_id'])->update($data);
    }
}

?>
