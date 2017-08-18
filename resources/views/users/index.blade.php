@extends('layouts.app')

@section('title', 'Gebruikersbeheer')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Implement the flash message partial to the application. --}}

        <div class="row">
            <div class="col-md-9"> {{-- MAIN Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-users" aria-hidden="true"></span> Gebruikersbeheer.

                        <button class="btn btn-xs btn-default pull-right">
                            <span class="fa fa-plus" aria-hidden="true"></span> Gebruiker toevoegen.
                        </button>
                    </div>

                    <div class="panel-body">
                        @if (count($users) === 0) {{-- No users found wth the search query. --}}
                            {{-- IF/ELSE only implemented because the search feature in the users admin panel --}}
                            <div class="alert alert-info alert-important" role="alert">
                                <strong><span class="fa fa-info-circle" aria-hidden="true"></span></strong> Info:
                                Wij konden geen gebruikers vinden in het systeem met je zoekopdracht.
                            </div>
                        @else {{-- There are users found in the system. --}}
                            <table class="table table-condensed table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Naam:</th>
                                        <th>Email adres:</th>
                                        <th colspan="2">Toegevoegd op:</th> {{-- Colspan 2 needed for the functions --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user) {{-- Loop through the users. --}}
                                        <tr @if ($user->isBanned()) class="danger" @endif>
                                            <td><strong>#{{ $user->id }}</strong></td>
                                            <td>{{ $user->name }}</td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td>{{ $user->created_at->format('Y/m/d') }}</td>

                                            <td class="text-center"> {{-- Options --}}
                                                <a href="" class="label label-info">Wijzig</a>

                                                @if ($user->isNotBanned()) {{-- User is active --}}
                                                    <a onclick="getDataById('{{ route('user.json', $user) }}', '#block-user')" class="label label-warning">Blokkeer</a>
                                                @elseif($user->isBanned()) {{-- User is banned --}}
                                                    <a href="{{ route('user.unblock', $user) }}" class="label label-success">Activeer</a>
                                                @endif

                                                <a href="{{ route('users.delete', $user) }}" class="label label-danger">Verwijder</a>
                                            </td> {{-- /Options --}}
                                        </tr>
                                    @endforeach {{-- End loop --}}
                                </tbody>
                            </table>

                            @if (count($users) > 50) {{-- Pagination --}}
                                {{ $users->links }}
                            @endif {{-- END pagination --}}
                        @endif
                    </div>
                </div>
            </div> {{-- END main content --}}

            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="well well-sm"> {{-- SEARCH form --}}
                    <form action="{{ route('users.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="term" placeholder="Zoek op naam, email" class="form-control">

                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-danger">
                                    <i aria-hidden="true" class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div> {{-- END search form --}}

                @include('modules.acl-sidenav') {{-- Implement sidebar navigation --}}
            </div> {{-- END sidebar --}}
        </div>
    </div>

    {{-- Include needed database modals. --}}
        @include('users.modals.block-user')
    {{-- END includes --}}
@endsection

@push('scripts')
    <script src="{{ asset('js/ajax-user.js') }}"></script>
@endpush