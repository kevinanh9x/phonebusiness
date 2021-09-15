<?php

declare(strict_types=1);

namespace App\Application\Actions\Model\ManagerFunction;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class showOrderdetail extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

            $orderdetailsdId = $this->args['orderdetailsdId'];
            $statement = $this->db->prepare("SELECT * FROM orderdetails WHERE id=3");
            $statement->execute([$orderdetailsId]);

            $orderdetails = $statement->fetchAll();

            return $this->respondWithData($orderdetails, 200);

        // if (array_key_exists("admin", $_SESSION)) {
            
        // } else {
        //     return $this->respondWithData("You need to login to see this content", 200);
        // }
    }
}
