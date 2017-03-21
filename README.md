# JanusVR Inventory server scripts

## Installation
Requires IPFS running: https://ipfs.io/

```
$ composer require spyduck/janusvr-inventory
$ composer install
```

PHP scripts need to be available at: 
(host prefix)/inventory/add
(host prefix)/inventory/addjson
(host prefix)/inventory/catjson

Example:
```
<Directory /var/www/html>
	Options FollowSymLinks
	AllowOverride All
	RewriteEngine on
	RewriteRule ^inventory/catjson/(.*)$ inventory/php/catjson.php?hash=$1 [L,NC,PT]
	RewriteRule ^inventory/addjson inventory/php/addjson.php [L,NC,PT]
	RewriteRule ^inventory/add inventory/php/add.php [L,NC,PT]
</Directory>```

IPFS port is assumed and can be changed at the top of each .php at:
```
$ipfs = new IPFS("localhost", "8080", "5001");
```
