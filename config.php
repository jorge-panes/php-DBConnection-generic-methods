<?php

// DB
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'pafj');
define('DB_PREFIX', 'pafj_');

define('HTTP_SERVER', 'http://localhost:8888/');


define('DIR_APPLICATION', str_replace('\'', '/', realpath(dirname(__FILE__))) . '/');
define('DIR_SYSTEM', DIR_APPLICATION . 'system/');
define('DIR_DATABASE', DIR_SYSTEM . 'database/');
define('DIR_CSS', HTTP_SERVER . 'view/css/');
define('DIR_JS', HTTP_SERVER . 'view/js/');

?>
