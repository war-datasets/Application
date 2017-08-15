<div class="panel panel-default">
    <div class="panel-heading">Account informatie:</div>
    <div class="panel-body">
        <form action="" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-3">
                    Naam: <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="text" name="name" placeholder="Uw account naam" class="form-control" value="{{ $user->name }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">
                    E-mail adres: <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="email" name="email" placeholder="Uw account email adres." class="form-control" value="{{ $user->email }}">
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