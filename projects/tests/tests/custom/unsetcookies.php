<?php

// some values are null/empty so likely to unset a cookie (no need to secure it)

setcookie("token", "", $options);

setcookie("token", "gfhgfh", $options);

setcookie("token", "", 0, "", "domain", true, true);

setcookie("token", "", 0, "", "domain", false, false);

setcookie("token", "dfgsdfg", 0, "", "domain", false, false);

setcookie("token", " ", 0, "", "domain", false, false);

setcookie("token", null, 0, "", "domain", false, false);
