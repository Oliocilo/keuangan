<nav class="navbar header-navbar pcoded-header">
  <div class="navbar-wrapper">

      <div class="navbar-logo">
          <a class="mobile-menu" id="mobile-collapse" href="#!">
              <i class="feather icon-menu"></i>
          </a>
          <a href="<?=base_url('home')?>" class="text-center">
              <h3 class="brand-text font-weight-bold">DuitQu</h3>
          </a>
          <a class="mobile-options">
              <i class="feather icon-more-horizontal"></i>
          </a>
      </div>

      <div class="navbar-container container-fluid">
          <ul class="nav-left">
              <li class="header-search">
                  <div class="main-search morphsearch-search">
                      <div class="input-group">
                          <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                          <input type="text" class="form-control">
                          <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                      </div>
                  </div>
              </li>
              <li>
                  <a href="#!" onclick="javascript:toggleFullScreen()">
                      <i class="feather icon-maximize full-screen"></i>
                  </a>
              </li>
          </ul>
          <ul class="nav-right">
              <li class="user-profile header-notification">
                <div class="dropdown-primary dropdown">
                    <div class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=base_url('assets')?>/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                        <span><?=$this->session->userdata('nama')?></span>
                        <i class="feather icon-chevron-down"></i>
                    </div>
                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <li onclick="location.href='<?=base_url('akun')?>'">
                            <i class="feather icon-user"></i> Profile
                        </li>
                        <li onclick="location.href='<?=base_url('logoutAdmin')?>'">
                            <i class="feather icon-log-out"></i> Logout
                        </li>
                    </ul>
                </div>
              </li>
          </ul>
      </div>
  </div>
</nav>