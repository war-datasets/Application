<div class="list-group">
    <a href="{{ route('users.index') }}" class="@if (Request::is('users*')) active @endif list-group-item">
        Gebruikers beheer
    </a>

    <a href="{{ route('roles.index') }}" class="@if (Request::is('roles*')) active @endif list-group-item">
        Rechten beheer
    </a>

    <a href="{{ route('permissions.index') }}" class="@if (Request::is('permissions*')) active @endif list-group-item">
        Permissie beheer
    </a>
</div>