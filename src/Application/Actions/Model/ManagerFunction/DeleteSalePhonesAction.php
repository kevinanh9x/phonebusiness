<?php

declare(strict_types=1);

namespace App\Application\Actions\Model\ManagerFunction;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteSalePhonesAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $salephonesId = $this->args['salephonesId'];
        $statement = $this->db->prepare("DELETE FROM salephones WHERE id=?");
        $statement->execute([$salephonesId]);

        return $this->respondWithData("You have been deleted salephones successfully", 200);
    }
}
