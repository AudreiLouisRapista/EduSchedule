<style>
  /* Hide the title text when collapsed */
/* Hide brand text when collapsed */
.sidebar-collapse .brand-text {
    display: none !important;
}

/* Center logo when collapsed */
.sidebar-collapse .sidebar-brand {
    justify-content: center !important;
}

/* Hide menu text when collapsed */
.sidebar-collapse .nav-sidebar .nav-link {
    justify-content: center;  /* Center icon */
}

.sidebar-collapse .nav-sidebar .nav-link i {
    margin-right: 0 !important; /* Remove gap */
}

/* Hide the text of menu items */
.sidebar-collapse .nav-sidebar .nav-link {
    font-size: 0 !important; 
}

.sidebar-collapse .nav-sidebar .nav-link i {
    font-size: 18px !important; /* KEEP ICON VISIBLE */
}
/* Collapse Logout text — keep icon only */

.sidebar-collapse a[ href*="logout" ] {
    justify-content: center !important;
    font-size: 0 !important;   /* hide text */
    padding-left: 0 !important;
    padding-right: 0 !important;
}

.sidebar-collapse a[ href*="logout" ] i {
    font-size: 20px !important; /* keep icon visible */
    margin-right: 0 !important;
}

h5{
  text-align: center;
  margin-bottom: 50px;
  transition: opacity 0.3s, visibility 0.3s;
}

.sidebar-collapse h5{
  opacity: 0;      /* Makes it invisible */
  visibility: hidden; /* Ensures it doesn’t take up space */
  margin-bottom: 0;
}
</style>







<aside id="mainSidebar" class="main-sidebar sidebar-light-primary elevation-4">
    
    <!-- Brand / User -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center py-3">
        <div class="brand-logo" 
             style="width:90px; height:80px; border-radius:50%; overflow:hidden;">
             
            <img src="{{ session('profile') 
                ? asset('storage/' . session('profile')) 
                : asset('dist/img/default.png') }}" 
                style="width:100%; height:100%; object-fit:cover;">
        </div>
    </div>
     <h5> EduSchedule</h5>
      <!-- Sidebar -->
      <div class="sidebar"  style="font-size:16px; font-weight:700; color:#999;">
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style= " padding-right:15px; gap:10px;">
            
          {{-- Dashboard --}}
          <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}"
                   style="
                     display:flex; 
                     align-items:center; 
                     gap:10px; 
                     padding:10px 15px;
                     border-radius:30px;
                     font-weight:500;
                     color:{{ Route::is('dashboard') ? '#fff' : '#333' }};
                     background:{{ Route::is('dashboard') ? '#6366F1' : 'transparent' }};
                     box-shadow:{{ Route::is('dashboard') ? '0 5px 12px rgba(99,102,241,0.4)' : 'none' }};
                   ">
                    <i class="fas fa-th-large"></i>
                    Dashboard
                </a>
            </li>

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
                     color:{{ Route::is('view_section') ? '#fff' : '#333' }};
                     background:{{ Route::is('view_section') ? '#6366F1' : 'transparent' }};
                     box-shadow:{{ Route::is('view_section') ? '0 5px 12px rgba(99,102,241,0.4)' : 'none' }};
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
                     color:{{ Route::is('view_schedule') ? '#fff' : '#333' }};
                     background:{{ Route::is('view_schedule') ? '#6366F1' : 'transparent' }};
                     box-shadow:{{ Route::is('view_schedule') ? '0 5px 12px rgba(99,102,241,0.4)' : 'none' }};
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
                     color:{{ Route::is('view_teachers') ? '#fff' : '#333' }};
                     background:{{ Route::is('view_teachers') ? '#6366F1' : 'transparent' }};
                     box-shadow:{{ Route::is('view_teachers') ? '0 5px 12px rgba(99,102,241,0.4)' : 'none' }};
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
                     color:{{ Route::is('view_subject') ? '#fff' : '#333' }};
                     background:{{ Route::is('view_subject') ? '#6366F1' : 'transparent' }};
                     box-shadow:{{ Route::is('view_subject') ? '0 5px 12px rgba(99,102,241,0.4)' : 'none' }};
                   ">
                    <i class="bi bi-journals"></i>
                    Subjects 
                </a>
            </li>

        </ul>
    </nav>

     


             {{-- Logout Button --}}
    <div style="padding:20px;">
        <a href="{{ route('logout') }}" 
           style="
              display:flex;
              align-items:center;
              justify-content:center;
              gap:10px;
              padding:12px 15px;
              color:#E74C3C;
              background:rgba(255,0,0,0.08);
              border-radius:30px;
              font-weight:600;
              margin-top: 250px;
           ">
            <i class="fas fa-sign-out-alt"></i>
            Log Out
        </a>
    </div>

           
          <!-- </ul>
        </nav> -->
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>