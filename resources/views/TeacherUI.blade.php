@extends('themes.teachers')

@section('content_header')
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- LEFT SIDE: PROFILE (col-md-3) -->
      <div class="col-md-3">

        <!-- Profile Image Card -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile text-center">
            <img class="profile-user-img img-fluid img-circle elevation-2"
                 src="{{ asset('storage/' . session('profile')) }}"  
                 style="width:100px; height:100px; object-fit:cover;">
         
            <h3 class="profile-username">{{ session('name') }}</h3>
            <p class="text-muted">{{ session('role') }}</p>
            <div class="card-header" >
            <h3 class="card-title"> <strong>About Me</strong></h3>
          </div>
          <div class="card-body">
            <strong>Email</strong>
            <p class="text">{{ session('email') }}</p>
            <hr>

            <strong>Age</strong>
            <p class="text">{{ session('age') }}</p>
            <hr>

            <strong> Gender</strong>
            <p class="text-muted">
              {{ session ('gender')}}
            </p>
            <hr>
            

            <strong> Phone Number</strong>
            <p class="text-muted">{{session ('phone')}}</p>
          </div>
        </div>
      </div>
      </div>
      <!-- END LEFT SIDE -->


      <!-- RIGHT SIDE: TABLE (col-md-9) -->
      <div class="col-md-9">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">You're Schedule</h3>
          </div>

          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Subject Name</th>
                  <th>Grade Level</th>
                  <th>Subject Date</th>
                  <th>Subject Time</th>
                  <th>Section</th>
                </tr>
              </thead>

               <tbody>
                              @foreach ($teacher_ui as $teacher)
                                    <tr>
                                        <td>{{ $teacher->subject_name }}</td>
                                        <td></td>
                                        <td>{{ $teacher->sub_date }}</td>
                                       <td>{{ date('g:i A', strtotime($teacher->sub_Stime)) }} - {{ date('g:i A', strtotime($teacher->sub_Etime)) }}</td>

                                        


                                       
                                    </tr>
                                @endforeach

             
            </table>
          </div>
        </div>

      </div>
      <!-- END RIGHT SIDE -->

    </div>
  </div>
</section>
@endsection
