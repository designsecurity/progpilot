<?php


while ( $row = mysql_fetch_object(true) ) { 
  echo $row->title;
}

