<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Nichin79\CSV\CSV;

$file = "examples/example.csv";

// Example 1
$importer = new CSV($file, true, true, ";");
// $importer->normalize();
// $importer->parse_header();
// $importer->clean_header();
$data = $importer->get();
print_r($data);


// Example 2
// $importer = new CSV($file, true, false, ";");
// while ($data = $importer->get(2)) {
//   print_r($data);
// }