#!/usr/bin/env bash

# Check if phar-composer.phar is in the $PATH
if ! [ -x "$(command -v phar-composer.phar)" ]; then
    echo "Error: phar-composer.phar command could not be found!"
    echo "Make sure to download the latest release of phar composer tool: https://github.com/clue/phar-composer/releases"
    echo "Make it executable and add it in a folder in your PATH"
    exit 1
fi

version="dev"
date=$(date "+%Y%m%d-%H%M%S")
newfile="progpilot_${version}${date}"

echo "Progpilot builder"
echo "Did you update the version of progpilot in Console/Application.php file? (optional)"

mkdir -p ./builds

cd ./projects/phar || exit 1

# Cleanup
rm -f composer.lock
rm -rf ./vendor/
rm -rf ../../builds/*

composer install
rm -rf ./vendor/progpilot/
mkdir -p ./vendor/progpilot/package
cp -R ../../package/* ./vendor/progpilot/package

echo "Generating phar..."
php -d phar.readonly=off "$(command -v phar-composer.phar)" build .
chmod -v +x ./build.phar
mv -v ./build.phar ../../builds/"${newfile}".phar
