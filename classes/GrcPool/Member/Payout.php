<?php
class GrcPool_Member_Payout_OBJ extends GrcPool_Member_Payout_MODEL {
	public function __construct() {
		parent::__construct();
	}
}

class GrcPool_Member_Payout_DAO extends GrcPool_Member_Payout_MODELDAO {
	
	/**
	 * 
	 * @param int $memberId
	 * @return number
	 */
	public function getTotalForMemberId(int $memberId) {
		$sql = 'select sum(amount) as total from '.$this->getFullTableName().' where memberId = '.$memberId;
		$results = $this->query($sql);
		if (isset($results[0]) && isset($results[0]['total'])) {
			return $results[0]['total'];
		} else {
			return 0;
		}
	}
	
	/**
	 * 
	 * @param int $memberId
	 * @param int $since
	 * @return GrcPool_Member_Payout_OBJ[]
	 */
	public function getWithMemberIdSince(int $memberId,int $since) {
		return $this->fetchAll(array($this->where('memberId',$memberId),$this->where('thetime',$since,'>=')),array('thetime'=>'asc'));
	}
	
	/**
	 * 
	 * @param unknown $limit
	 */
	public function getTopEarners($limit) {
		$sql = 'select memberId,username,sum(amount) as totalAmount from '.$this->getFullTableName().' group by memberId,username order by totalAmount desc limit '.$limit;
		return $this->query($sql);
	}
	
	/**
	 * 
	 * @return number
	 */
	public function getTotalAmount() {
		$sql = 'select sum(amount) as totalAmount from '.$this->getFullTableName();
		$result = $this->query($sql);
		return $result[0]['totalAmount'];
	}
	
	/**
	 * 
	 * @param unknown $limit
	 */
	public function getTopDonators($limit) {
		$sql = 'select memberId,username,sum(donation) as totalAmount from '.$this->getFullTableName().' group by memberId,username order by totalAmount desc limit '.$limit;
		return $this->query($sql);
	}
	
	/**
	 * 
	 * @param array $limit
	 * @return GrcPool_Member_Payout_OBJ[]
	 */
	public function getLatest($limit = array()) {
		return $this->fetchAll(array(),array('thetime' => 'desc'),$limit);
	}
	
	/**
	 * 
	 * @param int $id
	 * @return number
	 */
	public function getCountForUser(int $id) {
		return $this->getCount(array($this->where('memberId',$id)));
	}
	
	/**
	 * 
	 * @param int $id
	 * @param array $limit
	 * @return GrcPool_Member_Payout_OBJ[]
	 */
	public function getWithMemberId(int $id,$limit = array()) {
		return $this->fetchAll(array($this->where('memberId',$id)),array('thetime' => 'desc'),$limit);
	}
	
	/**
	 * 
	 * @param int $id
	 * @return number
	 */
	public function getPayoutTotalForUser(int $id) {
		$sql = 'select sum(amount) as total from '.$this->getFullTableName().' where memberId = '.$id;
		$result = $this->query($sql);
		return $result[0]['total'];
	}
	
}