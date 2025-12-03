<style>
  body, .navbar, .nav-content {
    margin: 0 ;
    padding: 0 !important;
  }
</style>

<div class="nav-content">
  <nav class="navbar" style="font-weight: bold; font-size: 20px; margin-bottom: 20px;">
    <div class="container-fluid" 
         style="background: linear-gradient(90deg, #4A00E0, #8E2DE2); padding: 10px; color: white;">
         
      <a class="navbar-brand" href="#" style="color: white;">
        <img src="" alt="" width="30" height="24" class="d-inline-block align-text-top">
        EdSched
      </a>

             {{-- Logout Button --}}
    <div style="padding:5px;">
        <a href="{{ route('logout') }}" 
           style="
              display:flex;
              align-items:center;
              justify-content:center;
              font-size: 14px;
              gap:10px;
              padding:10px 12px;
              color:#E74C3C;
              background:rgba(255, 0, 0, 0.08);
              border-radius:30px;
              font-weight:600;
              margin-top: 2px;
           ">
            <i class="fas fa-sign-out-alt"></i>
            Log Out
        </a>
    </div>
    </div>
  </nav>
</div>
