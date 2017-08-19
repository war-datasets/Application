<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\RoleValidator;
use ActivismeBE\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class RoleController
 *
 * @package ActivismeBE\Http\Controllers
 */
class RoleController extends Controller
{
    /**
     * The role database abstraction.
     *
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * RoleController constructor.
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->middleware('auth');

        $this->roleRepository = $roleRepository;
    }

    /**
     * Get the index page for the role management.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = $this->roleRepository->paginateAllRoles(25);
        return view('roles.index', compact('roles'));
    }

    /**
     * Search for a specific role in the system.
     *
     * @param  Request $input The given input form the user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $input)
    {
        $roles = $this->roleRepository->searchRole($input->term, 25);
        return view('roles.index', compact('roles'));
    }

    /**
     * Store a new role in the database.
     *
     * @param  RoleValidator $input The given user input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleValidator $input)
    {
        $input->merge(['author_id' => auth()->user()->id, 'system_role' => 'N']);

        if ($role = $this->roleRepository->createRole($input)) {
            flash("De rol ({ $role->name }) is toegevoegd in het systeem.");
        }

        return redirect()->route('roles.index');
    }

    /**
     * Delete a role out off the system.
     *
     * @param  integer $roleId The primary key from te role in the db.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($roleId)
    {
        try {
            $permission = $this->roleRepository->findRole($roleId);
            $permission->syncPermissions([]);   // Empty relation for clearing the permissions relation.
            $permission->delete();              // Finally delete the role.

            flash('We have deleted the permission group');
            return redirect()->route('roles.index');
        } catch (ModelNotFoundException $exception) {
            flash('Wij konden de permissie niet verwijderen.')->error();
            return redirect()->route('roles.index');
        }
    }
}
