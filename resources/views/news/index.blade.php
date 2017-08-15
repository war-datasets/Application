@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('flash::message') {{-- Implement the flash message partial to the application. --}}

            <div class="col-md-9"> {{-- News content --}}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="page-header" style="margin-top: -20px;">
                            <h2 style="margin-bottom: -5px;">Nieuwsberichten.</h2>
                        </div>

                        @if (count($messages) === 0) {{-- No news messages found. --}}
                            <div class="alert alert-info alert-important">
                                <h4><span class="fa fa-info-circle" aria-hidden="true"></span> Info:</h4>
                                Er zijn momenteel geen nieuws berichten. Kom later nog eens terug en
                                misschien hebben we dan wel nieuws voor je :).
                            </div>
                        @else {{-- There are news messages found. --}}
                        @endif
                    </div>
                </div>
            </div> {{-- /News content --}}

            <div class="col-md-3"> {{-- Sidebar content --}}
                <div class="well well-sm"> {{-- Search well --}}
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control" placeholder="Zoek nieuwsbericht">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div> {{-- /Search well --}}

                <div class="panel panel-default"> {{-- Category box --}}
                    <div class="panel-heading">
                        <span class="fa fa-tags" aria-hidden="true"></span> Categorieen
                    </div>
                    <div class="panel-body">
                        @if (count($categories) === 0) {{-- No categories found in the system. --}}
                            <small><i>(Er zijn geen categorieen gevonden.)</i></small>
                        @else {{-- There are categories found in the system. --}}

                        @endif
                    </div>
                </div> {{-- /Category box --}}
            </div> {{-- /Sidebar content --}}
        </div>
    </div>
@endsection