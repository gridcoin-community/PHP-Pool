<?php
class GrcPool_Boinc_Account_Key_OBJ extends GrcPool_Boinc_Account_Key_MODEL {
	public function __construct() {
		parent::__construct();
	}
}

class GrcPool_Boinc_Account_Key_DAO extends GrcPool_Boinc_Account_Key_MODELDAO {

	/**
	 * 
	 * @param int $id
	 * @return NULL|GrcPool_Boinc_Account_Key_OBJ
	 */
	public function getWithAccount(int $id) {
		return $this->fetch(array($this->where('accountId',$id)));
	}
	
}