<?php
class GrcPool_WebPage {
	public $title;
	public $metaKeywords = Constants::CURRENCY_NAME.', pool, mining, boinc, science, research, cryptocurrency';
	public $metaDescription = 'This is a '.Constants::CURRENCY_NAME.' Research Mining Pool. Join the pool, crunch, and earn '.Constants::CURRENCY_ABBREV.'!';
	public $pageTitle;

	private $head = '';
	private $body = '';
	private $script = '';
	private $secondaryNav = '';
	private $homeBody = '';
	private $isHome = false;
	private $breadcrumbs = array();

	public function setHome($b) {$this->isHome = $b;}
	public function appendHomeBody($str) {$this->homeBody .= $str;}
	public function setSecondaryNav($str) {$this->secondaryNav=$str;}
	public function getBody() {return $this->body;}
	public function setBody($str) {$this->body = $str;}
	public function append($str) {$this->body .= $str;}
	public function appendHead($str) {$this->head .= $str;}
	public function appendScript($str) {$this->script .= $str;}
	public function appendTitle($str) {$this->title .= ' &bull; '.$str;}
	public function renderSecondaryNav() {
		if ($this->secondaryNav) {
			return '<div style="margin-top:20px;margin-bottom:30px;">'.$this->secondaryNav.'</div>';
		}
	}
	public function setPageTitle($str) {
		$this->pageTitle = $str;
	}
	public function addBreadcrumb($title,$icon = '',$href='') {
		array_push($this->breadcrumbs,array('title'=>$title,'link'=>$href,'icon'=>$icon));
	}
	private function renderPageTitle() {
		return $this->pageTitle?'<div class="page-header rowpad" style="margin-top:10px;"><h1>'.$this->pageTitle.'</h1></div>':'';
	}
	private function renderBreadcrumb() {
		$result = '';
		if ($this->breadcrumbs) {
			$result .= '<ol class="rounded breadcrumb hidden-xs" style="margin-bottom:20px;">';
			$result .= '<li><a href="/"><i class="fa fa-home"></i> Home</a></li>';
			foreach ($this->breadcrumbs as $idx => $crumb) {
				$result .= '<li style="'.($crumb['link']!=""?'':'color:gray;').'" class="'.($idx+1 == count($this->breadcrumbs)?'':'').'">'.($crumb['link']!=""?'<a href="'.$crumb['link'].'">':'').''.($crumb['icon']!=""?'<i class="fa fa-'.$crumb['icon'].'"></i> ':'').$crumb['title'].''.($crumb['link']!=""?'</a>':'').'</li>';
			}
			$result .= '</ol>';
		}
		return $result;
	}
	private function getUserBar() {
		global $USER;
		$cache = new Cache();
		$dao = new GrcPool_View_Member_Host_Project_Credit_DAO();
		$owed = '';
		if ($USER->getId() != 0) {
			$owed = $dao->getOwedForMember($USER->getId());
		}
		return '
			<div class="container" style="padding-top:20px;">
				<div class="pull-right rowpadsmall">
					'.($USER->getId() == 0?'
						<a href="/login"><i class="fa fa-power-off"></i> login</a>
						&nbsp;|&nbsp;
						<a href="/signup"><i class="fa fa-edit"></i> sign up</a>
					':'
						<a href="/logout"><i class="fa fa-power-off"></i> logout</a>
						&nbsp;|&nbsp;
						<a href="/account">
						'.($USER->hasAlerts()?'
							<i class="fa fa-warning text-danger"></i>
						':'
							<i class="fa fa-user"></i>
						').'
 						'.($USER->getUsername()).'</a>
						|
						Owed: <a href="/account/payouts">'.number_format($owed,3,'.','').'</a>
					').'
				</div>
			</div>
		';
	}

	private function getBanner() {
		$settingsDao = new GrcPool_Settings_DAO();
		$message = $settingsDao->getValueWithName(Constants::SETTINGS_GRC_MESSAGE);
		$return = '';
		if ($message != '') {
			$return .= '<div style="padding:11px;color:white;font-weight:bold;background-color:#333;text-align:center;">'.$message.'</div>';
		}
		return $return;
	}
	
