#!/bin/bash

cd /home/robsohn/public_html/

timestamp=$(date +%Y%m%d%H%M%S)

mkdir raszczynski.com-"$timestamp"

cd raszczynski.com-"$timestamp"

test -f bin/composer.phar || ( wget https://getcomposer.org/composer.phar -O bin/composer.phar && chmod +x bin/composer.phar )
bin/composer.phar install

cd ..
rm raszczynski.com
ln -s raszczynski.com-"$timestamp" raszczynski.com