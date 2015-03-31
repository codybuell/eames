<nav id="menu_bar">

  <div id="menu_bar_left" class="pull-left">
    <div id="menu_icon" class="menu"><i class="fa fa-bars"></i></div>
    <div id="menu" class="menu">
      <ul class="menunav">
        <a href="{{ route('dashboard') }}"><li class="menunav_item">Dashboard</li></a>
        <li class="menunav_item">
          Tasks
          <ul class="subnav">
            <a href=""><li class="subnav_item">All Projects</li></a>
            <a href=""><li class="subnav_item">All Tasks</li></a>
            <a href=""><li class="subnav_item">My Projects</li></a>
            <a href=""><li class="subnav_item">My Tasks</li></a>
          </ul>
        </li>
        <li class="menunav_item">
        <a href="{{ route('logs.index') }}">Logs</a>
          <ul class="subnav">
            <a href="{{ route('logs.create') }}"><li class="subnav_item">Create New Log</li></a>
          </ul>
        </li>
        <li class="menunav_item">
          Admin
          <ul class="subnav">
            <a href="{{ route('users.index') }}"><li class="subnav_item">Users</li></a>
            <a href="{{ route('users.create') }}"><li class="subnav_item">Create User</li></a>
          </ul>
        </li>
      </ul>
    </div>
  </div>

  <div id="menu_bar_right" class="pull-right">
    <ul class="menunav">
      <li class="menunav_item text-capitalize">
        @if (Auth::user()->profile->first_name)
          Hello {{ Auth::user()->profile->first_name }}
        @else
          Hello {{ Auth::user()->username }}
        @endif
        <ul class="subnav">
          <a href="{{ route("account") }}"><li class="subnav_item">Account</li></a>
          <a href="{{ route('logout') }}"><li class="subnav_item">Logout</li></a>
        </ul>
      </li>
    </ul>
  </div>

</nav>
