<header class="header">
   <a href="{{ Route('dashboard') }}" class="logo">{{ config('app.name') }}</a>
   <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </a>
      <div class="navbar-right">
         <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i>
                  <span>{{ Auth::user()->name }} <i class="caret"></i></span>
               </a>
               <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                  <li class="dropdown-header text-center">Account</li>
                  <li>
                     <a href="{{ Route('profile') }}">
                        <i class="fa fa-user fa-fw pull-right"></i> Profile
                     </a>
                     <a href="{{ Route('setting') }}">
                        <i class="fa fa-cog fa-fw pull-right"></i> Settings
                     </a>
                  </li>
                  <li class="divider"></li>
                  <li>
                     <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                     </form>
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </nav>
</header>