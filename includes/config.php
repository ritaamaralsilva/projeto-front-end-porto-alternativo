<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
define('BASE_URL', '/projeto-front-end-porto-alternativo');
