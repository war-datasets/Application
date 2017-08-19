<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\PermissionValidator;
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
        $permissions = $this->permissionRepository->getIndexPermissions(25);
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
        $permissions = $this->permissionRepository->searchPermission($input->term, 25);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Create a new permission in the system.
     *
     * @param  PermissionValidator $input The given user input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(PermissionValidator $input)
    {
        $input->merge(['author_id' => auth()->user()->id, 'system_permission' => 'N']);

        if ($permission = $this->permissionRepository->createPermission($input)) {
            flash("De permission ({ $permission->name }) is aangemaakt.")->success();
        }

        return redirect()->route('permissions.index');
    }
}
