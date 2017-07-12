<?php
// directory separator alias
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/**
 * Basic defines for timing functions.
 * from cakephp/cakephp/src/basics.php
 */
if (!defined('SECOND')) {
    define('SECOND', 1);
}

if (!defined('MINUTE')) {
    define('MINUTE', 60);
}

if (!defined('HOUR')) {
    define('HOUR', 3600);
}

if (!defined('DAY')) {
    define('DAY', 86400);
}

if (!defined('WEEK')) {
    define('WEEK', 604800);
}

if (!defined('MONTH')) {
    define('MONTH', 2592000);
}

if (!defined('YEAR')) {
    define('YEAR', 31536000);
}
