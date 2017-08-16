@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Implement the flash message partial to the application. --}}

        <div class="row">
            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="list-group">
                    <a href="#info" class="list-group-item" aria-controls="info" role="tab" data-toggle="tab">
                        <span class="fa fa-asterisk" aria-hidden="true"></span> Account informatie.
                    </a>

                    <a href="#security" class="list-group-item" aria-controls="security" role="tab" data-toggle="tab">
                        <span class="fa fa-asterisk" aria-hidden="true"></span> Account beveiliging
                    </a>

                    <a href="#api" class="list-group-item" aria-controls="api" role="tab" data-toggle="tab">
                        <span class="fa fa-asterisk" aria-hidden="true"></span> API sleutels
                    </a>
                </div>

                <div class="list-group">
                    <div class="list-group">
                        <a href="" class="list-group-item list-group-item-danger">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                            Verwijder account
                        </a>
                    </div>
                </div>
            </div> {{-- /Sidebar --}}

            <div class="col-md-9"> {{-- Content --}}
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="info">
                        @include ('account-settings.settings-info')
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="security">
                        @include ('account-settings.settings-security')
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="api">
                        @include ('account-settings.settings-api')
                    </div>
                </div>
            </div> {{-- /Content --}}
        </div>
    </div>
@endsection