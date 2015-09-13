<?php

namespace Gestion\ClientsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GestionClientsBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
    
    
}
