@extends('themes.main')

{{-- 1. DEFINE PAGE TITLE --}}
@section('title', 'User Profile')

{{-- 2. DEFINE CONTENT HEADER (Breadcrumbs) --}}
@section('content_header')
    <div class="header">
        <h1 class="title" style="margin-left: 50px; ">Teachers Load</h1>
        <p style="margin-left: 50px;">Check the Loads of every teachers</p>
    </div>

    <section class="content" style = "width: 1400 px; margin-left: 20px; margin-top: 20px;">
        <div class="container-fluid;">
            <div class="row">
                <div class="col-12">
                    <div class="card" style=" border-radius: 30px; background:#fff; padding:20px">
                        <div class="card-header" style="background:#fff;">
                            <h3 class="card-title">Faculty list</h3>
                            <select id="schoolYearSelect" name="schoolyear_id"
                                style="width: 200px; float: right; background: #0061f4; border-radius: 5px; padding: 5px; color: white; border: none;">
                                <option value="">Select School Year</option>
                                @foreach ($school_years_map as $id => $name)
                                    <option value="{{ $id }}" @if ($id == $selected_year_id) selected @endif>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($teachers as $t)
                                        <tr>
                                            <td>{{ $t->name }}</td>
                                            <td>{{ $t->email }}</td>
                                            <td>{{ $t->phone }}</td>
                                            <td>{{ $t->gender }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#viewTeacherModal{{ $t->teachers_id }}">
                                                    VIEW LOAD
                                                </button>



                                                <!-- MODAL -->
                                                <div class="modal fade" id="viewTeacherModal{{ $t->teachers_id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ $t->name }} – Loads</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <table class="table table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Subject</th>
                                                                            <th>Section</th>
                                                                            <th>Time</th>
                                                                            <th>Day</th>
                                                                            <th>Grade Level</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        @forelse ($teacher_loads[$t->teachers_id] ?? [] as $load)
                                                                            <tr>
                                                                                <td>{{ $load->sub_name }}</td>
                                                                                <td>{{ $load->sec_name }}</td>
                                                                                <td>{{ date('g:i A', strtotime($load->sub_Stime)) }}
                                                                                    -
                                                                                    {{ date('g:i A', strtotime($load->sub_Etime)) }}
                                                                                </td>
                                                                                <td>{{ $load->sub_date }}</td>
                                                                                <td>{{ $load->grade_name }}</td>
                                                                            </tr>
                                                                        @empty
                                                                            <tr>
                                                                                <td colspan="5"
                                                                                    class="text-center text-muted">No
                                                                                    schedule assigned</td>
                                                                            </tr>
                                                                        @endforelse


                                                                    </tbody>

                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>

@endsection



@section('scripts')
    <script>
        $(document).ready(function() {
            $('#schoolYearSelect').change(function() {
                var selectedYear = $(this).val();

                // Get the base URL for the view (e.g., /teacher_loadView)
                var baseUrl = '{{ route('teacher_loads') }}';

                // Construct the new URL with the query parameter
                var newUrl = baseUrl;
                if (selectedYear) {
                    newUrl += '?schoolyear_id=' + selectedYear;
                }

                // Redirect the browser, which causes the full page reload with the filter
                window.location.href = newUrl;
            });
        });
    </script>
@endsection
