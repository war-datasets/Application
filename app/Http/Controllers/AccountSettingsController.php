<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\AccountInfoValidator;
use ActivismeBE\Http\Requests\AccountSecurityValidator;
use ActivismeBE\Repositories\AccountRepository;
use ActivismeBE\Repositories\ApiKeyRepository;
use Illuminate\Http\Request;

/**
 * Class AccountSettingsController
 *
 * @package ActivismeBE\Http\Controllers
 */
class AccountSettingsController extends Controller
{
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
     * @param  Request $input The user given input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAPiKey(Request $input)
    {
        $this->validate($input, ['service' => 'required']);

        if ($apiKey = $this->apiKeyRepository->createKey($input->service)) {
            flash("De api sleutel: {$apiKey} is aangemaakt.");
            session()->flash('tab-status', 'api-key');
        }

        return redirect()->route('account.settings');
    }
}
