<?php
namespace Nichin79\CSV;

class CSV
{
  private $file;
  private $fp;
  private $parse_header;
  private $header;
  private $delimiter;
  private $length;

  public function __construct($file, $parse_header = false, $delimiter = ",", $length = 8000)
  {
    if (!is_file($file)) {
      throw new \Exception("Unable to locate $file");
    } else {
      $this->file = $file;
    }

    $this->fp = fopen($file, "r");
    $this->parse_header = $parse_header;
    $this->delimiter = $delimiter;
    $this->length = $length;
  }

  function __destruct()
  {
    if ($this->fp) {
      fclose($this->fp);
    }
  }

  function get($max_lines = 0)
  {
    if ($this->parse_header) {
      $this->header = fgetcsv($this->fp, $this->length, $this->delimiter);
    }

    //if $max_lines is set to 0, then get all the data
    $data = array();

    if ($max_lines > 0)
      $line_count = 0;
    else
      $line_count = -1; // so loop limit is ignored

    while ($line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) {
      if ($this->parse_header) {
        foreach ($this->header as $i => $heading_i) {
          $row_new[$heading_i] = $row[$i];
        }
        $data[] = $row_new;
      } else {
        $data[] = $row;
      }

      if ($max_lines > 0)
        $line_count++;
    }
    return $data;
  }

  function normalize()
  {
    $s = file_get_contents($this->file);

    // Convert all line-endings to UNIX format.
    $s = str_replace(array("\r\n", "\r", "\n"), "\n", $s);

    // Don't allow out-of-control blank lines.
    $s = preg_replace("/\n{3,}/", "\n\n", $s);
    file_put_contents($this->file, $s);
  }
}