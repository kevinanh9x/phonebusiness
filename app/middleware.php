<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\TwigMiddleware;

return function (App $app) {
    $app->add(SessionMiddleware::class);
    // $app->addBodyParsingMiddleware();
    // $app->add(TwigMiddleware::class);
    // $app->addRoutingMiddleware();
    // $app->add(ErrorMiddleware::class);
};
