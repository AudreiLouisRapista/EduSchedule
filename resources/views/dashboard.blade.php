@extends('themes.main')

{{-- Define the page title that goes into the <title> tag in head.blade.php --}}
@section('title', 'Dashboard')

{{-- This section replaces the content-header section in the master layout --}}
@section('content_header')

    <style>
        .grade6-box:hover,
        .grade5-box:hover,
        .grade4-box:hover,
        .grade3-box:hover,
        .grade2-box:hover,
        .grade1-box:hover {
            transform: scale(1.05);
            /* Slight zoom on hover */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            /* Stronger shadow */
            background: #f9f9ff;
            /* Slight background change */
            transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
        }
    </style>
    <div class="col" style="background-color: #ffffffff;  border-radius: 10px; margin-bottom: 20px;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>

                    {{-- <form method="POST" action="{{ route('system.setSchoolYear') }}" class="d-flex mb-3">
                        @csrf
                        <select name="filter_schoolyear_name" class="form-select me-2">
                            <option value="">-- Select School Year --</option>
                            @foreach ($schoolYears as $sy)
                                <option value="{{ $sy->schoolyear_name }}"
                                    {{ session('system_schoolyear') == $sy->schoolyear_name ? 'selected' : '' }}>
                                    {{ $sy->schoolyear_name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Select</button>
                    </form> --}}






                </div>
            </div>
        </div>

    @endsection



    {{-- This section replaces the main content block --}}
    @section('content')


        <div class="row bg-white rounded mb-2 p-2 g-0">
            <div class="col-lg-3 col-6">
                <div class="small-box" style="height: 165px; border-radius: 10px; background: #fff; margin: 0 auto;">
                    <div class="inner">

                        <p style="font-size: 15px;">Total Teachers</p>
                        <div style="display: flex; align-items: baseline; gap: 8px;">
                            <h3 style="font-size: 40px; margin: 0; font-weight: 700;">{{ $totalteachers }}</h3>
                            <span style="font-size: 15px;">Teachers in the system</span>
                        </div>
                        <div
                            style="
                    background: linear-gradient(135deg, #7b61ff, #9333ea);
                    width: 35px;
                    height: 35px;
                    margin-top: 20px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    font-size: 15px;
                    position: absolute;
                ">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box" style="height: 165px; border-radius: 10px; background: #fff; margin: 0 auto;">
                    <div class="inner">

                        <p style="font-size: 15px;">Total Assigned</p>
                        <div style="display: flex; align-items: baseline; gap: 8px;">
                            <h3 style="font-size: 40px; margin: 0; font-weight: 700;">{{ $assigned_teachers }}</h3>
                            <span style="font-size: 15px;">Assigned Teachers</span>
                        </div>
                        <div
                            style="
                    background: linear-gradient(135deg, #22c55e, #16a34a);
                    width: 35px;
                    height: 35px;
                    margin-top: 20px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    font-size: 15px;
                ">
                            <i class="bi bi-person-check"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box" style="height: 165px; border-radius: 10px; background: #fff; margin: 0 auto;">
                    <div class="inner">

                        <p style="font-size: 15px;">Total Classes</p>
                        <div style="display: flex; align-items: baseline; gap: 8px;">
                            <h3 style="font-size: 40px; margin: 0; font-weight: 700;">{{ $view_schedule }}</h3>
                            <span style="font-size: 15px;">Classes scheduled</span>
                        </div>
                        <div
                            style="
                    background: linear-gradient(135deg, #7b61ff, #9333ea);
                    width: 35px;
                    height: 35px;
                    margin-top: 20px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    font-size: 15px;
                ">
                            <i class="bi bi-book-half"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box" style="height: 165px; border-radius: 10px; background: #fff; margin: 0 auto;">
                    <div class="inner">
                        <p style="font-size: 15px;">Total Unassigned Teachers</p>
                        <div style="display: flex; align-items: baseline; gap: 8px;">
                            <h3 style="font-size: 40px; margin: 0; font-weight: 700;">{{ $unassigned_teachers }}</h3>
                            <span style="font-size: 15px;">Unassigned</span>
                        </div>
                        <div
                            style="
                    background: linear-gradient(135deg, #ff4d4d, #cc0000);
                    width: 35px;
                    height: 35px;
                    margin-top: 20px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    font-size: 15px;
                ">
                            <i class="bi bi-person-exclamation"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style= "margin-top:20px;">
            <section class="col-md-8" ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="container-fluid">

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="col-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="card" style= "border-radius: 10px; padding:15px; ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h3 class="card-title" style = ' margin-top: 10px; font-size: 25px;'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Class
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Schedules</h3>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <p style = 'margin-left: 2px; margin-top: 2px'>Click on a grade to view teacher
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            schedules
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </p>



                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!-- GRADE 7-8  -->
                                                                                                 <!-- GRADE 7-8  -->
                                                                                                    <div class="row g-3">

                                                                                                        <!-- GRADE 7 BOX -->
                                                                                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                                                                                            <div class="grade1-box" data-bs-toggle="modal" data-bs-target="#grade1"
                                                                                                                style="cursor:pointer;   width:100%; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

                                                                                                                <div class="inner">

                                                                                                                    <!-- Flex container for Grade and Icon -->
                                                                                                                    <div class="d-flex align-items-center justify-content-between flex-nowrap">

                                                                                                                        <h3 style="font-size:26px; margin:0; font-weight:700; white-space:nowrap;">
                                                                                                                            Grade 7
                                                                                                                        </h3>

                                                                                                                        <div
                                                                                                                            style="  background: linear-gradient(135deg, rgb(103, 127, 248), #4400ff);
                                                                    width:40px; height:40px;
                                                                    border-radius:50%;
                                                                    display:flex; align-items:center; justify-content:center;
                                                                    color:#fff; font-size:16px;">

                                                                                                                            <i>{{ $grade1Count }}</i>
                                                                                                                        </div>

                                                                                                                    </div>
                                                                                                                    <p style="font-size:15px;"> {{ $grade1Count }} Scheduled Classes</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>


                                                                                                        <!-- Modal -->
                                                                                            <div class="modal fade" id="grade1" tabindex="-1" aria-labelledby="unassignedModalLabel"
                                                                                                            aria-hidden="true">
                                                                                                            <div class="modal-dialog">
                                                                                                                <div class="modal-content" style="width: 800px;">
                                                                                                                    <div class="modal-header bg-primary">
                                                                                                                        <h5 class="modal-title" id="grade2">GRADE 7 </h5>
                                                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                                    </div>

                                                                                                                    <div class="modal-body">
                                                                                                                        <div class="card-body">
                                                                                                                            <table id="example2" class="table table-bordered table-hover">
                                                                                                                                <thead>
                                                                                                                                    <tr>
                                                                                                                                        <th>Subject</th>
                                                                                                                                        <th>Teachers</th>
                                                                                                                                        <th>Date and Time</th>
                                                                                                                                    </tr>
                                                                                                                                </thead>
                                                                                                                                <tbody>
                                                                                              
                     @foreach ($view_grade1 as $grade)
                <tr>
                    <td>{{ $grade->sub_name }}</td>
                    <td>{{ $grade->teacher_name }}
                    <td class="align-middle">
                        <div class="mb-1">
                            @if ($grade->sub_date)
                                @foreach (explode('-', $grade->sub_date) as $day)
                                    <span class="badge bg-primary shadow-sm" style="font-size: 0.75rem;">
                                        {{ $day }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-muted small">No Days Set</span>
                            @endif
                        </div>

                        <div class="text-dark fw-bold" style="font-size: 0.9rem;">
                            <i class="bi bi-clock me-1 text-secondary"></i>
                            {{ $grade->sub_Stime ? date('g:i A', strtotime($grade->sub_Stime)) : 'N/A' }}
                            <span class="text-secondary mx-1">→</span>
                            {{ $grade->sub_Etime ? date('g:i A', strtotime($grade->sub_Etime)) : 'N/A' }}
                        </div>
                    </td>
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
    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
        <div class="grade2-box" data-bs-toggle="modal" data-bs-target="#grade22"
            style="cursor:pointer;   width:100%; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

            <div class="inner">

                <!-- Flex container for Grade and Icon -->
                <div class="d-flex align-items-center justify-content-between flex-nowrap">

                    <h3 style="font-size:26px; margin:0; font-weight:700; white-space:nowrap;">
                        Grade 8
                    </h3>

                    <div
                        style="  background: linear-gradient(135deg, rgb(103, 127, 248), #4400ff);
                                                                    width:40px; height:40px;
                                                                    border-radius:50%;
                                                                    display:flex; align-items:center; justify-content:center;
                                                                    color:#fff; font-size:16px;">

                        <i>{{ $grade2Count }}</i>
                    </div>

                </div>
                <p style="font-size:15px;"> {{ $grade2Count }} Scheduled Classes</p>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="grade22" tabindex="-1" aria-labelledby="unassignedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 800px;">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="grade2">GRADE 8 </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Teachers</th>
                                    <th>Date and Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($view_grade2 as $grade)
                                    <tr>
                                        <td>{{ $grade->sub_name }}</td>
                                        <td>{{ $grade->teacher_name }}
                                        <td class="align-middle">
                                            <div class="mb-1">
                                                @if ($grade->sub_date)
                                                    @foreach (explode('-', $grade->sub_date) as $day)
                                                        <span class="badge bg-primary shadow-sm"
                                                            style="font-size: 0.75rem;">
                                                            {{ $day }}
                                                        </span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted small">No Days Set</span>
                                                @endif
                                            </div>

                                            <div class="text-dark fw-bold" style="font-size: 0.9rem;">
                                                <i class="bi bi-clock me-1 text-secondary"></i>
                                                {{ $grade->sub_Stime ? date('g:i A', strtotime($grade->sub_Stime)) : 'N/A' }}
                                                <span class="text-secondary mx-1">→</span>
                                                {{ $grade->sub_Etime ? date('g:i A', strtotime($grade->sub_Etime)) : 'N/A' }}
                                            </div>
                                        </td>
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
    <div class="row g-3">

        <!-- GRADE 9 BOX -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="grade3-box" data-bs-toggle="modal" data-bs-target="#grade3"
                style="cursor:pointer;   width:100%; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

                <div class="inner">

                    <!-- Flex container for Grade and Icon -->
                    <div class="d-flex align-items-center justify-content-between flex-nowrap">

                        <h3 style="font-size:26px; margin:0; font-weight:700; white-space:nowrap;">
                            Grade 9
                        </h3>

                        <div
                            style="  background: linear-gradient(135deg, rgb(103, 127, 248), #4400ff);
                                                                    width:40px; height:40px;
                                                                    border-radius:50%;
                                                                    display:flex; align-items:center; justify-content:center;
                                                                    color:#fff; font-size:16px;">

                            <i>{{ $grade3Count }}</i>
                        </div>

                    </div>
                    <p style="font-size:15px;"> {{ $grade3Count }} Scheduled Classes</p>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="grade3" tabindex="-1" aria-labelledby="unassignedModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 800px;">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="grade2">GRADE 9 </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Teachers</th>
                                        <th>Date and Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_grade3 as $grade)
                                        <tr>
                                            <td>{{ $grade->sub_name }}</td>
                                            <td>{{ $grade->teacher_name }}
                                            <td class="align-middle">
                                                <div class="mb-1">
                                                    @if ($grade->sub_date)
                                                        @foreach (explode('-', $grade->sub_date) as $day)
                                                            <span class="badge bg-primary shadow-sm"
                                                                style="font-size: 0.75rem;">
                                                                {{ $day }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted small">No Days Set</span>
                                                    @endif
                                                </div>

                                                <div class="text-dark fw-bold" style="font-size: 0.9rem;">
                                                    <i class="bi bi-clock me-1 text-secondary"></i>
                                                    {{ $grade->sub_Stime ? date('g:i A', strtotime($grade->sub_Stime)) : 'N/A' }}
                                                    <span class="text-secondary mx-1">→</span>
                                                    {{ $grade->sub_Etime ? date('g:i A', strtotime($grade->sub_Etime)) : 'N/A' }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- GRADE 10 BOX -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="grade4-box" data-bs-toggle="modal" data-bs-target="#grade4"
                style="cursor:pointer;   width:100%; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">

                <div class="inner">
                    <!-- Flex container for Grade and Icon -->
                    <div class="d-flex align-items-center justify-content-between flex-nowrap">

                        <h3 style="font-size:26px; margin:0; font-weight:700; white-space:nowrap;">
                            Grade 10
                        </h3>

                        <div
                            style="
                                                                    background: linear-gradient(135deg, rgb(103, 127, 248), #4400ff);
                                                                    width:40px; height:40px;
                                                                    border-radius:50%;
                                                                    display:flex; align-items:center; justify-content:center;
                                                                    color:#fff; font-size:16px;">
                            <i>{{ $grade4Count }}</i>
                        </div>

                    </div>

                    <!-- Count -->
                    <p style="font-size:15px;">{{ $grade4Count }} Scheduled Classes</p>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="grade4" tabindex="-1" aria-labelledby="unassignedModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 800px;">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="grade2">GRADE 10 </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Teachers</th>
                                        <th>Date and Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_grade4 as $grade)
                                        <tr>
                                            <td>{{ $grade->sub_name }}</td>
                                            <td>{{ $grade->teacher_name }}
                                            <td class="align-middle">
                                                <div class="mb-1">
                                                    @if ($grade->sub_date)
                                                        @foreach (explode('-', $grade->sub_date) as $day)
                                                            <span class="badge bg-primary shadow-sm"
                                                                style="font-size: 0.75rem;">
                                                                {{ $day }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted small">No Days Set</span>
                                                    @endif
                                                </div>

                                                <div class="text-dark fw-bold" style="font-size: 0.9rem;">
                                                    <i class="bi bi-clock me-1 text-secondary"></i>
                                                    {{ $grade->sub_Stime ? date('g:i A', strtotime($grade->sub_Stime)) : 'N/A' }}
                                                    <span class="text-secondary mx-1">→</span>
                                                    {{ $grade->sub_Etime ? date('g:i A', strtotime($grade->sub_Etime)) : 'N/A' }}
                                                </div>
                                            </td>
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



    <!-- GRADE 11-12  -->
    <div class="row g-3">

        <!-- GRADE 5 BOX -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="grade5-box" data-bs-toggle="modal" data-bs-target="#grade5"
                style="cursor:pointer;   width:100%; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">
                <div class="inner">

                    <!-- Flex container for Grade and Icon -->
                    <div class="d-flex align-items-center justify-content-between flex-nowrap">

                        <h3 style="font-size:26px; margin:0; font-weight:700; white-space:nowrap;">
                            Grade 11
                        </h3>

                        <div
                            style="
                                                    background: linear-gradient(135deg, rgb(103, 127, 248), #4400ff);
                                                    width:40px; height:40px;
                                                    border-radius:50%;
                                                    display:flex; align-items:center; justify-content:center;
                                                    color:#fff; font-size:16px;">
                            <i>{{ $grade5Count }}</i>
                        </div>

                    </div>
                    <p style="font-size:15px;"> {{ $grade5Count }} Scheduled Classes</p>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="grade5" tabindex="-1" aria-labelledby="unassignedModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 800px;">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="grade2">GRADE 11 </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Teachers</th>
                                        <th>Date and Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_grade5 as $grade)
                                        <tr>
                                            <td>{{ $grade->sub_name }}</td>
                                            <td>{{ $grade->teacher_name }}
                                            <td class="align-middle">
                                                <div class="mb-1">
                                                    @if ($grade->sub_date)
                                                        @foreach (explode('-', $grade->sub_date) as $day)
                                                            <span class="badge bg-primary shadow-sm"
                                                                style="font-size: 0.75rem;">
                                                                {{ $day }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted small">No Days Set</span>
                                                    @endif
                                                </div>

                                                <div class="text-dark fw-bold" style="font-size: 0.9rem;">
                                                    <i class="bi bi-clock me-1 text-secondary"></i>
                                                    {{ $grade->sub_Stime ? date('g:i A', strtotime($grade->sub_Stime)) : 'N/A' }}
                                                    <span class="text-secondary mx-1">→</span>
                                                    {{ $grade->sub_Etime ? date('g:i A', strtotime($grade->sub_Etime)) : 'N/A' }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- GRADE 6 BOX -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="grade6-box" data-bs-toggle="modal" data-bs-target="#grade66"
                style="cursor:pointer;   width:100%; border-radius:20px; background:#fff; margin-top:20px; margin-left:3px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding:15px;">


                <div class="inner">
                    <!-- Flex container for Grade and Icon -->
                    <div class="d-flex align-items-center justify-content-between flex-nowrap">

                        <h3 style="font-size:26px; margin:0; font-weight:700; white-space:nowrap;">
                            Grade 12
                        </h3>

                        <div
                            style="
                                                    background: linear-gradient(135deg, rgb(103, 127, 248), #4400ff);
                                                    width:40px; height:40px;
                                                    border-radius:50%;
                                                    display:flex; align-items:center; justify-content:center;
                                                    color:#fff; font-size:16px;">
                            <i>{{ $grade6Count }}</i>
                        </div>

                    </div>

                    <!-- Count -->
                    <p style="font-size:15px;">{{ $grade6Count }} Scheduled Classes</p>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="grade66" tabindex="-1" aria-labelledby="unassignedModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 800px;">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="grade2">GRADE 12 </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Teachers</th>
                                        <th>Date and Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_grade6 as $grade)
                                        <tr>
                                            <td>{{ $grade->sub_name }}</td>
                                            <td>{{ $grade->teacher_name }}
                                            <td class="align-middle">
                                                <div class="mb-1">
                                                    @if ($grade->sub_date)
                                                        @foreach (explode('-', $grade->sub_date) as $day)
                                                            <span class="badge bg-primary shadow-sm"
                                                                style="font-size: 0.75rem;">
                                                                {{ $day }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted small">No Days Set</span>
                                                    @endif
                                                </div>

                                                <div class="text-dark fw-bold" style="font-size: 0.9rem;">
                                                    <i class="bi bi-clock me-1 text-secondary"></i>
                                                    {{ $grade->sub_Stime ? date('g:i A', strtotime($grade->sub_Stime)) : 'N/A' }}
                                                    <span class="text-secondary mx-1">→</span>
                                                    {{ $grade->sub_Etime ? date('g:i A', strtotime($grade->sub_Etime)) : 'N/A' }}
                                                </div>
                                            </td>
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


    </div>
    </div>
    </section>

    <section class="col-md-4 ms-auto ">
        <div class="container-fluid">
            <div class="col">
                <div class="col-12">
                    <div class="card" style="border-radius: 10px; padding:15px;">

                        <!-- Role above Name -->
                        <h3 style="margin: 0; font-size: 20px; font-weight: 600; text-align:center;">
                            Welcome back!!
                        </h3>
                        <p style="text-align:center;"> {{ session('name') }}</p>

                        <!-- Activity Log Section -->
                        <div class="activity-log mt-4">
                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 10px;">
                                Recent Activity
                            </h4>
                            <ul style="list-style-type: none; padding: 0; max-height: 300px; overflow-y: auto;">
                                @foreach ($logs as $log)
                                    @php
                                        // Set styles based on action
                                        switch ($log->action) {
                                            case 'added':
                                                $bgColor = 'rgba(0, 128, 0, 0.2)'; // green
                                                $textColor = '#28a745';
                                                break;
                                            case 'updated':
                                                $bgColor = 'rgba(255, 165, 0, 0.2)'; // orange
                                                $textColor = 'orange';
                                                break;
                                            case 'deleted':
                                                $bgColor = 'rgba(255, 0, 0, 0.2)'; // red
                                                $textColor = '#E3242B';
                                                break;
                                            default:
                                                $bgColor = 'transparent';
                                                $textColor = '#000';
                                        }
                                    @endphp
                                    <li style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                        <p style="margin: 0; font-size: 14px; color: #555;">
                                            <strong
                                                style="background: {{ $bgColor }}; color: {{ $textColor }}; padding: 3px 8px; border-radius: 12px;">
                                                {{ ucfirst($log->action) }}
                                            </strong> - {{ $log->description }}
                                        </p>
                                        <span style="font-size: 12px; color: gray;">
                                            {{ $log->created_at->diffForHumans() }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
    </section>
















@endsection

{{-- Inject the dashboard-specific scripts --}}
@section('scripts')
    <script src="{{ asset('java/calendar.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
@endsection
