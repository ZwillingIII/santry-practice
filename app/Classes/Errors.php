<?php
namespace App\Classes;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Errors {
  function __construct() {
    // echo "Hello";
    echo $this->getDate();
  }
  
  private function getDate() {
    return date('d-m-Y');
  }

  public function writeLog() {
    $log = new Logger('Test');

    $log->pushHandler(new StreamHandler('../../logs/test-'.$this->getDate().'.log', Level::Warning));
  }
}