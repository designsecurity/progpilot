<?php
/*
/* 
Safe sample
input : get the field UserData from the variable $_POST
SANITIZE : uses of ESAPI, an OWASP API
construction : prepared query and no right verification
*/



/*Copyright 2015 Bertrand STIVALET 

Permission is hereby granted, without written agreement or royalty fee, to

use, copy, modify, and distribute this software and its documentation for

any purpose, provided that the above copyright notice and the following

three paragraphs appear in all copies of this software.


IN NO EVENT SHALL AUTHORS BE LIABLE TO ANY PARTY FOR DIRECT,

INDIRECT, SPECIAL, INCIDENTAL, OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE 

USE OF THIS SOFTWARE AND ITS DOCUMENTATION, EVEN IF AUTHORS HAVE

BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.


AUTHORS SPECIFICALLY DISCLAIM ANY WARRANTIES INCLUDING, BUT NOT

LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A

PARTICULAR PURPOSE, AND NON-INFRINGEMENT.


THE SOFTWARE IS PROVIDED ON AN "AS-IS" BASIS AND AUTHORS HAVE NO

OBLIGATION TO PROVIDE MAINTENANCE, SUPPORT, UPDATES, ENHANCEMENTS, OR

MODIFICATIONS.*/


$tainted = $_POST['UserData'];

$ESAPI = new ESAPI();
ESAPI::setEncoder(new DefaultEncoder());
ESAPI::setValidator(new DefaultValidator());
//verifying the data with ESAPI
if($ESAPI->validator->isValidNumber("Course ID", $tainted, 18, 25, false)) {
  $tainted = $tainted;
} else {
  $tainted = 0; //default value
}

$query = "SELECT * FROM COURSE WHERE id=?";

$conn = mysql_connect('localhost', 'mysql_user', 'mysql_password'); //Connection to the database (address, user, password)
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $checked_data);
$stmt->execute();
mysql_close($conn);

 ?>