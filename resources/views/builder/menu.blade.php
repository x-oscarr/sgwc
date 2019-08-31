<div class="header">
    <div class="logo">
        <a href="{{ route('index') }}"><img src="{{ asset('img/logo.png') }}" alt="Логотип"></a>
    </div>
    <div class="menu-button">
        <span></span>
    </div>
    <div class="navigation">
        <div class="title">
            <h2>Меню</h2>
        </div>
        <nav class="nav">
            <ul class="ul">
                @if(Auth::check())
                    <a href="{{ route('profile') }}"><li class="font-weight-bold"><i class="fas fa-user"></i> {{ Auth::user()->username }}</li></a>
                @else
                    <a href="{{ route('auth') }}"><li><i class="fas fa-user"></i> Профиль</li></a>
                @endif

                <a href="{{ route('rating') }}"><li><i class="fas fa-chart-line"></i> Рейтинг</li></a>
                <a href="#"><li><i class="fas fa-book"></i> Правила</li></a>
                <a href="#"><li><i class="fas fa-shopping-cart"></i> Донат</li></a>
                <a href="{{ route('report.add') }}"><li><i class="fas fa-flag"></i> Подать жалобу</li></a>
                <a href="#"><li><i class="fas fa-ban"></i> SourceBans</li></a>
                <hr style="margin: 20px;">
                <a href="#"><li><i class="fas fa-laptop-code"></i> Админпанель</li></a>
                <a href="#"><li><i class="fas fa-cogs"></i> Настройки</li></a>
                <a href="#"><li><i class="fas fa-tools"></i> Инструменты</li></a>
                <a href="#"><li><i class="fas fa-angry"></i> Репорты</li></a>
                <hr style="margin: 20px;">
                <a href="#"><li><i class="fab fa-telegram-plane"></i> zomboy7</li></a>
                <a href="#"><li><i class="fab fa-discord"></i> lococat</li></a>
                <a href="#"><li><i class="fab fa-vk"></i> solpadoin</li></a>
                <hr style="margin: 20px;">
                @if(Auth::check())
                    <a href="{{ route('logout') }}"><li><i class="fas fa-times text-danger"></i> Выход</li></a>
                @endif
            </ul>
        </nav>
    </div>
</div>
