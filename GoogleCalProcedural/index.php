<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../apiAccess.php';
require './functions_display.php';
require './functins_google_api.php';
require './functions.php';
session_start();

$client = createClient();
if(!authenticate($client)) return;

doUserAction($client);

listAllCalendars($client);
