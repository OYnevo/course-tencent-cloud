<?php

namespace App\Http\Html5;

use App\Services\AuthUser\Html5 as Html5AuthUser;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{

    public function registerAutoLoaders(DiInterface $di = null)
    {

    }

    public function registerServices(DiInterface $di)
    {
        $di->setShared('view', function () {
            $view = new View();
            $view->disable();
            return $view;
        });

        $di->setShared('auth', function () {
            return new Html5AuthUser();
        });
    }

}