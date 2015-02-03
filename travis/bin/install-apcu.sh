#!/bin/bash
 
# this script is in a `bin/` folder
 
if [ "$TRAVIS_PHP_VERSION" == "5.3" || $TRAVIS_PHP_VERSION == 'hhvm' ]
then
    exit 0
fi
 
printf "\n"| pecl install apcu
echo "extension=apcu.so" >> `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`