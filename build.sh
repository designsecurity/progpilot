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

echo "testing ..."
output_runall=""
output_runallfolders=""
output_runexcludefiles=""

output_runall=`cd ../tests; php ./run_all.php`
output_runallfolders=`cd ../tests; php ./run_all_folders.php`
output_runexcludefiles=`cd ../tests; php ./run_exclude_files.php`

if [ "$output_runall" != "" ] || [ "$output_runallfolders" != ""  ] || [ "$output_runexcludefiles" != "" ] 
then
    echo "progpilot tests failed"
    
    echo $output_runall
    echo $output_runallfolders
    echo $output_runexcludefiles
else
    # purge, we keep only the last ten builds
    i=0
    files=$(ls -1cd ../../builds/*)

    for file in "${files}"
    do
        echo $file
        i=$(($i + 1))
        if [ $i -gt 9 ]
        then rm $file
        fi
    done
    
    echo "generating phar"

    php -d phar.readonly=off ${composertool} build .
    mv ./rogpilot.phar ../../builds/${newfile}.phar
fi

rm composer.lock
rm -rd ./vendor/

