<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\HelpdeskRepository;
use Illuminate\Http\Request;

/**
 * Class HelpdeskController
 *
 * @package ActivismeBE\Http\Controllers
 */
class HelpdeskController extends Controller
{
    private $helpdeskRepository;

    /**
     * HelpdeskController constructor.
     *
     * @param HelpdeskRepository $helpdeskRepository
     */
    public function __construct(HelpdeskRepository $helpdeskRepository)
    {
        $this->middleware('auth')->only(['indexAdmin']);

        $this->helpdeskRepository = $helpdeskRepository;
    }

    public function indexUser()
    {

    }

    public function indexAdmin()
    {

    }
}
