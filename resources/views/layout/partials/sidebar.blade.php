<aside class="main-sidebar elevation-4 sidebar-light-primary style="width:260px; background:#fff; border-right:1px solid #ffffffff; min-height:100vh;">

    {{-- Brand / User Section --}}
    <div class="text-center py-4">
        <div style="
            width:60px; 
            height:60px; 
            border-radius:50%; 
            overflow:hidden; 
            margin:auto;
        ">
          @if(session('profile'))
    <img src="{{ asset('storage/' . session('profile')) }}"
         class="img-circle elevation-2"
         alt="User Image"
         style="width:100%; height:100%; object-fit:cover;">
          @else
              <img src="{{ asset('dist/img/default.png') }}"
                  class="img-circle elevation-2"
                  alt="Default Image">
          @endif

        </div>
        <h5 class="mt-3 mb-0 fw-bold" style="color:#333;">EduSchedule</h5>
        <small style="color:gray;">{{ session ('role')}}</small>
    </div>

      <!-- Sidebar -->
      <div class="sidebar  style="font-size:12px; font-weight:700; color:#999;">
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false style= padding-left:15px; padding-right:15px; gap:10px;">
            
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
                <a href="{{ route('section') }}"
                   class="nav-link {{ Route::is('section') ? 'active' : '' }}"
                   style="
                     display:flex; 
                     align-items:center; 
                     gap:10px; 
                     padding:10px 15px;
                     border-radius:30px;
                     font-weight:500;
                     color:{{ Route::is('section') ? '#fff' : '#333' }};
                     background:{{ Route::is('section') ? '#6366F1' : 'transparent' }};
                     box-shadow:{{ Route::is('section') ? '0 5px 12px rgba(99,102,241,0.4)' : 'none' }};
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