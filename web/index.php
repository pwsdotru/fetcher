<?php

require_once(dirname(__DIR__) . '/vendor/autoload.php');
$framework = new Fetcher\Framework();
$framework->registerDebugHandlers();
$framework->processHttpSapiRequest();