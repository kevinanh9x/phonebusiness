<?php

declare(strict_types=1);

namespace App\Application\Actions\Model\ManagerFunction;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateOrderStatusAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $body = $this->request->getParsedBody();
        $status = $body['status'];

        $orderstatusId = $this->args['orderstatusId'];
        $statement = $this->db->prepare("UPDATE orderstatus SET status=? WHERE id=?");
        $statement->execute([$status, $orderstatusId]);
        return $this->respondWithData("You have been updated successfully", 200);
    }
}
