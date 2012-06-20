<?php

namespace Coregen\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CoregenAdminBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
