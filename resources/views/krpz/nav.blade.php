<nav class="navbar sticky-top navbar-expand-lg navbar-light krpz-bg-green">

    <a class="navbar-brand" href="#">
        Bootstrap
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item {{ $itemMenuActive == 'index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('krpz') }}">Главная <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item {{ $itemMenuActive == 'about' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('krpz-about') }}">О конкурсе</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Все работы</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Новости</a>
            </li>

            <li class="nav-item {{ $itemMenuActive == 'participate' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('krpz-participate') }}">Принять участие</a>
            </li>

        </ul>
    </div>
</nav>
