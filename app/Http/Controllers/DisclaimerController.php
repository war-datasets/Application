<?php

namespace ActivismeBE\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class DisclaimerController
 *
 * @package ActivismeBE\Http\Controllers
 */
class DisclaimerController extends Controller
{
    public function index()
    {
        return view('disclaimer.index');
    }
}
