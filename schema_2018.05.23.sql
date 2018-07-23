SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `boinc_account` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `auto` tinyint(1) NOT NULL DEFAULT '0',
  `urlId` smallint(5) NOT NULL DEFAULT '0',
  `whiteList` int(1) NOT NULL DEFAULT '0',
  `rac` decimal(22,8) NOT NULL,
  `baseUrl` varchar(100) NOT NULL,
  `teamId` int(8) NOT NULL,
  `attachable` tinyint(1) NOT NULL DEFAULT '0',
  `message` varchar(500) NOT NULL,
  `grcname` varchar(50) NOT NULL,
  `lastSeen` int(11) NOT NULL DEFAULT '0',
  `secure` tinyint(1) DEFAULT '0',
  `minRac` decimal(9,2) NOT NULL DEFAULT '0.00',
  `android` tinyint(1) NOT NULL DEFAULT '0',
  `raspberryPi` tinyint(1) NOT NULL DEFAULT '0',
  `linux` tinyint(1) NOT NULL DEFAULT '0',
  `windows` tinyint(1) NOT NULL DEFAULT '0',
  `virtualBox` tinyint(1) NOT NULL DEFAULT '0',
  `intel` tinyint(1) NOT NULL DEFAULT '0',
  `amd` tinyint(1) NOT NULL DEFAULT '0',
  `nvidia` tinyint(1) NOT NULL DEFAULT '0',
  `mac` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `boinc_account_key` (
  `id` smallint(5) NOT NULL,
  `accountId` smallint(5) NOT NULL,
  `strong` varchar(100) NOT NULL,
  `weak` varchar(100) NOT NULL,
  `attachable` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `boinc_account_url` (
  `id` smallint(5) NOT NULL,
  `accountId` smallint(5) NOT NULL,
  `url` varchar(100) NOT NULL,
  `signature` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `boinc_host_blacklist` (
  `id` int(11) NOT NULL,
  `accountId` mediumint(5) NOT NULL,
  `hostDbid` int(11) NOT NULL,
  `thetime` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `owed` decimal(16,8) NOT NULL DEFAULT '0.00000000',
  `blockMemberId` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `passwordHash` varchar(50) NOT NULL,
  `regTime` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `grcAddress` varchar(50) NOT NULL,
  `donation` decimal(5,2) NOT NULL DEFAULT '0.00',
  `verifyKey` varchar(100) NOT NULL,
  `twoFactor` tinyint(1) NOT NULL DEFAULT '0',
  `twoFactorKey` varchar(40) NOT NULL,
  `apiKey` varchar(32) NOT NULL,
  `apiSecret` varchar(88) NOT NULL,
  `minPayout` smallint(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `member_host` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `cpId` varchar(50) NOT NULL,
  `hostName` varchar(100) NOT NULL,
  `customName` varchar(50) NOT NULL,
  `clientVersion` varchar(50) NOT NULL,
  `model` varchar(200) NOT NULL,
  `osName` varchar(200) NOT NULL,
  `osVersion` varchar(200) NOT NULL,
  `virtualBoxVersion` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `firstContact` int(11) NOT NULL,
  `lastContact` int(11) NOT NULL,
  `numberOfCpus` mediumint(5) NOT NULL DEFAULT '0',
  `numberOfCudas` mediumint(3) NOT NULL DEFAULT '0',
  `numberOfAmds` mediumint(3) NOT NULL DEFAULT '0',
  `numberOfIntels` mediumint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `member_host_credit` (
  `id` int(11) NOT NULL,
  `hostDbid` int(11) NOT NULL,
  `hostCpid` varchar(50) NOT NULL,
  `totalCredit` decimal(22,6) NOT NULL,
  `avgCredit` decimal(22,6) NOT NULL,
  `accountId` smallint(5) NOT NULL DEFAULT '0',
  `lastSeen` int(11) NOT NULL,
  `mag` decimal(9,2) NOT NULL,
  `magTotalCredit` decimal(22,6) NOT NULL,
  `owed` decimal(16,8) NOT NULL DEFAULT '0.00000000',
  `owedCalc` varchar(4000) NOT NULL,
  `memberIdPayout` int(11) NOT NULL DEFAULT '0',
  `memberIdCredit` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `member_host_project` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `hostId` int(11) NOT NULL,
  `hostCpid` varchar(50) NOT NULL,
  `hostDbid` int(11) NOT NULL,
  `accountId` smallint(5) NOT NULL DEFAULT '0',
  `noCpu` int(1) NOT NULL DEFAULT '0',
  `noNvidiaGpu` int(1) NOT NULL DEFAULT '0',
  `noAtiGpu` int(1) NOT NULL DEFAULT '0',
  `noIntelGpu` int(1) NOT NULL DEFAULT '0',
  `resourceShare` int(6) NOT NULL DEFAULT '100',
  `attached` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `member_host_stat_mag` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `hostId` int(11) NOT NULL,
  `accountId` smallint(5) NOT NULL DEFAULT '0',
  `thetime` int(11) NOT NULL,
  `mag` decimal(9,2) NOT NULL,
  `avgCredit` decimal(22,6) NOT NULL DEFAULT '0.000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `member_notice` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `noticeId` int(11) NOT NULL,
  `thetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `member_payout` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `amount` decimal(16,8) NOT NULL,
  `donation` decimal(16,8) NOT NULL DEFAULT '0.00000000',
  `fee` decimal(16,8) NOT NULL DEFAULT '0.00000000',
  `tx` varchar(100) NOT NULL,
  `thetime` int(11) NOT NULL,
  `calculation` varchar(4000) NOT NULL,
  `address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pool_stat` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `value` varchar(100) NOT NULL,
  `theTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `session` (
  `id` int(11) UNSIGNED NOT NULL,
  `userid` int(8) NOT NULL,
  `session` varchar(40) CHARACTER SET latin1 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(100) CHARACTER SET latin1 NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `lastUsed` int(11) NOT NULL DEFAULT '0',
  `remember` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `settings` (
  `id` int(3) NOT NULL,
  `theName` varchar(50) NOT NULL,
  `theValue` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `view_all_orphans` (
`id` int(11)
,`hostDbid` int(11)
,`hostCpid` varchar(50)
,`totalCredit` decimal(22,6)
,`avgCredit` decimal(22,6)
,`accountId` smallint(5)
,`lastSeen` int(11)
,`mag` decimal(9,2)
,`magTotalCredit` decimal(22,6)
,`owed` decimal(16,8)
,`owedCalc` varchar(4000)
,`memberIdPayout` int(11)
,`poolId` smallint(2)
,`memberIdCredit` int(11)
);
CREATE TABLE `view_member_host_project_credit` (
`memberId` int(11)
,`email` varchar(200)
,`username` varchar(25)
,`verified` tinyint(1)
,`grcAddress` varchar(50)
,`donation` decimal(5,2)
,`hostDbid` int(11)
,`accountID` smallint(5)
,`hostId` int(11)
,`creditId` int(11)
,`totalCredit` decimal(22,6)
,`avgCredit` decimal(22,6)
,`mag` decimal(9,2)
,`owed` decimal(16,8)
,`owedCalc` varchar(4000)
,`hostName` varchar(100)
);

CREATE TABLE `wallet_basis` (
  `id` smallint(2) NOT NULL,
  `basis` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `view_all_orphans`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_all_orphans`  AS  select `member_host_credit`.`id` AS `id`,`member_host_credit`.`hostDbid` AS `hostDbid`,`member_host_credit`.`hostCpid` AS `hostCpid`,`member_host_credit`.`totalCredit` AS `totalCredit`,`member_host_credit`.`avgCredit` AS `avgCredit`,`member_host_credit`.`accountId` AS `accountId`,`member_host_credit`.`lastSeen` AS `lastSeen`,`member_host_credit`.`mag` AS `mag`,`member_host_credit`.`magTotalCredit` AS `magTotalCredit`,`member_host_credit`.`owed` AS `owed`,`member_host_credit`.`owedCalc` AS `owedCalc`,`member_host_credit`.`memberIdPayout` AS `memberIdPayout`,`member_host_credit`.`memberIdCredit` AS `memberIdCredit` from `member_host_credit` where ((not((`member_host_credit`.`hostDbid`,`member_host_credit`.`accountId`) in (select `member_host_project`.`hostDbid`,`member_host_project`.`accountId` from `member_host_project`))) and (`member_host_credit`.`owed` > 0)) order by `member_host_credit`.`owed` desc ;
DROP TABLE IF EXISTS `view_member_host_project_credit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_member_host_project_credit`  AS  select `member`.`id` AS `memberId`,`member`.`email` AS `email`,`member`.`username` AS `username`,`member`.`verified` AS `verified`,`member`.`grcAddress` AS `grcAddress`,`member`.`donation` AS `donation`,`member_host_project`.`hostDbid` AS `hostDbid`,`member_host_project`.`accountId` AS `accountID`,`member_host_project`.`hostId` AS `hostId`,`member_host_credit`.`id` AS `creditId`,`member_host_credit`.`totalCredit` AS `totalCredit`,`member_host_credit`.`avgCredit` AS `avgCredit`,`member_host_credit`.`mag` AS `mag`,`member_host_credit`.`owed` AS `owed`,`member_host_credit`.`owedCalc` AS `owedCalc`,`member_host`.`hostName` AS `hostName` from (((`member` join `member_host_project`) join `member_host_credit`) join `member_host`) where ((`member`.`id` = `member_host_project`.`memberId`) and (`member_host_project`.`hostDbid` = `member_host_credit`.`hostDbid`) and (`member_host_project`.`accountId` = `member_host_credit`.`accountId`) and (`member_host`.`id` = `member_host_project`.`hostId`)) ;


ALTER TABLE `boinc_account`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `boinc_account_key`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `boinc_account_url`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `boinc_host_blacklist`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `member_host`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberId` (`memberId`);

ALTER TABLE `member_host_credit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectUrlandHostDbId` (`hostDbid`),
  ADD KEY `mag` (`mag`),
  ADD KEY `memberId` (`memberIdPayout`),
  ADD KEY `memberIdCredit` (`memberIdCredit`),
  ADD KEY `hostDbid` (`hostDbid`);

ALTER TABLE `member_host_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberIdhostDbidprojectUrl` (`memberId`,`hostDbid`),
  ADD KEY `memberId` (`memberId`),
  ADD KEY `hostDbidprojectUrl` (`hostDbid`),
  ADD KEY `poolIdattachedhostIdprojectUrl` (`attached`,`hostId`);

ALTER TABLE `member_host_stat_mag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberId` (`memberId`,`thetime`),
  ADD KEY `hostId` (`hostId`),
  ADD KEY `thetime` (`thetime`);

ALTER TABLE `member_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notcieIdmemberId` (`noticeId`,`memberId`);

ALTER TABLE `member_payout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberId` (`memberId`),
  ADD KEY `thetime` (`thetime`);

ALTER TABLE `pool_stat`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session` (`session`),
  ADD KEY `userid` (`userid`),
  ADD KEY `lastUsed` (`lastUsed`);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `theName` (`theName`);

ALTER TABLE `wallet_basis`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `boinc_account`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
ALTER TABLE `boinc_account_key`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
ALTER TABLE `boinc_account_url`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
ALTER TABLE `boinc_host_blacklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `member_host`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `member_host_credit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `member_host_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `member_host_stat_mag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `member_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `member_payout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `pool_stat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `session`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `settings`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
ALTER TABLE `wallet_basis`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT;
