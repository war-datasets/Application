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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('account-settings.index');
    }

    /**
     * @param  AccountSecurityValidator $input The user given input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(AccountSecurityValidator $input)
    {
        if ($this->accountRepository->securityUpdate($input->all())) {
            flash("Wij hebben uw account beveiliging aangepast.")->success();
        }

        return redirect()->route('account.settings');
    }

    /**
     * @param  AccountInfoValidator $input The user given input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(AccountInfoValidator $input)
    {
        if ($this->accountRepository->infoUpdate($input->all())) {
            flash('Wij hebben uw account informatie aangepast.')->success();
        }

        return redirect()->route('account.settings');
    }

    public function createAPiKey(Request $input)
    {
        if ($this->apiKeyRepository->createKey($input->service)) {
            dd('done');
        }

        return redirect()->route('account.settings');
    }
}
