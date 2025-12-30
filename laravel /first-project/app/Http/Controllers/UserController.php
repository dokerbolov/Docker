<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {

    }

    /**
     * Always returns 1
     * @return integer
     */
    public function getData() {
        return 1;
    }
}
