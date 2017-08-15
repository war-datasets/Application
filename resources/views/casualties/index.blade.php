@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('casualty.search') }}" method="GET" class="form-inline">
                    <input type="text" name="term" class="form-control" style="width: 25%" placeholder="Zoek bij naam.">
                    <button class="btn btn-primary"><span class="fa fa-search" aria-hidden="true"></span> Zoek</button>
                </form>
            </div>

            <div style="margin-top: 15px;" class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                           Er zijn {{ $count }} slachtoffers in het systeem.
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Dienstnummer:</th>
                                    <th>Naam:</th>
                                    <th>Geboortedatum:</th>
                                    <th>Datum overleden:</th>
                                    <th>Doodsoorzaak:</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($casualties as $casualty)
                                    <tr>
                                        <td><code><strong>{{ $casualty->service_no }}</strong></code></td>
                                        <td><a href="{{ route('casualties.show', ['id' => $casualty->service_no]) }}">{{ $casualty->member_name }}</a></td>
                                        <td>
                                            @if (! empty($casualty->birth_date)) {{ $casualty->birth_date . ',' }}    @else Date unknown,  @endif 
                                            @if (! empty($casualty->hor_city))   {{ $casualty->hor_city . ',' }}      @else Place unknown  @endif
                                        </td>
                                        <td>
                                            @if (! empty($casualty->death_dt))     {{ $casualty->death_dt . ',' }}    @else Date unknown,  @endif 
                                            @if (! empty($casualty->oi_location))  {{ $casualty->oi_location . ',' }} @else Place unknown  @endif
                                        </td>
                                        <td>{{ $casualty->casualty_category }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $casualties->links() }}
                    </div>
                </div>
            </>
        </div>
    </div>
@endsection