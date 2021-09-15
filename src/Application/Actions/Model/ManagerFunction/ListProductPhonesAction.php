<?php

declare(strict_types=1);

namespace App\Application\Actions\Model\ManagerFunction;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ListProductPhonesAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $statement = $this->db->prepare("SELECT * FROM productphones");
        $statement->execute();

        $productphoness = $statement->fetchAll();
        return $this->respondWithData($productphoness, 200);
    }
}
