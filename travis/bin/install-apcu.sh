#!/bin/bash
 
if [ "$TRAVIS_PHP_VERSION" == "5.5" ] || [ "$TRAVIS_PHP_VERSION" == "5.6" ] ; then
    echo -e "yes\nno\n" | pecl -d preferred_state=beta install apcu
    echo "extension=apcu.so" >> `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`
fi