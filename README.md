# PHP-Pool
Simple bare bones PHP pool.

Dependencies
	Composer
	npm
	php 7
	mysql
	Gridcoin Daemon

Installation:
	PHP-Pool/composer install
	props.json
	Constants.php
	PHP-Pool/node/npm install

Data Setup
	wallet basis
	



Automated Unit Tests

Target specific file: grunt watch --target=RpcTest.php
Run All: grunt watch


Task Setup:
	Example in /etc/cron.daily
	for entry in /var/www/www.grcpool.com/tasks/_daily/*
	do
	        echo $entry
	        echo "`date +%Y.%m.%d.%H.%M.%S` ##################### START" >> /var/log/grcpool/${entry##*/}.log
	        {
	                php "$entry"
	                echo $'\r'
	        } >> /var/log/grcpool/${entry##*/}.log
	        echo "`date +%Y.%m.%d.%H.%M.%S` ##################### END" >> /var/log/grcpool/${entry##*/}.log
	done

	
Example Apache Config
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
