<?php declare(strict_types = 1);
// ok
printf(htmlentities($_GET['a'], ENT_QUOTES));
// tainted
printf($_GET['a']);
