<?php

namespace ActivismeBE\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class PermissionController
 *
 * @package ActivismeBE\Http\Controllers
 */
class PermissionController extends Controller
{
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
