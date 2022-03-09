<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../apiAccess.php';
require './presenter.php';
require './functins_google_api.php';
require './logic.php';
require './router.php';
require 'print.php';
session_start();

$client = createClient();
if(!authenticate($client)) return;
$presenter = new Presenter();
$router = new Router($presenter);
$router->doUserAction();

listAllCalendars($client);
