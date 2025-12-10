@extends('themes.main')

{{-- 1. DEFINE PAGE TITLE --}}
@section('title', 'User Profile')

{{-- 2. DEFINE CONTENT HEADER (Breadcrumbs) --}}
@section('content_header')
    <div class="header">
        <h1 class="title" style="margin-left: 50px; ">Schedule Management</h1>
        <p style="margin-left: 50px;">Manage Schedule for the Teachers</p>
    </div>

    <section class="content" style = "width: 1400 px; margin-left: 20px; margin-top: 20px;">
        <div class="container-fluid;">
            <div class="row">
                <div class="col-12">
                    <div class="card" style=" border-radius: 30px; background:#fff; padding:20px">
                        <div class="card-header" style="background:#fff;">
                            <h3 class="card-title">Schedule list</h3>
                            <!-- Button trigger modal -->


                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                                style="float: right; border-radius: 20px; background-color: #4CAF50; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: background-color 0.3s ease;">
                                Add Schedule
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content" style="border-radius: 20px;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModal">Add Schedule</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @include('layout.partials.alerts')

                                            <form method="POST" action="{{ route('save_schedule') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <h4 class="mb-4 text-center">Schedule Information</h4>

                                                <!-- Assigned Teacher -->
                                                <div class="mb-3">
                                                    <label for="teachers_id" class="form-label">Assigned Teacher</label>
                                                    <select class="form-select" id="teachers_id" name="teachers_id">
                                                        <option value="">-- Select Teacher --</option>
                                                        <option value="0">Not Assigned</option>
                                                        @foreach ($teachers as $teacher)
                                                            <option value="{{ $teacher->teachers_id }}">
                                                                {{ $teacher->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('teachers_id')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Assigned Subject -->
                                                <div class="mb-3">
                                                    <label for="subject_id" class="form-label">Assigned Subject</label>
                                                    <select class="form-select" id="subject_id" name="subject_id" required>
                                                        <option value="">-- Select Subject --</option>
                                                        @foreach ($subject as $sub)
                                                            <option value="{{ $sub->subject_id }}">
                                                                {{ $sub->subject_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('subject_id')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>


                                                <!-- Assigned Section -->
                                                <div class="mb-3">
                                                    <label for="section_id" class="form-label">Assigned Section</label>
                                                    <select class="form-select" id="section_id" name="section_id" required>
                                                        <option value="">-- Select Section --</option>
                                                        @foreach ($section as $sec)
                                                            <option value="{{ $sec->section_id }}">
                                                                {{ $sec->section_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('section_id')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Select Days</label>
                                                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                                        @php
                                                            $days = [
                                                                'Whole Week',
                                                                'Monday',
                                                                'Tuesday',
                                                                'Wednesday',
                                                                'Thursday',
                                                                'Friday',
                                                            ];
                                                        @endphp

                                                        @foreach ($days as $day)
                                                            <div class="form-check">
                                                                <input type="checkbox" name="days[]"
                                                                    value="{{ $day }}"
                                                                    class="form-check-input day-option"
                                                                    onclick="handleDaySelection(this)"
                                                                    {{ is_array(old('days')) && in_array($day, old('days')) ? 'checked' : '' }}>
                                                                <label class="form-check-label">{{ $day }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <script>
                                                    function handleDaySelection(el) {
                                                        let checkboxes = document.querySelectorAll('.day-option');

                                                        if (el.value === "Whole Week" && el.checked) {
                                                            checkboxes.forEach(cb => {
                                                                if (cb.value !== "Whole Week") cb.checked = false;
                                                            });
                                                        } else {
                                                            // If any day except Whole Week is selected → uncheck Whole Week
                                                            document.querySelector('.day-option[value="Whole Week"]').checked = false;
                                                        }
                                                    }
                                                </script>


                                                <!-- Start and End Time -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="sub_Stime" class="form-label">Starting Time</label>
                                                        <input type="time" class="form-control" id="sub_Stime"
                                                            name="sub_Stime" required>
                                                        @error('sub_Stime')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="sub_Etime" class="form-label">End Time</label>
                                                        <input type="time" class="form-control" id="sub_Etime"
                                                            name="sub_Etime" required>
                                                        @error('sub_Etime')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- School Year -->
                                                <div class="mb-3">
                                                    <label for="schoolyear_id" class="form-label">School Year:</label>
                                                    <select name="schoolyear_id" id="schoolyear_id" class="form-select"
                                                        required>
                                                        <option value="">-- Select School Year --</option>

                                                        @php
                                                            $startYear = date('Y');
                                                            $endYear = $startYear + 2;
                                                        @endphp

                                                        @for ($year = $startYear; $year <= $endYear; $year++)
                                                            @php
                                                                $schoolyear_name = $year . '-' . ($year + 1);

                                                                $existingYear = DB::table('school_year')
                                                                    ->where('schoolyear_name', $schoolyear_name)
                                                                    ->first();
                                                            @endphp

                                                            <option value="{{ $schoolyear_name }}"
                                                                {{ old('schoolyear_name', $sched->schoolyear_name ?? '') == $schoolyear_name ? 'selected' : '' }}>
                                                                {{ $schoolyear_name }}
                                                            </option>
                                                        @endfor
                                                    </select>


                                                    @error('schoolyear_id')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>


                                                <input type="hidden" name="sched_status" value="unassigned">

                                                <div class="text-center mt-4">
                                                    <button type="submit" class="btn btn-primary w-100">Register</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Assigned Teacher</th>
                                        <th>Subject</th>
                                        <th>Section</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>School Year</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                        <!-- <th>ACtion</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_schedule as $sched)
                                        <tr>
                                            <td>{{ $sched->teacher_name }}</td>
                                            <td>{{ $sched->sub_name }}, {{ $sched->grade_name }}</td>
                                            <td>{{ $sched->sec_name }}</td>
                                            <td>{{ $sched->sub_date }}</td>
                                            <td>{{ date('g:i A', strtotime($sched->sub_Stime)) }} -
                                                {{ date('g:i A', strtotime($sched->sub_Etime)) }}</td>
                                            <td>{{ $sched->schoolyear_name }}</td>
                                            <td>{{ $sched->status_name }}</td>
                                            <td class ="text-center">
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteScheduleModal{{ $sched->schedule_id }}">
                                                    <i class="bi bi-person-dash"></i>

                                                </button>

                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#UpdateScheduleModal{{ $sched->schedule_id }}">
                                                    <i class="bi bi-pen"></i>

                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Delete Schedule Modal -->
                                        <div class="modal fade" id="deleteScheduleModal{{ $sched->schedule_id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="deleteScheduleModal{{ $sched->schedule_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteScheduleModal{{ $sched->schedule_id }}">Delete
                                                            Schedule</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to Delete this Schdeule?</p>
                                                        <form method="POST" action="{{ route('delete_schedule') }}">
                                                            @csrf
                                                            <input type="hidden" name="schedule_id"
                                                                value="{{ $sched->schedule_id }}">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Update Schedule Modal -->
                                        <div class="modal fade" id="UpdateScheduleModal{{ $sched->schedule_id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="UpdateScheduleModal{{ $sched->schedule_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content" style="border-radius: 20px;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Schedule</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('update_schedule') }}">
                                                            @csrf

                                                            <!-- Hidden Schedule ID -->
                                                            <input type="hidden" name="schedule_id"
                                                                value="{{ $sched->schedule_id }}">

                                                            <!-- Assigned Teacher -->
                                                            <div class="mb-3">
                                                                <label for="teachers_id" class="form-label">Assigned
                                                                    Teacher</label>
                                                                <select class="form-select" id="teachers_id"
                                                                    name="teachers_id">
                                                                    <option value="{{ $sched->teachers_id }}">
                                                                        {{ $sched->teacher_name ?? 'Not Assigned' }}
                                                                    </option>
                                                                    <option value="0">Not Assigned</option>
                                                                    @foreach ($teachers as $teacher)
                                                                        <option value="{{ $teacher->teachers_id }}">
                                                                            {{ $teacher->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('teachers_id')
                                                                    <span class="text-danger small">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <!-- Assigned Subject -->
                                                            <div class="mb-3">
                                                                <label for="subject_id" class="form-label">Assigned
                                                                    Subject</label>
                                                                <select class="form-select" id="subject_id"
                                                                    name="subject_id" required>
                                                                    <option value="{{ $sched->subject_id }}">
                                                                        {{ $sched->sub_name }}</option>
                                                                    @foreach ($subject as $sub)
                                                                        <option value="{{ $sub->subject_id }}">
                                                                            {{ $sub->subject_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('subject_id')
                                                                    <span class="text-danger small">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <!-- Assigned Section -->
                                                            <div class="mb-3">
                                                                <label for="section_id" class="form-label">Assigned
                                                                    Subject</label>
                                                                <select class="form-select" id="section_id"
                                                                    name="section_id" required>
                                                                    <option value="{{ $sched->section_id }}">
                                                                        {{ $sched->sec_name }}</option>
                                                                    @foreach ($section as $sec)
                                                                        <option value="{{ $sec->section_id }}">
                                                                            {{ $sec->section_id }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('section_id')
                                                                    <span class="text-danger small">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <!-- Select Days -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Select Days</label>
                                                                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                                                    @php
                                                                        $days = [
                                                                            'Whole Week',
                                                                            'Monday',
                                                                            'Tuesday',
                                                                            'Wednesday',
                                                                            'Thursday',
                                                                            'Friday',
                                                                        ];
                                                                        $existingDays = explode('-', $sched->sub_date);
                                                                    @endphp

                                                                    @foreach ($days as $day)
                                                                        <div class="form-check">
                                                                            <input type="checkbox" name="days[]"
                                                                                value="{{ $day }}"
                                                                                class="form-check-input day-option"
                                                                                onclick="handleDaySelection(this)"
                                                                                {{ in_array($day, $existingDays) ? 'checked' : '' }}>
                                                                            <label
                                                                                class="form-check-label">{{ $day }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <script>
                                                                function handleDaySelection(el) {
                                                                    let checkboxes = document.querySelectorAll('.day-option');

                                                                    if (el.value === "Whole Week" && el.checked) {
                                                                        checkboxes.forEach(cb => {
                                                                            if (cb.value !== "Whole Week") cb.checked = false;
                                                                        });
                                                                    } else {
                                                                        document.querySelector('.day-option[value="Whole Week"]').checked = false;
                                                                    }
                                                                }
                                                            </script>

                                                            <!-- Start and End Time -->
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="sub_Stime" class="form-label">Starting
                                                                        Time</label>
                                                                    <input type="time" class="form-control"
                                                                        id="sub_Stime" name="sub_Stime" required
                                                                        value="{{ $sched->sub_Stime }}">
                                                                    @error('sub_Stime')
                                                                        <span
                                                                            class="text-danger small">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="sub_Etime" class="form-label">End
                                                                        Time</label>
                                                                    <input type="time" class="form-control"
                                                                        id="sub_Etime" name="sub_Etime" required
                                                                        value="{{ $sched->sub_Etime }}">
                                                                    @error('sub_Etime')
                                                                        <span
                                                                            class="text-danger small">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- School Year -->
                                                            <div class="mb-3">
                                                                <label for="schoolyear_id" class="form-label">School
                                                                    Year:</label>
                                                                <select name="schoolyear_id" id="schoolyear_id"
                                                                    class="form-select" required>
                                                                    <option value="">-- Select School Year --
                                                                    </option>
                                                                    @php
                                                                        $startYear = date('Y');
                                                                        $endYear = $startYear + 5;
                                                                    @endphp
                                                                    @for ($year = $startYear; $year <= $endYear; $year++)
                                                                        <option value="{{ $year . '-' . ($year + 1) }}"
                                                                            {{ $sched->schoolyear_id == $year . '-' . ($year + 1) ? 'selected' : '' }}>
                                                                            {{ $year . '-' . ($year + 1) }}
                                                                        </option>
                                                                    @endfor
                                                                </select>
                                                                @error('schoolyear_id')
                                                                    <span class="text-danger small">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="text-center mt-4">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
