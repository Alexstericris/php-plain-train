<?php

use Alex\CodingTaskDataFeed\Http\Route;

return [
    (new Route('GET', '/', \Alex\CodingTaskDataFeed\Http\Controllers\IndexController::class, 'index'))
];