<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<pre>";

echo "php version = " . phpversion() . "\n";
echo "__DIR__ = " . __DIR__ . "\n";

$file = __DIR__ . "/counter.txt";
echo "file path = $file\n";

echo "file_exists? ";
var_dump(file_exists($file));

echo "is_writable(__DIR__)? ";
var_dump(is_writable(__DIR__));

echo "touch result: ";
var_dump(@touch($file));

echo "file_exists_after? ";
var_dump(file_exists($file));

echo "write result: ";
var_dump(@file_put_contents($file, "123"));

echo "read result: ";
var_dump(@file_get_contents($file));

echo "</pre>";