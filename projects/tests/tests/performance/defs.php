<?php

function dvwaHtmlEcho($pPage)
{
    $menuBlocks = array();

    $menuBlocks[ 'home' ] = array();
    if (dvwaIsLoggedIn()) {
        $menuBlocks[ 'home' ][] = array( 'id' => 'home', 'name' => 'Home', 'url' => '.' );
        $menuBlocks[ 'home' ][] = array( 'id' => 'instructions', 'name' => 'Instructions', 'url' => 'instructions.php' );
        $menuBlocks[ 'home' ][] = array( 'id' => 'setup', 'name' => 'Setup / Reset DB', 'url' => 'setup.php' );
    } else {
        $menuBlocks[ 'home' ][] = array( 'id' => 'setup', 'name' => 'Setup DVWA', 'url' => 'setup.php' );
        $menuBlocks[ 'home' ][] = array( 'id' => 'instructions', 'name' => 'Instructions', 'url' => 'instructions.php' );
    }

    if (dvwaIsLoggedIn()) {
        $menuBlocks[ 'vulnerabilities' ] = array();
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'brute', 'name' => 'Brute Force', 'url' => 'vulnerabilities/brute/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'exec', 'name' => 'Command Injection', 'url' => 'vulnerabilities/exec/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'csrf', 'name' => 'CSRF', 'url' => 'vulnerabilities/csrf/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'fi', 'name' => 'File Inclusion', 'url' => 'vulnerabilities/fi/.?page=include.php' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'upload', 'name' => 'File Upload', 'url' => 'vulnerabilities/upload/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'captcha', 'name' => 'Insecure CAPTCHA', 'url' => 'vulnerabilities/captcha/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'sqli', 'name' => 'SQL Injection', 'url' => 'vulnerabilities/sqli/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'sqli_blind', 'name' => 'SQL Injection (Blind)', 'url' => 'vulnerabilities/sqli_blind/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'weak_id', 'name' => 'Weak Session IDs', 'url' => 'vulnerabilities/weak_id/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'xss_d', 'name' => 'XSS (DOM)', 'url' => 'vulnerabilities/xss_d/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'xss_r', 'name' => 'XSS (Reflected)', 'url' => 'vulnerabilities/xss_r/' );
        $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'xss_s', 'name' => 'XSS (Stored)', 'url' => 'vulnerabilities/xss_s/' );
    }

    $menuBlocks[ 'meta' ] = array();
    if (dvwaIsLoggedIn()) {
        $menuBlocks[ 'meta' ][] = array( 'id' => 'security', 'name' => 'DVWA Security', 'url' => 'security.php' );
        $menuBlocks[ 'meta' ][] = array( 'id' => 'phpinfo', 'name' => 'PHP Info', 'url' => 'phpinfo.php' );
    }
    $menuBlocks[ 'meta' ][] = array( 'id' => 'about', 'name' => 'About', 'url' => 'about.php' );

    if (dvwaIsLoggedIn()) {
        $menuBlocks[ 'logout' ] = array();
        $menuBlocks[ 'logout' ][] = array( 'id' => 'logout', 'name' => 'Logout', 'url' => 'logout.php' );
    }

    $menuHtml = '';

    foreach ($menuBlocks as $menuBlock) {
        $menuBlockHtml = '';
        foreach ($menuBlock as $menuItem) {
            $selectedClass = ($menuItem[ 'id' ] == $pPage[ 'page_id' ]) ? 'selected' : '';
            $fixedUrl = DVWA_WEB_PAGE_TO_ROOT.$menuItem[ 'url' ];
            $menuBlockHtml .= "<li onclick=\"window.location='{$fixedUrl}'\" class=\"{$selectedClass}\"><a href=\"{$fixedUrl}\">{$menuItem[ 'name' ]}</a></li>\n";
        }
        $menuHtml .= "<ul class=\"menuBlocks\">{$menuBlockHtml}</ul>";
    }

    // Get security cookie --
    $securityLevelHtml = '';
    switch (dvwaSecurityLevelGet()) {
        case 'low':
            $securityLevelHtml = 'low';
            break;
        case 'medium':
            $securityLevelHtml = 'medium';
            break;
        case 'high':
            $securityLevelHtml = 'high';
            break;
        default:
            $securityLevelHtml = 'impossible';
            break;
    }
    // -- END (security cookie)

    $phpIdsHtml   = '<em>PHPIDS:</em> ' . (dvwaPhpIdsIsEnabled() ? 'enabled' : 'disabled');
    $userInfoHtml = '<em>Username:</em> ' . (dvwaCurrentUser());

    $messagesHtml = messagesPopAllToHtml();
    if ($messagesHtml) {
        $messagesHtml = "<div class=\"body_padded\">{$messagesHtml}</div>";
    }

    $systemInfoHtml = "";
    if (dvwaIsLoggedIn()) {
        $systemInfoHtml = "<div align=\"left\">{$userInfoHtml}<br /><em>Security Level:</em> {$securityLevelHtml}<br />{$phpIdsHtml}</div>";
    }
    if ($pPage[ 'source_button' ]) {
        $systemInfoHtml = dvwaButtonSourceHtmlGet($pPage[ 'source_button' ]) . " $systemInfoHtml";
    }
    if ($pPage[ 'help_button' ]) {
        $systemInfoHtml = dvwaButtonHelpHtmlGet($pPage[ 'help_button' ]) . " $systemInfoHtml";
    }

    // Send Headers + main HTML code
    Header('Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
    Header('Content-Type: text/html;charset=utf-8');     // TODO- proper XHTML headers...
    Header('Expires: Tue, 23 Jun 2009 12:00:00 GMT');    // Date in the past

    echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage[ 'title' ]}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . DVWA_WEB_PAGE_TO_ROOT . "dvwa/css/main.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"" . DVWA_WEB_PAGE_TO_ROOT . "favicon.ico\" />

		<script type=\"text/javascript\" src=\"" . DVWA_WEB_PAGE_TO_ROOT . "dvwa/js/dvwaPage.js\"></script>

	</head>

	<body class=\"home\">
		<div id=\"container\">

			<div id=\"header\">

				<img src=\"" . DVWA_WEB_PAGE_TO_ROOT . "dvwa/images/logo.png\" alt=\"Damn Vulnerable Web Application\" />

			</div>

			<div id=\"main_menu\">

				<div id=\"main_menu_padded\">
				{$menuHtml}
				</div>

			</div>

			<div id=\"main_body\">

				{$pPage[ 'body' ]}
				<br /><br />
				{$messagesHtml}

			</div>

			<div class=\"clear\">
			</div>

			<div id=\"system_info\">
				{$systemInfoHtml}
			</div>

			<div id=\"footer\">

				<p>Damn Vulnerable Web Application (DVWA) v" . dvwaVersionGet() . "</p>

			</div>

		</div>

	</body>

</html>";
}
 
