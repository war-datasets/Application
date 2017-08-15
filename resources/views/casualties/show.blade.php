@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('img/placeholder-korea.jpg') }}" class="img-rounded img-thumbnail" alt="">
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>{{ $casualty->oi_name }}:</strong>
                        <span class="pull-right">
                            <code>{{ $casualty->service_no }}</code>
                            {{ ucfirst(strtolower($casualty->member_name)) }}
                        </span>
                    </div>

                    <div class="panel-body">
                        <h4>Persoonlijke gegevens:</h4>
                        <div class="well well-sm col-md-12">
                            <table class="col-md-9 table-hover table-condensed">
                                <tr>
                                    <td class="col-md-4"><strong>Naam:</strong></td>
                                    <td>{{ $casualty->member_name }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-4"><strong>Geboren:</strong></td>
                                    <td>
                                        @if (! empty($casualty->birth_date)) {{ $casualty->birth_date . ',' }}    @else Date unknown,  @endif 
                                        @if (! empty($casualty->hor_city))   {{ $casualty->hor_city . ',' }}      @else Place unknown  @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4"><strong>Geslacht:</strong></td>
                                    <td>{{ $casualty->g }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-4"><strong>Huidskleur:</strong></td>
                                    <td>{{ $casualty->race_name }}</td>
                                </tr>
                            </table>
                        </div>

                        <h4>Militaire gegevens:</h4>
                        <div class="well well-sm col-md-12">
                            <table class="col-md-9 table-hover table-condensed">
                                <tr>
                                    <td class="col-md-4"><strong>Dienstnummer:</strong></td>
                                    <td>{{ $casualty->service_no }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-4"><strong>Component:</strong></td>
                                    <td>{{ $casualty->service_name }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-4"><strong>Regiment:</strong></td>
                                    <td>{{ $casualty->unit_name }}</td>
                                </tr>
                            </table>
                        </div>

                        <h4>Overlijdings gegevens:</h4>
                        <div class="well well-sm col-md-12">
                            <table class="col-md-9 table-hover table-condensed">
                                <tr>
                                    <td class="col-md-4"><strong>Status:</strong></td>
                                    <td>{{ $casualty->casualty_type_name }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-4"><strong>Categorie:</strong></td>
                                    <td>{{ $casualty->casualty_category }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-4"><strong>Omstandigheden:</strong></td>
                                    <td>{{ $casualty->cas_circumstances }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-4"><strong>Plaats:</strong></td>
                                    <td> {{ $casualty->country_or_water_name }} </td>
                                </tr>
                            </table> 
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection