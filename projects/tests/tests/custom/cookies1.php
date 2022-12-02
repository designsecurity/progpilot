<?php

if ($pSecurityLevel == 'impossible') {
    $httponly = true;
} else {
    $httponly = false;
}
setcookie(session_name(), session_id(), null, '/', null, null, $httponly);
setcookie('security', $pSecurityLevel, null, null, null, null, $httponly);
