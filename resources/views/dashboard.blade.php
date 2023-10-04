<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header id="header">
      <div class="logo">
        <img
          src="https://static.vecteezy.com/system/resources/previews/010/160/674/original/coffee-icon-sign-symbol-design-free-png.png"
          id="header-img"
          alt="A coffee"
        />
        <div id="header-text">Dashboard</div>
      </div>
      <div class="user-greetings">
        <div> Hello {{ $user->username}}</div>
      </div>
      <nav id="nav-bar">
        <a href="#coffee-ingredients" class="nav-link">Orders</a>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

      </nav>
    </header>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    
<!-- 
    <form action="{{ route('logout')}}" method="post">
    {{ csrf_field() }}
        <input type="submit" name="logout" value="Logout" />
    </form> -->
</body>
</html>