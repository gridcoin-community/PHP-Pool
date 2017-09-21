# PHP-Pool

This project is intended to create a Gridcoin mining pool. This codebase is represented by https://open.grcpool.com and is the backbone of https://www.grcpool.com sites.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Software Prerequisites

PHP 7
MySQL Database
Gridcoin Daemon
NPM
Composer

### Initialization Commands

PHP-Pool/composer install

### Property Configuration

props.json
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

### Constants.php Configuration

```
TODO
```

### Database Data Congifuguration

```
TODO
```

## Running the tests

There are a few unit tests which can be run for critical functions. They can be executed via grunt and phpunit.

```
Target specific test file: grunt watch --target=RpcTest.php
Run All: grunt watch
```

## Scheduled Tasks

Scheduled tasks are located in /tasks and subdirectories. They can be executed for example:

```
for entry in /var/www/www.grcpool.com/tasks/_daily/*
	do
		php "$entry"
	done
```

## Sampple Apache Config

```
<VirtualHost *:8080>
    ServerName open.grcpool.com
    ServerAlias open.grcpool.com
    DocumentRoot /var/www/PHP-Pool/public
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
