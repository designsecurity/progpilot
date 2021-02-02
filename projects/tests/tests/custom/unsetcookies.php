<?php

// some values are null/empty so likely to unset a cookie (no need to secure it)
setcookie("token", "", $token);

setcookie("token", "gfhgfh", $token);

setcookie("token", "", 0, "", "domain", true, true);

setcookie("token", "", 0, "", "domain", false, false);

setcookie("token", "dfgsdfg", 0, "", "domain", false, false);
