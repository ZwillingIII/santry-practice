<?php
namespace App\Classes;

use Exception;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Errors {
  function __construct() {
    // echo "Залогировал тебя, не отвертишься";
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
   * @param {string} $option Warning, Error, Info 
   */
  public function writeLog($data, $option = 'Warning') {
    try {
      $log = new Logger(ucfirst($option));

      $params = match(mb_strtolower(trim($option))) {
        'warning' => [
          'path' => $_ENV['LOG_WARNING_PATH'],
          'level' => Level::Warning,
        ],
        'error' => [
          'path' => $_ENV['LOG_ERROR_PATH'],
          'level' => Level::Warning,
        ],
        'info' => [
          'path' => $_ENV['LOG_INFO_PATH'],
          'level' => Level::Info,
        ]
      };

      $log->pushHandler(new StreamHandler(__DIR__.$_ENV['LOG_PATH'].$params['path'].'/test-'.$this->getDate().'.log', $params['level']));

      return "Статус логирования: ".$log->addRecord($params['level'], "CODE $data", []);
    } catch (Exception $e) {
      return "Ошибка логирования";
    }
  }
}