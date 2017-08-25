<?php
class GrcPool_Controller_Project extends GrcPool_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function indexAction() {
 		$this->poolStatsAction();
 		$this->setRenderView('projectPoolStats');
	}
	
	public function chooseAction() {
		$this->setRenderView('helpChooseProject');
	}

	public function poolStatsAction() {
		

		$cache = new Cache();
		$superBlock = $cache->get(Constants::CACHE_SUPERBLOCK_DATA);
		$superBlock = json_decode($superBlock,true);
		$this->view->numberOfProjects = $superBlock['whiteListCount'];
		$this->view->networkProjects = $superBlock['projects'] ?? array();
		
		$accountDao = new GrcPool_Boinc_Account_DAO();
		$accounts = $accountDao->fetchAll(array(),array('name'=>'asc'));

		$keyDao = new GrcPool_Boinc_Account_Key_DAO();
		$keys = $keyDao->fetchAll();
		
		$this->view->accounts = array();
		foreach ($accounts as $account) {
			$obj = $keyDao->fetchObj($keys,array($keyDao->where('accountId',$account->getId())));
			if ($obj) {
				$account->attach = $account->getWhiteList()&&$account->getAttachable()&&$obj->getWeak()!=''&&$obj->getAttachable();
			} else {
				$account->attach = false;
			}
			array_push($this->view->accounts,$account);	
		}
				
		$hostCreditDao = new GrcPool_Member_Host_Credit_DAO();
		$totalMag = $hostCreditDao->getTotalMag();
		$this->view->totalMag = $totalMag;
		
		$projStats = $hostCreditDao->getProjectStats();
		$this->view->projStats = $projStats;
		
		$boincUrlDao = new GrcPool_Boinc_Account_Url_DAO();
		$boincUrls = $boincUrlDao->fetchAll();
		$this->view->boincUrls = $boincUrls;
		
	}
	
}
