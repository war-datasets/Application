<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\BlockValidator;
use ActivismeBE\Traits\Conditions\Users as UserConditions;
use ActivismeBE\Repositories\ApiKeyRepository;
use ActivismeBE\Repositories\UserRepository;
use Carbon\Carbon;
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
     * Block a user in the system.
     *
     * @param  BlockValidator $input The user given input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block(BlockValidator $input)
    {
        if ($this->currentUser($input->id)) {
            flash("Je kan jezelf helaas niet blokkeren.")->warning();
            return redirect()->route('users.index');
        }

        $user = $this->userRepository->findUser($input->id);
        $user->ban([
            'comment'    => $input->reason,
            'expired_at' => Carbon::parse($input->eind_datum)
        ]);

        flash("{$user->name} is geblokkeerd tot {$input->eind_datum}.")->success();
        return redirect()->route('users.index');
    }

    /**
     * Activate a user in the system.
     *
     * @param  integer $userId The id in the database from the user.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblock($userId)
    {
        $user = $this->userRepository->findUser($userId);

        switch ($user) {
            case ($user->isBanned()):
                $user->unban(); // Unban the user in the system
                flash('De gebruiker is terug geactiveerd')->success();
                break;
            case ($user->isNotBanned()):
                flash('Wij konden de gebruiker niet activeren.')->warning();
                break;
        }

        return redirect()->route('users.index');
    }

    /**
     * Find and return a user in json.
     *
     * @param  integer $userId The id in the database for the user.
     * @return \Illuminate\Http\JsonResponse
     */
    public function userJson($userId)
    {
        // TODO: Possible refactor this and set is to the api
        return response()->json($this->userRepository->findUser($userId));
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
