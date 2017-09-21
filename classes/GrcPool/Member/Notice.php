<?php
class GrcPool_Member_Notice_OBJ extends GrcPool_Member_Notice_MODEL {
	
	const NOTICE_DELETE = 1;
	
	public function __construct() {
		parent::__construct();
	}

}

class GrcPool_Member_Notice_DAO extends GrcPool_Member_Notice_MODELDAO {

	/**
	 * 
	 * @param int $memberId
	 */
	public function deleteWithMemberId(int $memberId) {
		$sql = 'delete from '.$this->getFullTableName().' where memberId = '.$memberId;
		$this->executeQuery($sql);
	}
	
	/**
	 * 
	 * @param int $memberId
	 * @param int $noticeId
	 * @return boolean
	 */
	public function isNoticeForMembeAndId(int $memberId,int $noticeId) {
		 $obj = $this->fetch(array($this->where('noticeId',$noticeId),$this->where('memberId',$memberId)));
		 return $obj!=null?true:false;
	}
	
}