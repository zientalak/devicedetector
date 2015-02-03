#!/bin/bash
 
if [ "$TRAVIS_PHP_VERSION" == "5.5" ] || [ "$TRAVIS_PHP_VERSION" == "5.6" ] ; then
then
    printf "\n"| pecl install apcu
    echo "extension=apcu.so" >> `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`
fi