<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    {{-- <img src="{{ asset('templateadmin/images/avatar/1.png') }}" width="20" alt=""> --}}
                    <div class="header-info ms-3">
                        <span class="font-w600 ">Hi,<b>Selamat Datang</b></span>
                        <small class="text-left font-w400">{{ Auth::user() ? Auth::user()->name : '' }}</small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ url('/change-password') }}" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="ms-2">Ganti Password </span>
                    </a>

                    <a href="{{ url('/logout') }}" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span class="ms-2">Logout </span>
                    </a>
                </div>
            </li>

            <li>
                <a class="" {{ Request::segment(1)=='dashboard' ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                    <i class="flaticon-024-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

           

            @if(Auth::user()->role == 'mps')
           
            <li>
                <a class="{{ Request::segment(1)=='daily-work' ? 'active' : '' }}"
                    href="{{ url('/daily-work') }}">
                    <i class="fa-solid fa-helmet-safety fw-bold"></i>
                    <span class="nav-text">Daily Work</span>
                </a>
            </li>
             <li>
                <a class="{{ Request::segment(1)=='management-users' ? 'active' : '' }}"
                    href="{{ url('/management-users') }}">
                    <i class="fa-solid fa-user fw-bold"></i>
                    <span class="nav-text">Management Users</span>
                </a>
            </li>
            @endif

            <li>
                <a class="{{ Request::segment(1)=='pengaturan' ? 'active' : '' }}" href="{{ url('/pengaturan') }}">
                    <i class="fa-solid fa-gear fw-bold"></i>
                    <span class="nav-text">Pengaturan</span>
                </a>
            </li>
        </ul>
        <div class="copyright">
            <p>Copyright ©  <a href="#" target="_blank">Integrated Terminal Balongan</a> {{
            date('Y') }}</p>
            {{-- <p><strong>{{ config('dz.name') }} Admin Dashboard</strong> © 2023 All Rights Reserved</p> --}}
            {{-- <p class="fs-12">Made with <span class="heart"></span> by Itgenic</p> --}}
        </div>
    </div>
</div>