    <!-- sidebar panel -->
    <div class="sidebar-panel offscreen-left">
      <div class="brand">
        <!-- toggle small sidebar menu -->
        <a href="javascript:;" class="toggle-apps hidden-xs" data-toggle="quick-launch">
          <i class="icon-grid"></i>
        </a>
        <!-- /toggle small sidebar menu -->
        <!-- toggle offscreen menu -->
        <div class="toggle-offscreen">
          <a href="javascript:;" class="visible-xs hamburger-icon" data-toggle="offscreen" data-move="ltr">
            <span></span>
            <span></span>
            <span></span>
          </a>
        </div>
        <!-- /toggle offscreen menu -->
        <!-- logo -->
        <a class="brand-logo">
          <span>ETHELON</span>
        </a>
        <a href="#" class="small-menu-visible brand-logo">R</a>
        <!-- /logo -->
      </div>
        <ul class="quick-launch-apps hide" id="smenu">
        <li>
          <a href="apps-gallery.html">
            <span class="app-icon bg-danger text-white">
            G
            </span>
            <span class="app-title">Gallery</span>
          </a>
        </li>
        <li>
          <a href="apps-messages.html">
            <span class="app-icon bg-success text-white">
            M
            </span>
            <span class="app-title">Messages</span>
          </a>
        </li>
        <li>
          <a href="apps-social.html">
            <span class="app-icon bg-primary text-white">
            S
            </span>
            <span class="app-title">Social</span>
          </a>
        </li>
        <li>
          <a href="apps-travel.html">
            <span class="app-icon bg-info text-white">
            T
            </span>
            <span class="app-title">Travel</span>
          </a>
        </li>
      </ul>
      <!-- main navigation -->
      <nav role="navigation">
        <ul class="nav">
          <!-- dashboard -->
          <li>
            <a href="{{ url('/') }}">
              <i class="icon-compass"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <!-- /dashboard -->
          <!-- customizer -->
          <li>
            <a href="{{ url('/activity') }}">
              <i class="icon-equalizer"></i>
              <span>Event</span>
            </a>
          </li>
          <!-- /customizer -->
        </ul>
      </nav>
      <!-- /main navigation -->
    </div>
    <!-- /sidebar panel -->