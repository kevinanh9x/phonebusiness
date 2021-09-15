<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Psr7\Stream;
use App\Application\Actions\Model\Auth\LoginAction;
use App\Application\Actions\Model\Auth\LogoutAction;
use App\Application\Actions\Model\ManagerFunction\AddOrderDetailsAction;
use App\Application\Actions\Model\ManagerFunction\ListProductPhonesAction;
use App\Application\Actions\Model\ManagerFunction\DetailProductPhonesAction;
use App\Application\Actions\Model\ManagerFunction\UpdateOrderStatusAction;
use App\Application\Actions\Model\ManagerFunction\DeleteSalePhonesAction;
use App\Application\Actions\Model\ManagerFunction\showOrderdetail;


return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

        $app->get('/db', function (Request $request, Response $response) {
        
       
        $db = $this->get(PDO::class);

        $sth = $db->prepare("SELECT *
        FROM accounts
        ");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');

    });

    $app->get('/showOrderdetails', function (Request $request, Response $response) {
        
       
        $db = $this->get(PDO::class);

        $sth = $db->prepare("SELECT *
        FROM orderdetails
        ");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');

    });

    $app->post("/login", LoginAction::class);
    $app->get("/logout", LogoutAction::class);
    
    $app->post("/addorderdetails", AddOrderDetailsAction::class);
    $app->get("/listproductes", ListProductPhonesAction::class);
    $app->get("/orderdetails/{orderdetailsId}", showOrderdetail::class);
    $app->get("/listproduct/{productdId}", DetailProductPhonesAction::class);
    $app->post("/orderstatus/{orderstatusId:[0-9]+}/update", UpdateOrderStatusAction::class);
    $app->get("/salephones/{salephonesId}/delete", DeleteSalePhonesAction::class);


    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
