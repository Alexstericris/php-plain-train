<?php

namespace Alex\CodingTaskDataFeed\Http\Controllers;

use Alex\CodingTaskDataFeed\Http\Request;

class IndexController
{

    function index(Request $request)
    {
        $data = [$request->get('test')];

        require_once views_path('indexView.php');
    }
}