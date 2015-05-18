<?php

require_once __DIR__.'/../vendor/autoload.php';

$timer = new \DebugHelper\Stopwatch('migration');
$timer->startWithMessage('Running migrations and seeds');

sleep(1);

$timer->stopAndPrintResult('Migrating and seeding done');
