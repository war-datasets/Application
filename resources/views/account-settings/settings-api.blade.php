<div class="panel panel-default">
    <div class="panel-heading"><span class="fa fa-plus" aria-hidden="true"></span> Genereer een nieuwe API sleutel.</div>
    <div class="panel-body">
        <form action="{{ route('api.key.create') }}" method="POST" class="form-inline">
            {{ csrf_field() }} {{-- CSRF form protection --}}

            <input type="text" name="service" class="form-control" style="width:85%" placeholder="Naam van je applicatie.">
            <button class="btn btn-success"><span class="fa fa-plus" aria-hidden="true"></span> Aanmaken</button>
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
                                <a href="" class="label label-danger">Verwijder</a>
                            </td>
                        </tr>
                    @endforeach {{-- END loop--}}
                </tbody>
            </table>
        </div> {{-- /API key listing --}}
    </div>
@endif