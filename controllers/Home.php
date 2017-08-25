<?php
class GrcPool_Controller_Home extends GrcPool_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function indexAction() {
		
		$hostCreditDao = new GrcPool_Member_Host_Credit_DAO();
		
		$cache = new Cache();
		$superblockData = new SuperBlockData($cache->get(Constants::CACHE_SUPERBLOCK_DATA));

		$this->view->mag = $hostCreditDao->getTotalMag();
		$this->view->activeHosts = $hostCreditDao->getNumberOfActiveHosts();
		
		$settingsDao = new GrcPool_Settings_DAO();
		$this->view->poolWhiteListCount = $settingsDao->getValueWithName(Constants::SETTINGS_POOL_WHITELIST_COUNT);
		$this->view->txFee = $settingsDao->getValueWithName(Constants::SETTINGS_PAYOUT_FEE);
		$this->view->minPayout = $settingsDao->getValueWithName(Constants::SETTINGS_MIN_OWE_PAYOUT);
		$this->view->minStake = $settingsDao->getValueWithName(Constants::SETTINGS_MIN_STAKE_BALANCE);
		$this->view->totalPaidOut = $settingsDao->getValueWithName(Constants::SETTINGS_TOTAL_PAID_OUT);
		$this->view->cpid = $settingsDao->getValueWithName(Constants::SETTINGS_CPID);
		$this->view->online = $settingsDao->getValueWithName(Constants::SETTINGS_GRC_CLIENT_ONLINE);
		$this->view->onlineMessage = '';
		if (!$this->view->online) {
			$this->view->onlineMessage = $settingsDao->getValueWithName(Constants::SETTINGS_GRC_CLIENT_MESSAGE);
		}
		$this->view->superblockData = $superblockData;
		
	}
	
}