<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\AccountInfoValidator;
use ActivismeBE\Http\Requests\AccountSecurityValidator;
use ActivismeBE\Repositories\AccountRepository;
use Illuminate\Http\Request;

class AccountSettingsController extends Controller
{
    private $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function index()
    {
        return view('account-settings.index');
    }

    public function updateSecurity(AccountSecurityValidator $input)
    {
        if ($this->accountRepository->securityUpdate($input->all())) {
            flash("Wij hebben uw account beveiliging aangepast.")->success();
        }

        return redirect()->route('account.settings');
    }

    public function updateInfo(AccountInfoValidator $input)
    {
        if ($this->accountRepository->infoUpdate($input->all())) {
            flash('Wij hebben uw account informatie aangepast.')->success();
        }

        return redirect()->route('account.settings');
    }
}
