<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once(dirname(__FILE__).'/../../bootstrap.php');

$hostDao = new GrcPool_Member_Host_Credit_DAO();

$sql = '
  	insert into '.Constants::DATABASE_NAME.'.member_host_stat_mag (memberId,hostId,accountId,thetime,mag,avgCredit) 
  	select memberId,hostDbid,accountId,UNIX_TIMESTAMP(NOW()),mag,avgCredit
  	from '.Constants::DATABASE_NAME.'.view_member_host_project_credit 
  	where avgCredit > 0 or mag > 0
';
$hostDao->executeQuery($sql);

$sql = '
	insert into '.Constants::DATABASE_NAME.'.pool_stat (name,value,theTime) 
	select \'ACTIVE_MEMBERS\',count(distinct memberId) as howmany,UNIX_TIMESTAMP(NOW()) FROM `view_member_host_project_credit` where avgCredit > 0
';
$hostDao->executeQuery($sql);

foreach (array('totalCredit','avgCredit','mag','owed') as $column) {
	$sql = '
		insert into '.Constants::DATABASE_NAME.'.pool_stat (name,value,theTime) 
		select \''.strtoupper($column).'\',sum('.$column.'),UNIX_TIMESTAMP(NOW())
		from '.Constants::DATABASE_NAME.'.member_host_credit
	';
	$hostDao->executeQuery($sql);
}