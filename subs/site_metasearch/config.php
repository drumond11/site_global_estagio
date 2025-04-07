<?php

// Caminho raiz
define('ABSPATH', dirname(__FILE__));


// Nome do host da base de dados
define('HOSTNAME', 'localhost');

// Nome do DB
define('DB_NAME', 'real_estate_properties');

// User do DB
define('DB_USER', 'root');

// Palavra-passe do DB
define('DB_PASSWORD', '');
/*
// Nome do host da base de dados
define('HOSTNAME', 'sql101.infinityfree.com');
// Nome do DB
define('DB_NAME', 'if0_37750478_real_estate_properties');
// User do DB
define('DB_USER', 'if0_37750478');
// Palavra-passe do DB
define('DB_PASSWORD', 'yolxOBPLazyQ');
*/
// Charset da conexão PDO
define('DB_CHARSET', 'utf-8');

//phpmailer
defined('E_ADMIN')             OR define('E_ADMIN','d31sales@gmail.com');
defined('N_ADMIN')             OR define('N_ADMIN','Joao Drumond');
defined('P_ADMIN')             OR define('P_ADMIN','bxxalsmcniebolom');
defined('D_EMAIL_RECEIVER')      OR define('D_EMAIL_RECEIVER','drumond11@gmail.com');//drumond11@gmail.com

//Captcha
defined('D_CAPTCHA_PRIVATE_KEY') OR define('D_CAPTCHA_PRIVATE_KEY','6LeSBHwpAAAAAOisKm_XCLUMIZ5MQalZlXA-IRp-');
defined('D_CAPTCHA_PUBLIC_KEY')  OR define('D_CAPTCHA_PUBLIC_KEY','6LeSBHwpAAAAAFLacq0p04X32UBSdagcmjmPvwnm');
?>