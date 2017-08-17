<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\AccountInfoValidator;
use ActivismeBE\Http\Requests\AccountSecurityValidator;
use ActivismeBE\Http\Requests\ApiKeyCreationValidator;
use ActivismeBE\Repositories\AccountRepository;
use ActivismeBE\Repositories\ApiKeyRepository;
use ActivismeBE\Traits\Conditions\ApiKey as ApiKeyConditions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AccountSettingsController
 *
 * @package ActivismeBE\Http\Controllers
 */
class AccountSettingsController extends Controller
{
    use ApiKeyConditions; // Needed for the IF/ELSE statements.

    /**
     * The Account eloquent database layer.
     *
     * @var AccountRepository
     */
    private $accountRepository;

    /**
     * The apikey eloquent database Layer;
     *
     * @var apiKeyRepository
     */
    private $apiKeyRepository;

    /**
     * AccountSettingsController constructor.
     *
     * @param AccountRepository $accountRepository
     * @param ApiKeyRepository   $apiKeyRepository
     */
    public function __construct(AccountRepository $accountRepository, ApiKeyRepository $apiKeyRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->apiKeyRepository  = $apiKeyRepository;
    }

    /**
     * Get the account configuration from the user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('account-settings.index');
    }

    /**
     * Update the account security settings from the user.
     *
     * @param  AccountSecurityValidator $input The user given input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(AccountSecurityValidator $input)
    {
        if ($this->accountRepository->securityUpdate($input->all())) {
            flash("Wij hebben uw account beveiliging aangepast.")->success();
            session()->flash('tab-status', 'account-sec');
        }

        return redirect()->route('account.settings');
    }

    /**
     * Update the account information from the user.
     *
     * @param  AccountInfoValidator $input The user given input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(AccountInfoValidator $input)
    {
        if ($this->accountRepository->infoUpdate($input->all())) {
            flash('Wij hebben uw account informatie aangepast.')->success();
            // No flash session needed because it is the default tab.
        }

        return redirect()->route('account.settings');
    }

    /**
     * Create an api key for the user in the system.
     *
     * @param  ApiKeyCreationValidator $input The user given input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAPiKey(ApiKeyCreationValidator $input)
    {
        if ($apiKey = $this->apiKeyRepository->createKey($input->service)) {
            flash("De api sleutel: {$apiKey} is aangemaakt.")->success();
            session()->flash('tab-status', 'api-key');
        }

        return redirect()->route('account.settings');
    }

    /**
     * Delete a api key in the system.
     *
     * @param  integer $keyId The primary key in the database from the key.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteApiKey($keyId)
    {
        if ($this->canDeleteApiKey(auth()->user(), $keyId)) {       // Check the permission before the delete.
            if ($this->apiKeyRepository->keyExist($keyId) === 1) {  // The api key is found.
                if ($this->apiKeyRepository->deleteKey($keyId)) {   // API key === Deleted
                    flash("De API sleutel is verwijderd.")->success();
                    session()->flash('tab-status', 'api-key');
                }
            }

            return redirect()->route('account.settings');
        }

        // The user hasn't the right permissions
        return app()->abort(Response::HTTP_FORBIDDEN);
    }
}
