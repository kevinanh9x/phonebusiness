<?php

declare(strict_types=1);

namespace App\Application\Actions\Model\Auth;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class LoginAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $body = $this->request->getParsedBody();

        $username = $body['username'];
        $password = $body['password'];

        $statement = $this->db->prepare("SELECT * FROM accounts WHERE username=? AND password=?");
        $statement ->bindValue(':username', $username);
        $statement ->bindValue(':password', $password);

        $statement->execute([$username, $password]);
        $user = $statement->fetchAll();
        $pass = $statement->fetchAll();
        $message = "Your username and password is not correct";


        //  $_SESSION['accounts'] = [
        //     'id' => $user ->id,
        //     'username' => $user->username,
        //     'password' => $password ->password
        // ];

        if(!isset($user['username']) && !isset($pass['password'])){
            // $_SESSION["accounts"];
            return  $message = "You have been login successfully as user";
        }else{
            $message = "You have been login fail as user";
        }

        return $this->respondWithData($message, 200);
    }
}
