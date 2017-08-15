<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class UsersController
 *
 * @package ActivismeBE\Http\Controllers
 */
class UsersController extends Controller
{
    private $userRepository;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display the control panel for the users in the application.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userRepository->paginateAllUsers(50);

        return view('users.index', compact('users'));
    }
}
