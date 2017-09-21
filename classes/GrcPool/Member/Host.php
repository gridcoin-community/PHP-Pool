<?php
class GrcPool_Member_Host_OBJ extends GrcPool_Member_Host_MODEL {
	public function __construct() {
		parent::__construct();
	}
}

class GrcPool_Member_Host_DAO extends GrcPool_Member_Host_MODELDAO {

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
	 * @param string $cpid
	 * @return NULL|GrcPool_Member_Host_OBJ
	 */
	public function initWithMemberIdAndCpId(int $memberId,string $cpid) {
		return $this->fetch(array($this->where('memberId',$memberId),$this->where('cpId',$cpid)));
	}
	
	/**
	 * 
	 * @param int $memberId
	 * @return GrcPool_Member_Host_OBJ[]
	 */
	public function getWithMemberId(int $memberId) {
		return $this->fetchAll(array($this->where('memberId',$memberId)));
	}
	
	public static function sortByDisplayedHostName($a,$b) {
		return strnatcasecmp($a->getCustomName()?$a->getCustomName():$a->getHostName(),$b->getCustomName()?$b->getCustomName():$b->getHostName());
	}
	
}