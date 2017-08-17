<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Traits\Conditions\Users as UserConditions;
use ActivismeBE\Repositories\ApiKeyRepository;
use ActivismeBE\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class UsersController
 *
 * @package ActivismeBE\Http\Controllers
 */
class UsersController extends Controller
{
    use UserConditions; // The IF/ELSE conditions for the users.

    /**
     * The user database layer.
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * The apikeys database layer.
     *
     * @var ApiKeyRepository
     */
    private $apiKeyRepository;

    /**
     * UsersController constructor.
     *
     * @param UserRepository    $userRepository
     * @param ApiKeyRepository  $apiKeyRepository
     */
    public function __construct(UserRepository $userRepository, ApiKeyRepository $apiKeyRepository)
    {
        $this->middleware('auth');
        
        $this->userRepository   = $userRepository;
        $this->apiKeyRepository = $apiKeyRepository;
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

    /**
     * Search for a specific user in the system.
     *
     * @param  Request $input The user given input
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $input)
    {
        $users = $this->userRepository->searchUser($input->term, 50);
        return view('users.index', compact('users'));
    }

    /**
     * Delete a user in the system.
     *
     * @param  integer $userId The id from the user in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($userId)
    {
        $user = $this->userRepository->findUser($userId);

        if ($this->userRepository->delete($user->id)) { // 1. The user has been deleted
            $this->apiKeyRepository->deleteUserApiKeys($user); // 2. api keys has been deleted

            if ($this->userIsCurrentAuthencated($user)) {
                flash("Wij hebben je account verwijderd.")->success();
                return redirect()->route('home.front');
            }
        }

        flash("{$user->name} is verwijderd uit het systeem.");
        return redirect()->route('users.index');
    }
}
