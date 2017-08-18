@extends('layouts.app')

@section('title', 'Rechtenbeheer')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-list" aria-hidden="true"></span> Rechten beheer:

                        <button class="pull-right btn btn-xs btn-default">
                            <span class="fa fa-plus" aria-hidden="true"></span> Rol toevoegen
                        </button>
                    </div>
                    <div class="panel-body">
                        @if (count($roles) == 0) {{-- There are no roles found in the sys. --}}
                            <div class="alert alert-info alert-important" role="alert">
                                <strong><span class="fa fa-info-circle" aria-hidden="true"></span> Info:</strong>
                                Er zijn geen rechten gevonden in het systeem.
                            </div>
                        @else {{-- There are roles found in the system. --}}
                            <table class="table table-hover table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Naam:</th>
                                        <th colspan="2">Beschrijving</th> {{-- Colspan="2" needed for the functions. --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>#{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->description }}</td>

                                            <td class="text-center"> {{-- Options --}}

                                            </td> {{-- END options --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div> {{-- END content --}}

            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="well well-sm"> {{-- SEARCH form --}}
                    <form action="" method="GET">
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

                @include('modules.acl-sidenav') {{-- Sidenav navigation --}}
            </div> {{-- END sidebar --}}
        </div>
    </div>
@endsection