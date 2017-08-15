<div class="panel panel-default">
    <div class="panel-heading">Genereer een nieuwe API sleutel.</div>
    <div class="panel-body">
        <form action="" method="GET" class="form-inline">
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
        <div class="panel-heading">Uw aangemaakte sleutels.</div>
    </div>
@endif