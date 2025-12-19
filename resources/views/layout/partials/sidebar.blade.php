<style>
    /* 1. MAIN CONTAINER: Full height flexbox */
    .main-sidebar {
        display: flex !important;
        flex-direction: column !important;
        height: 100vh !important;
        background: linear-gradient(135deg, #2427e3ff, #6b22baff) !important;
        overflow: hidden !important;
        /* Prevents the whole sidebar from scrolling */
    }

    /* 2. ZONE 1 (Boundary): Scrollable Menu Area */
    .main-sidebar .sidebar {
        flex: 1 !important;
        /* Fills available space */
        overflow-y: auto !important;
        /* Only this part scrolls */
        display: flex !important;
        flex-direction: column !important;
        padding-bottom: 20px !important;
        background: transparent !important;
    }

    /* 3. ZONE 2: Locked Logout Container */
    .logout-container {
        flex-shrink: 0 !important;
        /* Prevents button from being squashed */
        width: 100%;
        padding: 15px 10px;
        background: rgba(0, 0, 0, 0.1);
        /* Subtle visual boundary line */
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 99;
    }

    .logout-btn-styled {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 90%;
        margin: 0 auto;
        padding: 12px;
        color: #fff !important;
        background: #ff4757;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(255, 71, 87, 0.3);
        transition: 0.3s ease;
    }

    /* --- Collapsed State Fixes --- */
    .sidebar-collapse .logout-text {
        display: none !important;
    }

    .sidebar-collapse .logout-btn-styled {
        width: 45px;
        height: 45px;
        padding: 0;
        border-radius: 50%;
        /* Circle icon when collapsed */
    }

    /* Restore on Hover while Collapsed */
    .sidebar-collapse .main-sidebar:hover .logout-btn-styled {
        width: 90%;
        border-radius: 12px;
        padding-left: 15px;
        justify-content: flex-start;
    }

    .sidebar-collapse .main-sidebar:hover .logout-text {
        display: inline !important;
    }

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

    /* Hide menu text when collapsed - Keep icons left-alignedx` and prevent vertical movement */
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

    <div class="sidebar-brand d-flex align-items-center justify-content-center py-3">
        <div class="brand-logo"
            style="width:50px; height:50px; border-radius:50%; overflow:hidden; box-shadow:rgba(88, 10, 121, 0.847)">
            <img src="{{ session('profile') ? asset('storage/' . session('profile')) : asset('dist/img/default.png') }}"
                style="width:100%; height:100%; object-fit:cover;">
        </div>
    </div>
    <h5>
        {{ session('user_role') }}
        <hr style="border-top: 3px solid rgb(255, 255, 255); margin-top:10px;">
    </h5>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false" style="padding-right:15px; gap:10px;">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                        style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:30px; font-weight:500; color:{{ Route::is('admin.dashboard') ? '#333' : '#fff' }}; background:{{ Route::is('admin.dashboard') ? '#fff' : 'transparent' }}; box-shadow:{{ Route::is('admin.dashboard') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                </li>

                {{-- Admin Profile --}}
                <li class="nav-item">
                    <a href="{{ route('admin_profile') }}"
                        class="nav-link {{ Route::is('admin_profile') ? 'active' : '' }}"
                        style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:30px; font-weight:500; color:{{ Route::is('admin_profile') ? '#333' : '#fff' }}; background:{{ Route::is('admin_profile') ? '#fff' : 'transparent' }}; box-shadow:{{ Route::is('admin_profile') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};">
                        <i class="fas fa-user-cog"></i> Admin Profile
                    </a>
                </li>

                {{-- Teachers Dropdown --}}
                @php
                    $teacher_parent_active = Route::is('view_teachers') || Route::is('admin_teacher_loads');
                    $active_bg_style =
                        'background: #fff; color: #333; box-shadow: 0 5px 12px rgba(99, 101, 241, 0.67);';
                    $inactive_style = 'background: transparent; color: #fff; box-shadow: none;';
                    $sub_active_style = 'background: rgba(255, 255, 255, 0.3); color: #333;';
                @endphp
                <li class="nav-item">
                    <a href="#teachersCollapse" data-bs-toggle="collapse" role="button"
                        class="nav-link {{ $teacher_parent_active ? 'active' : '' }}"
                        style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:30px; font-weight:500; {{ $teacher_parent_active ? $active_bg_style : $inactive_style }}">
                        <i class="fas fa-user-tie"></i> Teachers <i class="fas fa-caret-down ms-auto"></i>
                    </a>
                    <div id="teachersCollapse" class="collapse {{ $teacher_parent_active ? 'show' : '' }}"
                        style="margin-left: 15px;">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('view_teachers') }}" class="nav-link"
                                    style="display:block; padding:8px 0 8px 10px; font-weight:400; border-radius:15px; {{ Route::is('view_teachers') ? $sub_active_style : $inactive_style }}">View
                                    All Teachers</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('teacher_loads') }}" class="nav-link"
                                    style="display:block; padding:8px 0 8px 10px; font-weight:400; border-radius:15px; {{ Route::is('teacher_loads') ? $sub_active_style : $inactive_style }}">Teacher
                                    Load</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Section Dropdown --}}
                @php $section_parent_active = Route::is('view_section') || Route::is('section_loads'); @endphp
                <li class="nav-item">
                    <a href="#sectionCollapse" data-bs-toggle="collapse" role="button"
                        class="nav-link {{ $section_parent_active ? 'active' : '' }}"
                        style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:30px; font-weight:500; {{ $section_parent_active ? $active_bg_style : $inactive_style }}">
                        <i class="bi bi-house-add-fill"></i> Section <i class="fas fa-caret-down ms-auto"></i>
                    </a>
                    <div id="sectionCollapse" class="collapse {{ $section_parent_active ? 'show' : '' }}"
                        style="margin-left: 15px;">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('view_section') }}" class="nav-link"
                                    style="display:block; padding:8px 0 8px 10px; font-weight:400; border-radius:15px; {{ Route::is('view_section') ? $sub_active_style : $inactive_style }}">View
                                    All Section</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('section_loads') }}" class="nav-link"
                                    style="display:block; padding:8px 0 8px 10px; font-weight:400; border-radius:15px; {{ Route::is('section_loads') ? $sub_active_style : $inactive_style }}">Section
                                    Load</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Schedules --}}
                <li class="nav-item">
                    <a href="{{ route('view_schedule') }}"
                        class="nav-link {{ Route::is('view_schedule') ? 'active' : '' }}"
                        style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:30px; font-weight:500; color:{{ Route::is('view_schedule') ? '#333' : '#fff' }}; background:{{ Route::is('view_schedule') ? '#fff' : 'transparent' }}; box-shadow:{{ Route::is('view_schedule') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};">
                        <i class="bi bi-calendar4-range"></i> Schedules
                    </a>
                </li>

                {{-- Subjects --}}
                <li class="nav-item">
                    <a href="{{ route('view_subject') }}"
                        class="nav-link {{ Route::is('view_subject') ? 'active' : '' }}"
                        style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:30px; font-weight:500; color:{{ Route::is('view_subject') ? '#333' : '#fff' }}; background:{{ Route::is('view_subject') ? '#fff' : 'transparent' }}; box-shadow:{{ Route::is('view_subject') ? '0 5px 12px rgba(99, 101, 241, 0.67)' : 'none' }};">
                        <i class="bi bi-journals"></i> Subjects
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="logout-container">
        <a href="{{ route('logout') }}" class="logout-btn-styled">
            <i class="bi bi-box-arrow-left"></i>
            <span class="logout-text">Logout</span>
        </a>
    </div>

</aside>
