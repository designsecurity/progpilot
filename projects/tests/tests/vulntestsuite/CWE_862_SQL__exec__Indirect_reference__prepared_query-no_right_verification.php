<?php
/*
/*
Safe sample
input : use exec to execute the script /tmp/tainted.php and store the output in $tainted
SANITIZE : uses indirect reference
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


$script = "/tmp/tainted.php";
exec($script, $result, $return);

$tainted = $result[0];

$course_array = array();
//get the user id
$user_id = intval($_SESSION[‘user_id’]);

//creation of the references with only data allowed to the user
$result = mysql_query("SELECT * FROM COURSE where course.allowed = {$user_id}");

while ($row = mysql_fetch_array($result)) {
    $course_array[] = $result[‘id’];
}

$_SESSION[‘course_array’] = $course_array;
if (isset($_SESSION[‘course_array’])) {
    $course_array = $_SESSION[‘course_array’];
    if (isset($course_array[$taintedId])) {
        //indirect reference > get the right id
        $tainted = $course_array[$tainted];
    }
} else {
    $tainted = 0; //default value
}

$query = "SELECT * FROM COURSE WHERE id=?";

$conn = mysql_connect('localhost', 'mysql_user', 'mysql_password'); //Connection to the database (address, user, password)
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $checked_data);
$stmt->execute();
mysql_close($conn);
