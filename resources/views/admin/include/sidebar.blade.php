<aside class="left-side sidebar-offcanvas">
   <section class="sidebar">
      <!-- Sidebar user panel -->
      <ul class="sidebar-menu">
         <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
            <a href="{{ Route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'category' ? 'active' : '' }}">
            <a href="{{ Route('category.index') }}">
            <i class="fa fa-list"></i> <span>Categories</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'question' ? 'active' : '' }}">
            <a href="{{ Route('question.index') }}">
            <i class="fa fa-question"></i> <span>Questions</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'tutorial' ? 'active' : '' }}">
            <a href="{{ Route('tutorial') }}">
            <i class="fa fa-book"></i> <span>Tutorial</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'setting' ? 'active' : '' }}">
            <a href="{{ Route('setting') }}">
            <i class="fa fa-cog"></i> <span>Settings</span>
            </a>
         </li>
         <li class="{{ Request::segment(2) === 'notification' ? 'active' : '' }}">
            <a href="{{ Route('notification') }}">
            <i class="fa fa-bell"></i> <span>Push Notification</span>
            </a>
         </li>
      </ul>
   </section>
   <!-- /.sidebar -->
</aside>