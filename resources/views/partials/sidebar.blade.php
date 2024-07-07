<div class="sidebar">
    <div class="logo"></div>
    <div class="menu" style="margin-top: 100px; text-align: center">
        <li class="{{ Request::is('dashboard*') ? 'active' : '' }}" style="margin: 20px 0;">
            <a style="" class="nav-link" href="{{ url('/dashboard') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <br>
        <li class="{{ Request::is('produk*') ? 'active' : '' }}" style="margin: 20px 0;">
            <a style="" class="nav-link" href="{{ url('/produk') }}">
                <i class="fas fa-briefcase"></i>
                <span>Produk</span>
            </a>
        </li>
        <br>

        <li class="{{ Request::is('pending*') ? 'active' : '' }}" style="margin: 20px 0;">
            <a style="" class="nav-link" href="{{ url('/pending') }}">
                <i class="fas fa-clock"></i>
                <span>Pending</span>
            </a>
        </li>
        <br>
        <li class="{{ Request::is('low*') ? 'active' : '' }}" style="margin: 20px 0;">
            <a style="" class="nav-link" href="{{ url('/low') }}">
                <i class="fas fa-exclamation-circle"></i>
                <span>Low Stock</span>
            </a>
        </li>
    </div>

</div>

<div class="main--content">
    <div class="header--wrapper">

        <div class="header--title">
            <div class="image">
                <img src="/img/logodg.jpeg" alt="Logo Keren" class="styled-image">

            </div>
        </div>
        <p class="text-a">{{ $title }} </p>
        <div class="user--info">
            <div class="dropdown">
                <button class="dropdown-btn" style="font-size:18px; "><i class="fas fa-user" style="font-size:18px; margin: 10px;"></i>Selamat Datang
                    {{ auth()->user()->name }} <i class="fa-solid fa-caret-down" style=" color: #030303;"></i></button>
                <div class="dropdown-content">
                    <a href="/dashboard"><i class="fas fa-tachometer-alt"></i> My Dashboard</a>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="logout-button" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
