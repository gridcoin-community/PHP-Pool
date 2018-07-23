# PHP-Pool

This open source project is intended to provide Gridcoin with a mining pool. This codebase is represented by https://open.grcpool.com and is the backbone of https://www.grcpool.com sites which have more functoinality and are available on another repo.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Assumptions &amp; Prerequisites

- PHP 7
- MySQL
- Gridcoin Daemon
- Composer
- BOINC Accounts

### Composer Initialization

PHP-Pool/composer install

### Constants File

There are several values in the classes/core/Constants.php file which will need your attention. For example:

- DATABASE_NAME => what your db name is
- DATABASE_SERVER => ip of your db
- BOINC_XML_LOG_DIR => where you want to store BOINC RPC logs
- BOINC_POOL_NAME => what you are calling your pool
- POOL_DOMAIN => domain name of your pool
- CURRENCY_ABBREV => currency abbreviation in case you are making this for another coin
- CURRENCY_NAME => currency name in case you are making this for another coin
- ADMIN_EMAIL_ADDRESS => your contact email address
- URL_SIGNING_KEY => you should sign your project urls with your own key please - this is public knowledge which is why it is in Constants and not Properties
- PROPERTY_FILE - where you want to store your property file

 

### Property Configuration

You will need to customize this file to suit your needs. Here are some sample fields...

```
{
	"databaseName" : "",
	"databaseServer" : "",
	"databaseUser" : "",
	"databasePassword" : "",
	"emailServer" : "",
	"emailPort" : "",
	"emailSslPort" : "",
	"emailUsername" : "",
	"emailPassword" : "",
	"googleCaptchaPublic" : "",
	"googleCaptchaPrivate" : "",
	"cacheDir" : "",
	"daemon" : {
		"path" : "/usr/bin/gridcoinresearchd",
		"datadir" : "/home/bgb/.GridcoinResearch",
		"testnet" : false
	}
}
```

### Database Data Congifuguration

The database schema is available at the root of the project. There are some settings which need to be customized in the "settings" table:

- TOTAL_PAID_OUT = 0
- CPID = ?? => pool's CPID
- MIN_OWE_AMOUNT = 1
- PAYOUT_FEE = .005
- MIN_ORPHAN_PAYOUT_ZERO_MAG = 1
- MIN_ORPHAN_PAYOUT_WITH_MAG = 5
- SEED = ?? => you should se this to how much GRC you start with staking
- GRC_CLIENT_ONLINE = 1 => set to zero if doing maintenance
- GRC_CLIENT_MESSAGE = '' => change to put banner on pages
- MIN_STAKE_BALANCE = 5 => amount needed to process owed
- HOT_WALLET_ADDRESS = ??
- POOL_WHITELIST_COUNT = ?? => tasks update this automatically

## Running the tests

There are a few unit tests which can be run for critical functions. They can be executed via grunt and phpunit.

```
Target specific test file: grunt watch --target=RpcTest.php
Run All: grunt watch
```

## Scheduled Tasks

Scheduled tasks are located in /tasks and subdirectories in their suggested intervals. They can be executed from a cron job for example:

```
for entry in /var/www/www.grcpool.com/tasks/_daily/*
	do
		php "$entry"
	done
```

## Sample Apache Config

```
<VirtualHost *:8080>
    ServerName open.grcpool.com
    ServerAlias open.grcpool.com
    DocumentRoot /var/www/PHP-Pool/public
    Alias /assets /var/www/PHP-Pool/assets
    ErrorLog "/var/log/apache2/open.grcpool.com.error.log"
    CustomLog "var/log/apache2/open.grcpool.com.log" common
    RewriteEngine off
    <Location />
        RewriteEngine On
	    RewriteCond %{REQUEST_FILENAME} -s [OR]
	    RewriteCond %{REQUEST_FILENAME} -l [OR]
	    RewriteCond %{REQUEST_FILENAME} -d
	    RewriteRule ^.*$ - [NC,L]
	    RewriteRule ^.*$ /index.php [NC,L]
 </Location>
</VirtualHost>
```

## BOINC Accounts

You will need to secure BOINC accounts for the projects you want to have in the pool. You will need to manually populate the boinc_account, boinc_account_key, and boinc_account_url tables with the data you use and get from the individual project sites.

After you create your BOINC accounts, you should connect them from your personal BOINC client using the strong key or your account + password. CPID splits might occur if you only attach projects with your weak keys.

