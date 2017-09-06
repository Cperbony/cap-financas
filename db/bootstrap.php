<?php

use CAPFin\Application;
use CAPFin\Plugins\AuthPlugin;
use CAPFin\Plugins\DbPlugin;
use CAPFin\ServiceContainer;


$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

return $app;