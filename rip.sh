#!/usr/local/bin/php

# Get Date
NOW=$(date +%F--%H:%M:%S)

# Cache Data
php coins.php > /var/www/coins.json
php markets.php > /var/www/markets.json

# Archive Data
php coins.php > /var/www/coins-archive/coins-$NOW.json
php markets.php > /var/www/markets-archive/coins-$NOW.json
