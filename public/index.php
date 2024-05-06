<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


$logger = new \App\Classes\Logger('front');
try {
    new \App\Classes\Logger($dotenv);
} catch (Throwable $e) {

    $logger->info('ahtung:' . $e->getMessage(), $e->getTrace());
    echo $e->getMessage();
}

$logger = new \App\Classes\Logger('1c');
try {
    $client = new \GuzzleHttp\Client();

    $url = 'https://asd.bokus.ru';
    $response = $client->get($url);
    echo $response->getBody()->getContents();
} catch (\GuzzleHttp\Exception\ClientException $e) {

    $logger->warning($e->getMessage());
} catch (Throwable $e) {
    $logger->error($e->getMessage());
}
