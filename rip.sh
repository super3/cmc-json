#!/bin/bash

# Fix Memory Issues
export USE_ZEND_ALLOC=0
# Get Date
NOW=$(date +%F--%H:%M:%S)
#subdir that includes year and month only
SUBDIR=$(date +%Y-%m)
# mik0r note: change the paths below if locations change.
CARC="/var/www/cmc/coins-archive/${SUBDIR}/coins-${NOW}.json" 
MARC="/var/www/cmc/markets-archive/${SUBDIR}/markets-${NOW}.json"
CJSO="/var/www/cmc/coins.json"
MJSO="/var/www/cmc/markets.json"

# create directory
mkdir -p /var/www/cmc/coins-archive/${SUBDIR}
mkdir -p /var/www/cmc/markets-archive/${SUBDIR}

test ! -f "${CARC}" && touch "${CARC}"
test ! -f "${MARC}" && touch "${MARC}"
test ! -f "${CJSO}" && touch "${CJSO}"
test ! -f "${MJSO}" && touch "${MJSO}"

# Cache Data
# mik0r note: change path to php binary & both .php files to suit your env
/usr/bin/php /root/cmc-json/coins.php > "${CJSO}"
/usr/bin/php /root/cmc-json/markets.php > "${MJSO}"

# Archive Data
# mik0r note: change path to php binary & both .php files to suit your env
/usr/bin/php /root/cmc-json/coins.php > "${CARC}"
/usr/bin/php /root/cmc-json/markets.php > "${MARC}"  

#grab a copy of coinmarketcap and store it in the subdir
wget -O - http://coinmarketcap.com/ > /var/www/cmc/coins-archive/${SUBDIR}/coins-${NOW}.html
wget -O - http://coinmarketcap.com/volume.html > /var/www/cmc/markets-archive/${SUBDIR}/markets-${NOW}.html