	public function display() {
		echo '<!DOCTYPE html>
 		<html>
 			<head>
 				<title>'.Constants::CURRENCY_NAME.' Pool '.$this->title.'</title>
 				<meta name="keywords" content="'.htmlspecialchars($this->metaKeywords).'"/>
 				<meta name="description" content="'.htmlspecialchars($this->metaDescription).'"/>
 				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<link rel="icon" href="/favicon.ico?20170214" type="image/x-icon"> 
				<link rel="stylesheet" href="/assets/libs/bootstrap/3.3.5/css/bootstrap.min.css"/>
				<link rel="stylesheet" href="/assets/libs/fontAwesome/4.6.3/css/font-awesome.min.css"/>
				<link rel="stylesheet" href="/assets/css/pool.css?20170714"/>	
				<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
				<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
				<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
				<link rel="manifest" href="/manifest.json">
				<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
				<meta name="theme-color" content="#ffffff">
				<link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
				<meta name="msapplication-TileImage" content="/ms-icon-144x144.png?20170214">
				<meta property="og:description" content="This is a mining pool for the cryptocurrency '.Constants::CURRENCY_NAME.'."/>
				<meta property="og:title" content="'.Constants::BOINC_POOL_NAME.'"/>
				<meta property="og:url" content="https://'.Constants::POOL_DOMAIN.'"/>
				<meta property="og:site_name" content="'.Constants::BOINC_POOL_NAME.'"/>
				<meta property="og:type" content="website"/>
				<meta property="og:image" content="https://www.'.strtolower(Constants::CURRENCY_ABBREV).'pool.com/assets/images/'.strtolower(Constants::CURRENCY_ABBREV).'pool.png"/>
 				'.$this->head.'
				<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
 			</head>
 			<body>
				'.($this->getBanner()).'
				'.($this->isHome?'<div style="background-repeat:no-repeat;background-image:url(/assets/images/pool.jpg)">':'').'
	 				'.$this->getUserBar().'
		 			<div class="container" style="margin-bottom:20px;">
						<nav class="navbar navbar-inverse" style="margin-bottom:10px;">
			  				<div class="container-fluid">
			    				<div class="navbar-header">
			     						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			       						<span class="sr-only">Toggle navigation</span>
			        					<span class="icon-bar"></span>
			       						<span class="icon-bar"></span>
			       						<span class="icon-bar"></span>
			     						</button>
			     						<a class="navbar-brand" href="/">
	 										<span style="color:white;">'.strtolower(Constants::CURRENCY_ABBREV).'pool</span></span>
	 									</a>
			   					</div>
			   					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			     						<ul class="nav navbar-nav">
		 								<li class="dropdown '.(strstr($_SERVER['REQUEST_URI'],'/about')?'active':'').'">
			          						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
			          						<ul class="dropdown-menu">
			            						<li><a href="/about/fees">Fees and Donations</a></li>
		 										<li><a href="/about/calculations">Calculations</a></li>
		 										<li><a href="/about/hotWallet">Pool Staking Wallet</a></li>
			         							</ul>
								        </li>
		 								<li class=""><a href="/report">Reports</a></li>
		 								<li class="dropdown '.(strstr($_SERVER['REQUEST_URI'],'/project')?'active':'').'">
			          						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects <span class="caret"></span></a>
			          						<ul class="dropdown-menu">
			            						<li><a href="/project/choose">Choosing a Project</a></li>
		 										<li><a href="/project/poolStats">Pool Status</a></li>
		         							</ul>
								        </li>		 								
		 										
		        						<li class=""><a href="/payout">Payouts</a></li>
		 								<li class="dropdown '.(strstr($_SERVER['REQUEST_URI'],'/help')?'active':'').'">
			          						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Help <span class="caret"></span></a>
			          						<ul class="dropdown-menu">
												<li><a href="/help/calculators">Calculators</a></li>
			            						<li><a href="/help/chooseProject">Choosing a Project</a></li>
		 										<li><a href="/help/android">Pool on Android</a></li>
		         							</ul>
								        </li>		 								
			      					</ul>
			    				</div>
			  				</div>
						</nav>
		 			</div>
	 				<div class="container">
						'.$this->renderBreadcrumb().'
	 					'.$this->renderSecondaryNav().'
	 					'.$this->renderPageTitle().'
	 					'.($this->isHome?$this->homeBody:$this->body).'
	 					<br/><br/>
	 				</div>
	 			'.($this->isHome?'</div>':'').'
	 			<div class="container">
					'.($this->isHome?$this->body:'').'
 					<hr/>
 					<div class="pull-right" style="margin-left:50px;"><a href="mailto:admin@'.strtolower(Constants::CURRENCY_ABBREV).'pool.com">admin@'.strtolower(Constants::CURRENCY_ABBREV).'pool.com</a></div>
 					<span style="white-space: nowrap;"><a href="http://www.gridcoin.us/">Gridcoin Website</a> |</span>
 					<span style="white-space: nowrap;"><a href="http://www.gridresearchcorp.com/gridcoin/">Gridcoin Block Explorer</a> |</span>
 					<span style="white-space: nowrap;"><a href="https://kiwiirc.com/client/irc.freenode.net:6667/#gridcoin-help">Gridcoin Help Chat</a> |</span>
 					<span style="white-space: nowrap;"><a href="http://cryptocointalk.com/topic/1331-new-coin-launch-announcement-grc-gridcoin/?view=getnewpost">Gridcoin Forum</a></span>
 					<br/><br/><br/><br/><br/><br/><br/><br/>
 				</div>
	 	
 				<script src="/assets/libs/jQuery/jquery-1.11.3.min.js" type="text/javascript"></script>
				<script type="text/javascript" src="/assets/libs/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 				'.$this->script.'
				<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
				<script>
				window.addEventListener("load", function(){
				window.cookieconsent.initialise({
				  "palette": {
				    "popup": {
				      "background": "#252e39"
				    },
				    "button": {
				      "background": "#14a7d0"
				    }
				  },
				  "theme": "edgeless"
				})});
				</script>

			</body>
 		</html>';
	}
}
