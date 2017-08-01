<?php 

namespace Cart;

use DI\ContainerBuilder;
use DI\Bridge\Slim\App as DIBridge;

class App extends DIBridge

{
    protected function configureContainer(ContainerBuilder $builder) 
    {

        $builder->addDefinition([

            'settings.displayErrorDetails' => true,
        ]);
    }
}