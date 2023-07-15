<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Nichin79\CSV\CSV;

$file = "examples/example.csv";

// Example 1
$importer = new CSV($file, true, ";");
$importer->normalize();
$data = $importer->get();
print_r($data);


// Example 2
// $importer = new CSV($file, true, ";");
// while ($data = $importer->get(2)) {
//   print_r($data);
// }