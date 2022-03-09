<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../apiAccess.php';
require_once './functins_google_api.php';
require_once './functions.php';
session_start();

$client = createClient();
if(!authenticate($client)) return;

doUserAction($client);

listAllCalendars($client);
