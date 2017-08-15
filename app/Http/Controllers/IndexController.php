<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\CasualtyRepository;
use Illuminate\Http\Request;

/**
 * Class IndexController
 *
 * @package ActivismeBE\Http\Controllers
 */
class IndexController extends Controller
{
    /**
     * The casualty repository
     *
     * @var $casualties
     */
    private $casualties;

    /**
     * IndexController constructor.
     *
     * @param  CasualtyRepository $casualties
     */
    public function __construct(CasualtyRepository $casualties)
    {
        $this->casualties = $casualties;
    }

    /**
     * Show the index page for the application.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }
}
