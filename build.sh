#!/bin/bash

composertool=/home/eric/dev/phar-composer.phar
version="dev"
date=`date "+%Y%m%d-%H%M%S"`
newfile="progpilot_${version}${date}"
    
cd ./projects/phar
rm composer.lock
rm -rf ./vendor/
composer install

rm -rf ./vendor/progpilot/
mkdir ./vendor/progpilot/
mkdir ./vendor/progpilot/package
cp -R ../../package/* ./vendor/progpilot/package

rm -rf ../../builds/*
    
echo "generating phar"

php -d phar.readonly=off ${composertool} build .
mv ./rogpilot.phar ../../builds/${newfile}.phar

rm composer.lock
rm -rd ./vendor/
