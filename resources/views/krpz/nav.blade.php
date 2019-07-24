<header class="top">

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="{{ $itemMenuActive == 'index' ? 'active' : '' }}" href="{{ route('krpz') }}">Главная</a>
        <a class="{{ $itemMenuActive == 'about' ? 'active' : '' }}" href="{{ route('krpz-about') }}">О конкурсе</a>
        <a class="{{ $itemMenuActive == 'all' ? 'active' : '' }}" href="{{ route('krpz-all') }}">Все работы</a>
        <a href="#">Новости</a>
    </div>

    <nav id="navbar">
        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-md-5 align-self-center left-side">
                    <p>Карапузы на Старт
                        <span>

                        </span>
                    </p>
                </div>

                <div class="col-lg-2 col-md-2 col-5 align-self-center logo">
                    <a href="{{ route('krpz') }}"><img src="/images/nav-logo.png" alt="logo"></a>
                </div>

                <div class="col-lg-5 col-md-5 col-7 align-self-center right-side">
                    <div class="social-icons square">
                        <div id="page-content-wrapper">
                            <span class="slide-menu" onclick="openNav()">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <div class="social-icons another">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </div>
                </div>
            </div>

        </div>
    </nav>

    <img class="border-img" src="/images/border.png" width="100%" alt="">
</header>
