<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\PermissionRepository;
use Illuminate\Http\Request;

/**
 * Class PermissionController
 *
 * @package ActivismeBE\Http\Controllers
 */
class PermissionController extends Controller
{
    /**
     * Permission database abstraction layer.
     *
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * PermissionController constructor.
     *
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->middleware('auth');

        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Get the permissions index view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Search for a specific permission in the system.
     *
     * @param  Request $input The user given input.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $input)
    {
        $permissions = [];
        return view('permissions.index', compact('permissions'));
    }
}
