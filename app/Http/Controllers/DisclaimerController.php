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
    /**
     * Disclaimer page controller in the application.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('disclaimer.index');
    }
}
