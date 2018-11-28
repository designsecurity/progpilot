#!/bin/bash

composertool=/home/eric/dev/phar-composer.phar
version="dev"
date=`date "+%Y%m%d-%H%M%S"`
newfile="progpilot_${version}${date}"
    
echo "Progpilot builder"
echo "Have you updated the version of progpilot in Console/Application.php file ? (optional)"

if [ -e ${composertool} ] 
then
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
    rm -rf ./vendor/
else

echo ""
echo "Error : ${composertool} doesn't exist"
echo "download the latest release of phar composer tool : https://github.com/clue/phar-composer/releases"
echo "and define the path of the tool in the composertool variable of this script"

fi

