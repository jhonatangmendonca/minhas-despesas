<?php

require_once 'init.php';
if (!isLoggedIn()) {
    header('Location: ./Login/login.php');
}
