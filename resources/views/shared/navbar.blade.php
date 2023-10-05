<header id="header">
    <div class="logo">
        <img src="https://static.vecteezy.com/system/resources/previews/010/160/674/original/coffee-icon-sign-symbol-design-free-png.png"
            id="header-img" alt="A coffee" />
        <div id="header-text">Dashboard</div>
    </div>
    <div class="user-greetings">
        <div> Hello {{ $user->username }}</div>
    </div>
    <nav id="nav-bar">
        <a href="{{ route('dashboard') }}" class="nav-link <?php if ($pageTitle == 'Dashboard')
        echo 'active'; ?> text-center">Home</a>
        <a href="{{ route('orders') }}" class="nav-link <?php if ($pageTitle == 'Orders')
        echo 'active'; ?> text-center">Orders</a>
        <a href="#" class="nav-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    </nav>
</header>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>