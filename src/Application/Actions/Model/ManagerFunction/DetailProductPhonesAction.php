<?php

declare(strict_types=1);

namespace App\Application\Actions\Model\ManagerFunction;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class DetailProductPhonesAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

            $productdId = $this->args['productdId'];
            $statement = $this->db->prepare("SELECT * FROM productphones WHERE id=?");
            $statement->execute([$productdId]);

            $product = $statement->fetchAll();

            return $this->respondWithData($product, 200);

        // if (array_key_exists("admin", $_SESSION)) {
            
        // } else {
        //     return $this->respondWithData("You need to login to see this content", 200);
        // }
    }
}
