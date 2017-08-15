<div class="panel panel-default">
    <div class="panel-heading">Account beveiliging.</div>

    <div class="panel-body">
        <form action="{{ route('account.settings.security') }}" class="form-horizontal" method="POST">
            {{ csrf_field() }} {{-- CSRF form protection --}}

            <div class="form-group">
                <label class="control-label col-md-3">
                    Nieuw wachtwoord: <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="password" name="password" class="form-control" placeholder="Uw nieuw wachtwoord">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">
                    Herhaal wachtwoord: <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Herhaal uw wachtwoord.">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-sm btn-success">
                        <span class="fa fa-check" aria-hidden="true"></span> Aanpassen
                    </button>

                    <button type="reset" class="btn btn-sm btn-danger">
                        <span class="fa fa-undo" aria-hidden="true"></span> Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>