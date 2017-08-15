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
                        @if (count($categories) === 0)
                        @else
                            @foreach ($petitions as $petition)
                                <div style="margin-left: -15px;" class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4>
                                                <strong>
                                                    <a href="{{ route('petitions.show', $petition) }}">
                                                        @if ($petition->type === 'mailing') [Mailing]: @endif
                                                        {{ $petition->title }}
                                                    </a>
                                                </strong>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{ route('petitions.show', $petition) }}" class="thumbnail">
                                                <img src="{{ asset($petition->image_path) }}" alt="{{ $petition->title }}">
                                            </a>
                                        </div>

                                        <div class="col-md-9">
                                            <p>{{ strip_tags($petition->text) }}</p>
                                            <p>
                                                <a class="btn btn-sm btn-info" href="{{ route('petitions.show', $petition) }}">
                                                    <span class="fa fa-chevron-right" aria-hidden="true"></span> Lees meer
                                                </a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: -20px;">
                                            <p></p>

                                            <p>
                                                <i class="fa fa-user" aria-hidden="true"></i> Autheur: {{ $petition->author->name }}
                                                | <i class="fa fa-calendar" aria-hidden="true"></i> 10/11/2017
                                                | <i class="fa fa-tags" aria-hidden="true"></i> Tags:

                                                @if ($petition->categories()->count() > 0)
                                                    @foreach($petition->categories as $category)
                                                        <span class="label label-danger">{{ $category->name }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="label label-primary">Geen</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div> {{-- /Category box --}}
            </div> {{-- /Sidebar content --}}
        </div>
    </div>
@endsection