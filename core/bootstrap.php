<?php

namespace App\Core;

use App\Core\App;
use App\Core\Database\connection;
use App\Core\Database\queryBuilder;

include "app.php";
include "database/connection.php";
include "database/queryBuilder.php";

App::bind('config', require (dirname(__DIR__).'\config.php'));
App::bind('database', new QueryBuilder(
    Connection::connect(App::get('config')['database'])
));