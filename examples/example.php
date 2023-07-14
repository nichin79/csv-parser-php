<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Nichin79\CSV\CSV;


// Example 1
$importer = new CSV("examples/example.csv", true, ";");
$data = $importer->get();
print_r($data);


// Example 2
$importer = new CSV("examples/example.csv", true, ";");
while ($data = $importer->get(2)) {
  print_r($data);
}