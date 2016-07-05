<?php
namespace Common\Model;
use Common\Model\CommonModel;
class ProductsModel extends CommonModel {
	/*
	 * 表结构
	 * id:post的自增id
	 * author:管理员的id
	 * user:用户的id
	 * keyword
	 * title
	 * area:主要销售区域
	 * business_type:业务形式（生产、销售、批发）
	 * status:审核状态
	 * brand:品牌
	 * num:产品数量
	 * price_info:价格说明
	 * ems_info:物理说明
	 * type:产品类型（供应、采购、招商合作）
	 * content:详细说明
	 * smeta:扩展属性
	 * date:发布日期
	 */

	protected $_auto = array (
		array ('date', 'mGetDate', 1, 'callback' ), 	// 增加的时候调用回调函数
	);
	
	// 获取当前时间
	function mGetDate() {
		return date( 'Y-m-d H:i:s' );
	}
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}
}