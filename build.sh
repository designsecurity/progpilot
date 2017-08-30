#!/bin/bash

version="dev"
date=`date "+%Y%m%d-%H%M%S"`
newfile="progpilot_${version}${date}"
    
cd ./projects/phar
rm composer.lock
rm -r ./vendor/*
rmdir ./vendor
composer install

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

    php -d phar.readonly=off ./phar-composer.phar build .
    mv ./rogpilot.phar ../../builds/${newfile}.phar
fi



