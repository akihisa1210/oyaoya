<?php
require_once('./vendor/autoload.php');
require_once('./tests/ProcessorTest.php');

$result = class_exists('ProcessorTest');
var_dump($result);
