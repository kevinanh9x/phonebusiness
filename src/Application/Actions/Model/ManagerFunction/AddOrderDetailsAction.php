<?php

declare(strict_types=1);

namespace App\Application\Actions\Model\ManagerFunction;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class AddOrderDetailsAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $body = $this->request->getParsedBody();

        if(!isset ($body['id']) || !isset($body['price']) || !isset($body['sale_quantity']) || !isset($body['orders_id']) || !isset($body['productphones_id'])){
            // return $this->response->withStatus(404);
            return $this->respondWithData("You have added a new deliverer.", 400);
        // return $this->respondWithData("You ERRRO added a new deliverer.", 200);
    }
        $idorderdetails = $body['id'];
        $prices = $body['price'];
        $salequantitys = $body['sale_quantity'];
        $ordersId = $body['orders_id'];
        $productphonesId = $body['productphones_id'];

        $statement = $this->db->prepare("INSERT INTO orderdetails (id, price,sale_quantity,orders_id,productphones_id) 
            VALUES (:id, :price, :sale_quantity,:orders_id, :productphones_id);");

        $statement->bindValue(':id', $idorderdetails);
        $statement->bindValue(':price', $prices);
        $statement->bindValue(':sale_quantity', $salequantitys);
        $statement->bindValue(':orders_id', $ordersId);
        $statement->bindValue(':productphones_id', $productphonesId);

        $isUpdated1 = $statement->execute();

        return $this->respondWithData("You have added a new deliverer.", $isUpdated1, 200);

    }
}
