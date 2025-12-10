<style>
    /* Hide the title text when collapsed */
    /* Hide brand text when collapsed */
    .sidebar-collapse .brand-text {
        display: none !important;

    }

    /* Center logo when collapsed - Ensure no vertical shift */
    .sidebar-collapse .sidebar-brand {
        justify-content: center !important;

        /* Add fixed height to prevent shifting */
        /* height: auto; Or match expanded height if needed */
    }

    /* Hide menu text when collapsed - Keep icons left-aligned and prevent vertical movement */
    .sidebar-collapse .nav-sidebar .nav-link {
        justify-content: flex-start;
        /* Keeps icons aligned to the left */
        /* Ensure consistent height/padding to prevent "moving up" */
        min-height: 40px;
        /* Match or exceed expanded height to avoid collapse */
        padding: 10px 15px;
        /* Keep padding consistent */
    }

    .sidebar-collapse .nav-sidebar .nav-link i {
        margin-right: 0 !important;
        /* Remove gap */
        font-size: 18px !important;
        /* KEEP ICON VISIBLE */
    }

    /* Hide the text of menu items in collapsed state */
    .sidebar-collapse .nav-sidebar .nav-link {
        font-size: 0 !important;

    }

    /* On hover over the entire sidebar, show all menu item texts */
    .sidebar-collapse .main-sidebar:hover .nav-sidebar .nav-link {
        font-size: 16px !important;
        /* Restore text size on sidebar hover */
    }

    .sidebar-collapse .main-sidebar:hover .nav-sidebar .nav-link i {
        margin-right: 10px !important;
        /* Restore gap on sidebar hover */
    }

    /* Collapse Logout text — keep design consistent, only hide text */
    .sidebar-collapse a[href*="logout"] .logout-text {
        font-size: 0 !important;
        /* hide text only */
    }

    .sidebar-collapse .main-sidebar:hover a[href*="logout"] .logout-text {
        font-size: 16px !important;
        /* restore text size */

    }

    /* Position the logout button container at the bottom in collapsed state */
    .sidebar-collapse .sidebar>div:last-child {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        /* margin-top: 0 !important; Remove the 250px margin to stick to bottom */
        padding: 20px;
        /* Keep padding for spacing */
    }

    /* Reduce the sidebar shadow */
    .main-sidebar.sidebar-light-primary.elevation-4 {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
        /* Smaller, subtler shadow */
    }

    /* Change sidebar background to a gradient similar to the active color (#6366F1) */
    .main-sidebar {
        background: linear-gradient(135deg, #2427e3ff, #6b22baff) !important;
        /* Gradient based on active color */
        /* Removed: border-radius: 0 20px 20px 0 !important; to remove rounded corners */

    }

    /* Ensure the sidebar inner elements blend with the gradient */
    .main-sidebar .sidebar {
        background: transparent !important;
        /* Make inner sidebar transparent to show gradient */
    }



    h5 {
        text-align: center;
        margin-bottom: 50px;
        transition: opacity 0.3s, visibility 0.3s;
        color: #fff;
        /* Suggested: White text for role on gradient background */
    }

    .sidebar-collapse h5 {
        opacity: 0;
        /* Makes it invisible */
        visibility: hidden;
        /* Ensures it doesn’t take up space */
        margin-bottom: 50px;
        /* Keep the gap even when hidden */

    }

    /* On hover over the entire sidebar, show the role (h5) */
    .sidebar-collapse .main-sidebar:hover h5 {
        opacity: 1;
        /* Makes it visible on sidebar hover */
        visibility: visible;
        /* Show it */
    }
</style>

<aside id="mainSidebar" class="main-sidebar sidebar-light-primary elevation-4">

    <!-- Brand / User -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center py-3">
        <div class="brand-logo"
            style="width:80px; height:80px; border-radius:50%; overflow:hidden; box-shadow:rgba(88, 10, 121, 0.847)">

            <img src="{{ session('profile') ? asset('storage/' . session('profile')) : asset('dist/img/default.png') }}"
                style="width:100%; height:100%; object-fit:cover;">
        </div>
    </div>
    <h5>
        {{ session('user_role') }}
    </h5>
    <!-- Sidebar -->
    <div class="sidebar" style="font-size:16px; font-weight:700; color:#999;">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false" style= " padding-right:15px; gap:10px;">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                        style="
                     display:flex; 
                     align-items:center; 
                     gap:10px; 
                     padding:10px 15px;
                     border-radius:30px;
                     font-weight:500;
                     color:{{ Route::is('admin.dashboard') ? '#333' : '#fff' }}; 
                     background:{{ Route::is('admin.dashboard') ? '#fff' : 'transparent' }}; 
                     box-shadow:{{ Route::is('admin.dashboard') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};
                   ">
                        <i class="fas fa-th-large"></i>
                        Dashboard
                    </a>
                </li>

                {{-- adpin profile --}}
                <li class="nav-item">
                    <a href="{{ route('admin_profile') }}"
                        class="nav-link {{ Route::is('admin_profile') ? 'active' : '' }}"
                        style="
                     display:flex; 
                     align-items:center; 
                     gap:10px; 
                     padding:10px 15px;
                     border-radius:30px;
                     font-weight:500;
                     color:{{ Route::is('admin_profile') ? '#333' : '#fff' }}; /* Suggested: Dark text for active, white for inactive */
                     background:{{ Route::is('admin_profile') ? '#fff' : 'transparent' }}; /* Changed active to white */
                     box-shadow:{{ Route::is('admin_profile') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};
                   ">
                        <i class="fas fa-user-cog"></i>
                        Admin Profile
                    </a>

                    {{-- Sections  --}}
                <li class="nav-item">
                    <a href="{{ route('view_section') }}"
                        class="nav-link {{ Route::is('view_section') ? 'active' : '' }}"
                        style="
                     display:flex; 
                     align-items:center; 
                     gap:10px; 
                     padding:10px 15px;
                     border-radius:30px;
                     font-weight:500;
                     color:{{ Route::is('view_section') ? '#333' : '#fff' }}; /* Suggested: Dark text for active, white for inactive */
                     background:{{ Route::is('view_section') ? '#fff' : 'transparent' }}; /* Changed active to white */
                     box-shadow:{{ Route::is('view_section') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};
                   ">
                        <i class="far fa-calendar-alt"></i>
                        Sections
                    </a>
                </li>

                {{-- Schedules  --}}
                <li class="nav-item">
                    <a href="{{ route('view_schedule') }}"
                        class="nav-link {{ Route::is('view_schedule') ? 'active' : '' }}"
                        style="
                     display:flex; 
                     align-items:center; 
                     gap:10px; 
                     padding:10px 15px;
                     border-radius:30px;
                     font-weight:500;
                     color:{{ Route::is('view_schedule') ? '#333' : '#fff' }}; /* Suggested: Dark text for active, white for inactive */
                     background:{{ Route::is('view_schedule') ? '#fff' : 'transparent' }}; /* Changed active to white */
                     box-shadow:{{ Route::is('view_schedule') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};
                   ">
                        <i class="bi bi-calendar4-range"></i>
                        Schedules
                    </a>
                </li>

                {{-- Teachers --}}
                <li class="nav-item">
                    <a href="{{ route('view_teachers') }}"
                        class="nav-link {{ Route::is('view_teachers') ? 'active' : '' }}"
                        style="
                     display:flex; 
                     align-items:center; 
                     gap:10px; 
                     padding:10px 15px;
                     border-radius:30px;
                     font-weight:500;
                     color:{{ Route::is('view_teachers') ? '#333' : '#fff' }}; /* Suggested: Dark text for active, white for inactive */
                     background:{{ Route::is('view_teachers') ? '#fff' : 'transparent' }}; /* Changed active to white */
                     box-shadow:{{ Route::is('view_teachers') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};
                   ">
                        <i class="fas fa-user-tie"></i>
                        Teachers
                    </a>
                </li>

                {{-- Subjects  --}}
                <li class="nav-item">
                    <a href="{{ route('view_subject') }}"
                        class="nav-link {{ Route::is('view_subject') ? 'active' : '' }}"
                        style="
                     display:flex; 
                     align-items:center; 
                     gap:10px; 
                     padding:10px 15px;
                     border-radius:30px;
                     font-weight:500;
                     color:{{ Route::is('view_subject') ? '#333' : '#fff' }}; /* Suggested: Dark text for active, white for inactive */
                     background:{{ Route::is('view_subject') ? '#fff' : 'transparent' }}; /* Changed active to white */
                     box-shadow:{{ Route::is('view_subject') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};
                   ">
                        <i class="bi bi-journals"></i>
                        Subjects
                    </a>
                </li>



                {{-- Student  --}}
                <li class="nav-item">
                    <a href="{{ route('view_student') }}"
                        class="nav-link {{ Route::is('view_student') ? 'active' : '' }}"
                        style="
                     display:flex; 
                     align-items:center; 
                     gap:10px; 
                     padding:10px 15px;
                     border-radius:30px;
                     font-weight:500;
                     color:{{ Route::is('view_student') ? '#333' : '#fff' }}; /* Suggested: Dark text for active, white for inactive */
                     background:{{ Route::is('view_student') ? '#fff' : 'transparent' }}; /* Changed active to white */
                     box-shadow:{{ Route::is('view_student') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};
                   ">
                        <i class="bi bi-person-add"></i>
                        Student
                    </a>
                </li>

            </ul>
        </nav>




        {{-- Logout Button --}}
        <div style="padding:5px;">
            <a href="{{ route('logout') }}"
                style="
              display:flex;
              align-items:center;
              justify-content:center;
              gap:5px;
              padding:10px;
              color:#fff; 
              background:rgba(121, 10, 10, 0.5);
              border-radius:30px;
              font-weight:600;
              margin-top: 150px;
           ">
                <i class="fas fa-sign-out-alt"></i>
                <span class="logout-text">Log Out</span>
            </a>
        </div>


        <!-- </ul>
        </nav> -->
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
