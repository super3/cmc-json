#!/bin/bash

# Get Date
NOW=$(date +%F--%H:%M:%S)
# mik0r note: change the paths below if locations change.
CARC="/var/www/coins-archive/coins-${NOW}.json" 
MARC="/var/www/markets-archive/coins-${NOW}.json"
CJSO="/var/www/coins.json"
MJSO="/var/www/markets.json"

test ! -f "${CARC}" && touch "${CARC}"
test ! -f "${MARC}" && touch "${MARC}"
test ! -f "${CJSO}" && touch "${CJSO}"
test ! -f "${MJSO}" && touch "${MJSO}"

# Cache Data
# mik0r note: change path to php binary & both .php files to suit your env
/usr/bin/php ~/cmc-json/coins.php > "${CJSO}"
/usr/bin/php ~/cmc-json/markets.php > "${MJSO}"

# Archive Data
# mik0r note: change path to php binary & both .php files to suit your env
/usr/bin/php ~/cmc-json/coins.php > "${CARC}"
/usr/bin/php ~/cmc-json/markets.php > "${MARC}"  
