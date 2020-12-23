<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SKPController extends Controller
{
    public function list() {
        return \view("skp/index");
    }

    public function addHeaderForm() {
        return \view("skp/add");
    }
}
