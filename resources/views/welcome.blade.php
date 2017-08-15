@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h2>Namenlijst.</h2>

                    <p class="lead">Een korte namenlijst omtrent de oorlogs gesneuvelde in de eerste Koreaanse en Vietnamese oorlog.</p>

                    <p> {{-- Social buttons --}}
                        <a href="" class="btn btn-default">
                            <span class="fa fa-facebook" aria-hidden="true"></span> Facebook
                        </a>

                        <a href="" class="btn btn-default">
                            <span class="fa fa-envelope" aria-hidden="true"></span> Contact
                        </a>

                        <a href="" class="btn btn-default">
                            <span class="fa fa-github" aria-hidden="true"></span> Github
                        </a>
                    </p> {{-- /Social buttons --}}
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <i class="fa fa-info-circle fa-3x fa-pull-left fa-border" aria-hidden="true"></i>
                        Nu er toenemende dreiging en oorlogs taal is van de Verenigde staten richting Noord-Korea.
                        Zijn we met een open-source initiatief gestart. Waarin we mensen bewust willen maken. Omtrent de impact
                        van oorlog. Niet alleen blijft een land in vernieling en onstabiel achter maar ook vele militairen sneuvelen
                        of geraken vermist tijdens operaties.

                        Wat als conclusie biedt dat er geen winnaars of verliezers zijn. En oorlog vrij nutteloos is. Met dit platform
                        geven we je inzicht omtrent de gesneuvelde en vermiste militairen langs de zijde van de vs. tijdens de eerste koreaanse oorlog.
                        Die resulteerde in de splitsing van Korea tussen Noord en Zuid.
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <i class="fa fa-database fa-3x fa-pull-left fa-border" aria-hidden="true"></i>
                        Wij stellen ook ineens onze databank open voor gebruik. ZOdat elke ontwikkelaar aan de slag
                        kan met de slachtoffers data. Omdat open-data over deze conflicten in onze standpunten enorm belangrijk is.

                        Met een API kunt u de data die u wenst trekken uit onze databank. En deze verder gebruiken in je applicaties.
                        Of de applicaties die u wenst te bouwen in de toekomst. Laat ons ook zeker weten wat u met de API gebouwd hebt.
                        En zij zetten op een showcase pagina in deze applicatie. Zodat wij onrechtstreeks uw applicatie promoten.
                        En u zichtbaarheid krijgt voor je prestaties die je hebt geleverd.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection