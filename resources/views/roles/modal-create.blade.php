<div id="new-permission" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Permissie toevoegen</h4>
            </div>

            <div class="modal-body">
                <form action="{{ route('roles.create') }}" class="form-horizontal" id="store" method="POST">
                    {{ csrf_field() }} {{-- CSRF form field protection --}}

                    <div class="form-group">
                        <label class="col-md-3 control-label">Naam: <span class="text-danger">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" placeholder="Naam permissie">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Type: <span class="text-danger">*</span></label>

                        <div class="col-md-9">
                            <select name="guard_name" class="form-control">
                                <option value="">-- Selecteer het systeem voor de permissie. --</option>
                                <option value="web">Applicatie</option>
                                <option value="api">Application Programming Interface</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Beschrijving: <span class="text-danger">*</span></label>

                        <div class="col-md-9">
                            <textarea name="description" class="form-control" rows="4" placeholder="Beschrijving permissie"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn-success btn btn-sm" type="submit" form="store">
                    <span class="fa fa-check"></span> Toevoegen
                </button>

                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                    <span class="fa fa-close" aria-hidden="true"></span> Sluiten
                </button>
            </div>
        </div>

    </div>
</div>