@extends('themes.main')

{{-- Define the page title that goes into the <title> tag in head.blade.php --}}
@section('title', 'Dashboard')

{{-- This section replaces the content-header section in the master layout --}}
@section('content_header')

<style>
 .grade2-box:hover,
 .grade1-box:hover {
    transform: scale(1.05); /* Slight zoom on hover */
    box-shadow: 0 10px 20px rgba(0,0,0,0.2); /* Stronger shadow */
    background: #f9f9ff; /* Slight background change */
    transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
  }
  
</style>
<div class="row" style="background-color: #ffffffff;  border-radius: 10px; margin-bottom: 20px;">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2" >
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>

                 


            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <!-- <li class="breadcrumb-item active">Dashboard v1</li> -->
                </ol>
            </div></div></div></div> 

@endsection



{{-- This section replaces the main content block --}}
@section('content')


<div class="row bg-white rounded mb-2 p-2 g-3">




    <div class="col-lg-3 col-6" >
        <div class="small-box " style="height: 165px;  border-radius: 10px; background: #fff;">
            <div class="inner">
                <div class="icon">
                    <i class="bi bi-person"></i>
                </div>
                <p style = "font-size: 15px;">Total Teachers</p>
               <div style="display: flex; align-items: baseline; gap: 8px;">
                    <h3 style="font-size: 40px; margin: 0; font-weight: 700;">{{$totalteachers}}</h3>
                    <span style="font-size: 15px;">Teachers in system</span>
                </div>
                 
                   <div style="
                        background:linear-gradient(135deg,#7b61ff,#9333ea);
                        width:35px;
                        height:35px;
                        margin-top: 20px;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center; 
                        color:#fff;
                        font-size:15px;
                        ">
                        <i class="bi bi-person"></i>
                     </div>

            </div>
        </div>
    </div>
    
   <div class="col-lg-3 col-6" >
        <div class="small-box " style="height: 165px; border-radius: 10px; background: #fff;">
            <div class="inner">
                 <div class="icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <p style = "font-size: 15px;">Total Assigned</p>
               <div style="display: flex; align-items: baseline; gap: 8px;">
                    <h3 style="font-size: 40px; margin: 0; font-weight: 700;">{{$assigned_teachers}}</h3>
                    <span style="font-size: 15px;">Assigned Teachers</span>
                 </div>
                   <div style="
                      background: linear-gradient(135deg, #22c55e, #16a34a);
                         width:35px;
                        height:35px;
                        margin-top: 20px;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        color:#fff;
                        font-size:15px;
                        ">
                           <i class="bi bi-person-check"></i>
                     </div>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6" >
        <div class="small-box " style="height: 165px; border-radius: 10px; background: #fff;">
            <div class="inner">
                <div class="icon">
                        <i class="bi bi-book-half"></i>
                </div>
                <p style = "font-size: 15px;">Total Classes</p>
               <div style="display: flex; align-items: baseline; gap: 8px;">
                    <h3 style="font-size: 40px; margin: 0; font-weight: 700;">{{$view_schedule}}</h3>
                    <span style="font-size: 15px;">Classes scheduled</span>
                 </div>
                   <div style="
                        background:linear-gradient(135deg,#7b61ff,#9333ea);
                        width:35px;
                        height:35px;
                        margin-top: 20px;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        color:#fff;
                        font-size:15px;
                        ">
                        <i class="bi bi-book-half"></i>
                     </div>

            </div>
        </div>
    </div>





    <div class="col-lg-3 col-6">
          <div class="small-box " style="height: 165px; border-radius: 10px; background: #fff;">
            <div class="inner">
                  <div class="icon">
                        <i class="bi bi-person-exclamation"></i>
                </div>
                <p style = "font-size: 15px;">Total Unassigned</p>
               <div style="display: flex; align-items: baseline; gap: 8px;">
                    <h3 style="font-size: 40px; margin: 0; font-weight: 700;">{{$unassigned_teachers}}</h3>
                    <span style="font-size: 15px;"> Unassigned Teachers</span>
                 </div>
                   <div style="
                       background: linear-gradient(135deg, #ff4d4d, #cc0000);
                        width:35px;
                        height:35px;
                        margin-top: 20px;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        color:#fff;
                        font-size:15px;
                        ">
                        <i class="bi bi-person-exclamation"></i>
                     </div>

            </div>
        </div>
    </div>

                <section class="content" style = "width: 700px;">
                    <div class="container-fluid" >
                        <div class="row g-3" >
                        <div class="col-12">
                            <div class="card" style= "border-radius: 10px; padding:20px;  ">
                                <h3 class="card-title" style = 'margin-left: 2px; margin-top: 10px; font-size: 25px;'>  Class Schedules</h3>
                                <p style = 'margin-left: 2px; margin-top: 2px'>Click on a grade to view teacher schedules</p>
    


<!-- GRADE 7-8  -->
<div style="display: flex; align-items: baseline; gap: 150px;">
                        <!-- GRADE 1 BOX -->
                            <div class="col-lg-3 col-6">
                                <div class="grade1-box"
                                    data-bs-toggle="modal"
                                    data-bs-target="#grade1 "
                                    style="cursor:pointer; height:120px; width:290px; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

                                    <div class="inner">
                                    
                                    <!-- Flex container for Grade and Icon -->
                                    <div style="display:flex; align-items:center; gap:90px;">
                                        <h3 style="font-size:30px; margin:0; font-weight:600;">Grade 7</h3>

                                        <!-- Icon beside Grade -->
                                        <div style="
                                           background: linear-gradient(135deg, #f8be67ff, #ff6a00);
                                            width:50px; height:50px;
                                            border-radius:30%; display:flex;
                                            align-items:center; justify-content:center;
                                            color:#fff; font-size:18px;">
                                        <i>{{$grade1Count}}</i>
                                        </div>
                                        
                                    </div>
                                        <p style="font-size:15px;"> {{$grade1Count}} Scheduled Classes</p>
                                    </div>
                                </div>
                            </div>


                    <!-- Modal -->
    <div class="modal fade" id="grade1" tabindex="-1" aria-labelledby="unassignedModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                         <div class="modal-content" style="width: 800px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="unassignedModalLabel">GRADE 7</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="card-body">
               <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th>Subject</th>
                                <th>Teachers</th>
                                <th>Date</th>
                                <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($view_grade1 as $grade)
                                <tr>
                                    <td>{{ $grade->sub_name }}</td>
                                       <td>{{ $grade->teacher_name }}</td>
                                    <td>{{ $grade->sub_date }}</td>
                                    <td>{{ $grade->sub_Stime }} - {{ $grade->sub_Etime }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                        </div>
    </div>


                <!-- GRADE 8 BOX -->
  <div class="col-lg-3 col-6">
    <div class="grade2-box"
         data-bs-toggle="modal"
         data-bs-target="#grade2"
         style="cursor:pointer; height:120px; width:290px; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

        <div class="inner">
            <!-- Flex container for Grade and Icon -->
            <div style="display:flex; align-items:center; gap:90px;">
                <h3 style="font-size:30px; margin:0; font-weight:600;">Grade 8</h3>

                <!-- Icon beside Grade -->
                <div style="
                    background:linear-gradient(135deg, #ab9bffff, #8200fbff);
                    width:50px; height:50px;
                    border-radius:30%; display:flex;
                    align-items:center; justify-content:center;
                    color:#fff; font-size:18px;">
                    <i>{{$grade2Count}}</i>
                </div>
            </div>

            <!-- Count -->
            <p style="font-size:15px;">{{$grade2Count}} Scheduled Classes</p>
        </div>
    </div>
  </div>              
                    <!-- Modal -->
               <div class="modal fade" id="grade2" tabindex="-1" aria-labelledby="unassignedModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 800px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="unassignedModalLabel">GRADE 8 </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="card-body">
               <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th>Subject</th>
                                <th>Teachers</th>
                                <th>Date</th>
                                <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($view_grade2 as $grade)
                                <tr>
                                    <td>{{ $grade->sub_name }}</td>
                                    <td>{{ $grade->teacher_name }}
                                    <td>{{ $grade->sub_date }}</td>
                                    <td>{{ $grade->sub_Stime }} - {{ $grade->sub_Etime }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                        </div>
    </div>

                
</div>



<!-- GRADE 9-10  -->
<div style="display: flex; align-items: baseline; gap: 150px;">

                        <!-- GRADE 3 BOX -->
                           <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="grade-box"
                                    data-bs-toggle="modal"
                                    data-bs-target="#unassignedModal"
                                    style="cursor:pointer; height:120px; width:290px; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

                                    <div class="inner">
                                    
                                    <!-- Flex container for Grade and Icon -->
                                    <div style="display:flex; align-items:center; gap:90px;">
                                        <h3 style="font-size:30px; margin:0; font-weight:600;">Grade 9</h3>

                                        <!-- Icon beside Grade -->
                                        <div style="
                                            background:linear-gradient(135deg, #8dff97ff, #00b941ff);
                                            width:50px; height:50px;
                                            border-radius:30%; display:flex;
                                            align-items:center; justify-content:center;
                                            color:#fff; font-size:18px;">
                                        <i>{{$grade3Count}}</i>
                                        </div>
                                        
                                    </div>
                                        <p style="font-size:15px;"> {{$grade3Count}} Scheduled Classes</p>
                                    </div>
                                </div>
                            </div>


                    <!-- Modal -->
                <div class="modal fade" id="unassignedModal" tabindex="-1" aria-labelledby="unassignedModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="unassignedModalLabel">Unassigned Courses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your content here, e.g., list of courses -->
                            List of courses that need assignment.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
 

                <!-- GRADE 10 BOX -->
<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="grade-box"
         data-bs-toggle="modal"
         data-bs-target="#unassignedModal"
         style="cursor:pointer; height:120px; width:290px; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

        <div class="inner">
            <!-- Flex container for Grade and Icon -->
            <div style="display:flex; align-items:center; gap:90px;">
                <h3 style="font-size:30px; margin:0; font-weight:600;">Grade 10</h3>

                <!-- Icon beside Grade -->
                <div style="
                    background:linear-gradient(135deg, #bc78ffff, #0800fcff);
                    width:50px; height:50px;
                    border-radius:30%; display:flex;
                    align-items:center; justify-content:center;
                    color:#fff; font-size:18px;">
                    <i>{{$grade4Count}}</i>
                </div>
            </div>

            <!-- Count -->
            <p style="font-size:15px;">{{$grade4Count}} Scheduled Classes</p>
        </div>
    </div>
 </div>
 

                              
                    <!-- Modal -->
                <div class="modal fade" id="unassignedModal" tabindex="-1" aria-labelledby="unassignedModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="unassignedModalLabel">Unassigned Courses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your content here, e.g., list of courses -->
                            List of courses that need assignment.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
</div>
   


<!-- GRADE 11-12  -->
<div style="display: flex; align-items: baseline; gap: 150px;">
                        <!-- GRADE 5 BOX -->
                            <div class="col-lg-3 col-6">
                                <div class="grade-box"
                                    data-bs-toggle="modal"
                                    data-bs-target="#unassignedModal"
                                    style="cursor:pointer; height:120px; width:290px; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

                                    <div class="inner">
                                    
                                    <!-- Flex container for Grade and Icon -->
                                    <div style="display:flex; align-items:center; gap:90px;">
                                        <h3 style="font-size:30px; margin:0; font-weight:600;">Grade 11</h3>

                                        <!-- Icon beside Grade -->
                                        <div style="
                                            background:linear-gradient(135deg, #fce15bff, #caa306ff);
                                            width:50px; height:50px;
                                            border-radius:30%; display:flex;
                                            align-items:center; justify-content:center;
                                            color:#fff; font-size:18px;">
                                        <i>{{$grade5Count}}</i>
                                        </div>
                                        
                                    </div>
                                        <p style="font-size:15px;"> {{$grade5Count}} Scheduled Classes</p>
                                    </div>
                                </div>
                            </div>


                    <!-- Modal -->
                <div class="modal fade" id="unassignedModal" tabindex="-1" aria-labelledby="unassignedModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="unassignedModalLabel">Unassigned Courses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your content here, e.g., list of courses -->
                            List of courses that need assignment.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
 

                <!-- GRADE 6 BOX -->
 <div class="col-lg-3 col-6">
    <div class="grade-box"
         data-bs-toggle="modal"
         data-bs-target="#unassignedModal"
         style="cursor:pointer; height:120px; width:290px; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

        <div class="inner">
            <!-- Flex container for Grade and Icon -->
            <div style="display:flex; align-items:center; gap:90px;">
                <h3 style="font-size:30px; margin:0; font-weight:600;">Grade 12</h3>

                <!-- Icon beside Grade -->
                <div style="
                    background:linear-gradient(135deg, #f67676ff, #f20000ff);
                    width:50px; height:50px;
                    border-radius:30%; display:flex;
                    align-items:center; justify-content:center;
                    color:#fff; font-size:18px;">
                    <i>{{$grade6Count}}</i>
                </div>
            </div>

            <!-- Count -->
            <p style="font-size:15px;">{{$grade6Count}} Scheduled Classes</p>
        </div>
    </div>
 </div>

                              
                    <!-- Modal -->
                <div class="modal fade" id="unassignedModal" tabindex="-1" aria-labelledby="unassignedModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="unassignedModalLabel">Unassigned Courses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your content here, e.g., list of courses -->
                            List of courses that need assignment.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
</div>

            </div>
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
</section>

<!-- <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
             
</div> -->






  
@endsection

{{-- Inject the dashboard-specific scripts --}}
@section('scripts')
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
@endsection