<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class User
{
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
