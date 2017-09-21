<?php
class GrcPool_Member_Host_Project_OBJ extends GrcPool_Member_Host_Project_MODEL {
	public function __construct() {
		parent::__construct();
	}
}

class GrcPool_Member_Host_Project_DAO extends GrcPool_Member_Host_Project_MODELDAO {

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
	 * @return GrcPool_Member_Host_Project_OBJ[]
	 */
	public function getWithMemberIdAndHostCpid(int $memberId,string $cpid) {
		return $this->fetchAll(array($this->where('memberId',$memberId),$this->where('hostCpid',$cpid)));
	}
	
	/**
	 * 
	 * @param int $memberId
	 * @return GrcPool_Member_Host_Project_OBJ[]
	 */
	public function getWithMemberId(int $memberId) {
		return $this->fetchAll(array($this->where('memberId',$memberId)));
	}
	
	/**
	 * 
	 * @param int $memberId
	 * @param int $dbid
	 * @param int $accountId
	 * @return NULL|GrcPool_Member_Host_Project_OBJ
	 */
 	public function getWithMemberIdAndDbidAndAccountId(int $memberId,int $dbid,int $accountId) {
 		return $this->fetch(array($this->where('memberId',$memberId),$this->where('hostDbid',$dbid),$this->where('accountId',$accountId)));
 	}
 	
 	/**
 	 * 
 	 * @param int $memberId
 	 * @param string $cpid
 	 * @param int $accountId
 	 * @return NULL|GrcPool_Member_Host_Project_OBJ
 	 */
 	public function getWithMemberIdAndCpidAndAccountId(int $memberId,string $cpid,int $accountId) {
 		return $this->fetch(array($this->where('memberId',$memberId),$this->where('hostCpid',$cpid),$this->where('accountId',$accountId)));
 	}
 	
	/**
	 * 
	 * @param int $memberId
	 * @return mixed[]
	 */
	public function getHostIdsWithErrors(int $memberId) {
		$datas = $this->fetchAll(array($this->where('memberid',$memberId),$this->where('hostDbid',0)));
		$ids = array();
		foreach ($datas as $data) {
			$ids[$data->getHostId()] = 1;
		}
		return $ids;
	}
	
	/**
	 * 
	 * @param int $hostId
	 * @param int $accountId
	 * @return NULL|GrcPool_Member_Host_Project_OBJ
	 */
	public function getActiveProjectForHost(int $hostId,int $accountId) {
		return $this->fetch(array($this->where('attached',2,'!='),$this->where('hostId',$hostId),$this->where('accountId',$accountId)));
	}
	
	/**
	 * 
	 * @param int $memberId
	 * @param int $hostId
	 * @return GrcPool_Member_Host_Project_OBJ[]
	 */
	public function getWithMemberIdAndHostId(int $memberId,int $hostId) {
		return $this->fetchAll(array($this->where('memberId',$memberId),$this->where('hostId',$hostId)));
	}
	
	/**
	 * 
	 * @param int $memberId
	 * @param int $dbId
	 * @return NULL|GrcPool_Member_Host_Project_OBJ
	 */
	public function getWithMemberIdAndDbid(int $memberId,int $dbId) {
		return $this->fetch(array($this->where('memberId',$memberId),$this->where('hostDbid',$dbId)));
	}

	/**
	 * 
	 * @param int $hostDbId
	 * @param int $accountId
	 * @return GrcPool_Member_Host_Project_OBJ[]
	 */
 	public function getWithHostDbIdAndAccountId(int $hostDbId,int $accountId) {
 		return $this->fetchAll(array($this->where('hostDbid',$hostDbId),$this->where('accountId',$accountId)));
 	}
	
	/**
	 * 
	 * @param int $memberId
	 * @param int $hostId
	 */
	public function deleteWithMemberIdAndHostId(int $memberId,int $hostId) {
		$sql = 'delete from '.$this->getFullTableName().' where hostId = '.addslashes($hostId).' and memberId = '.addslashes($memberId).'';
		$this->executeQuery($sql);
	}
}
