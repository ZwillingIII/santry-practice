<?php
namespace App\Classes;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Errors {
  function __construct() {
    echo "Залогировал тебя, не отвертишься";
  }
  
  /**
   * Получить сегодняшнюю дату
   */
  private function getDate() {
    return date('d-m-Y');
  }

  /**
   * Запись лога
   * 
   * @param {string} $data
   */
  public function writeLog($data) {
    $log = new Logger('Test');

    $log->pushHandler(new StreamHandler(__DIR__.$_ENV['LOG_PATH'].'/test-'.$this->getDate().'.log', Level::Warning));

    $log->warning('Warning code '.$data);

    echo 'Лог записан';
  }
}