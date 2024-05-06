<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Classes\Errors;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$errors = new Errors();

// echo '<pre>';

// print_r($_ENV);

// echo '</pre>';

\Sentry\init([
  'dsn' => $_ENV['SENTRY_DSN'],
  // Specify a fixed sample rate
  'traces_sample_rate' => 1.0,
  // Set a sampling rate for profiling - this is relative to traces_sample_rate
  'profiles_sample_rate' => 1.0,
]);

// $a = 5/'fjdslfjsdlfs';

try {
  $this->functionFailsForSure();
} catch (\Throwable $exception) {
  $errors->writeLog((string)\Sentry\captureException($exception));
}
