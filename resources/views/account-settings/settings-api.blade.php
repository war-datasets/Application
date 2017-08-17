<div class="panel panel-default">
    <div class="panel-heading"><span class="fa fa-plus" aria-hidden="true"></span> Genereer een nieuwe API sleutel.</div>
    <div class="panel-body">
        <form action="{{ route('api.key.create') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }} {{-- CSRF form protection --}}

            <div class="form-group">
                <div class="col-md-12 {{ $errors->has('service') ? 'has-error' : '' }}">
                    <input type="text" name="service" class="form-control" placeholder="Naam van je applicatie.">

                    @if ($errors->has('service'))
                        <small class="help-block">{{ $errors->first('service') }}</small>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-success">
                        <span class="fa fa-check" aria-hidden="true"></span> Toevoegen
                    </button>

                    <button class="btn btn-sm btn-link" type="reset">
                        <span class="fa fa-undo" aria-hidden="true"></span> Annuleren
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@if ($user->apiKeys()->count() === 0)
    <div class="alert alert-info">
        <strong><span class="fa fa-info-circle"></span> Info:</strong>
        U heeft nog geen API sleutels aangemaakt.
    </div>
@else
    <div class="panel panel-default">
        <div class="panel-heading"><span class="fa fa-key" aria-hidden="true"></span> Uw aangemaakte sleutels.</div>

        <div class="panel-body"> {{-- API key listing --}}
            @php $keys = $user->apiKeys()->paginate(10) @endphp

            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Service:</th>
                        <th colspan="2">Key:</th> {{-- Colspan 2 needed for the delete function. --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keys as $key) {{-- Loop through authencated user api keys. --}}
                        <tr>
                            <td><strong>#{{ $key->id }}</strong></td>
                            <td>{{ $key->service }}</td>
                            <td><code>{{ $key->key }}</code></td>
                            <td class="text-center">
                                <a href="{{ route('api.key.delete', $key) }}" class="label label-danger">Verwijder</a>
                            </td>
                        </tr>
                    @endforeach {{-- END loop--}}
                </tbody>
            </table>
        </div> {{-- /API key listing --}}
    </div>
@endif