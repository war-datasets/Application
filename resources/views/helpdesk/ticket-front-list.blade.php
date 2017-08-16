@extends('layouts.app')

@section('title', 'Uw vragen')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12"> {{-- Info block --}}
                <div class="panel panel-default">
                    <div class="panel-heading">Helpdesk:</div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object img-thumbnail img-rounded" style="width: 64px; height:64px;" src="{{ asset('img/questions.svg') }}" alt="Questions">
                            </div>
                            <div class="media-body">
                                <p>
                                    Hier zijn de vragen die u hebt gesteld aan de admin(s) en ontwikkelaar(s) van et platorm. <br>
                                    Wij willen ook vragen om geen vragen te heropenen voor een simpele 'ok' of 'dank u' Zodat we andere vragen sneller kunnen behandelen.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- /Info Block --}}
        </div>
    </div>
@endsection