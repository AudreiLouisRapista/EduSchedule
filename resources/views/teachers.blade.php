@extends('themes.main')

{{-- 1. DEFINE PAGE TITLE --}}
@section('title', 'User Profile')

{{-- 2. DEFINE CONTENT HEADER (Breadcrumbs) --}}
@section('content_header')
    <div class="header">
        <h1 class="title" style="margin-left: 50px; ">Teachers Management</h1>
        <p style="margin-left: 50px;">Manage faculty members and their class assignments</p>
    </div>

    <section class="content" style = "width: 1400 px; margin-left: 20px; margin-top: 20px;">
        <div class="container-fluid;">
            <div class="row">
                <div class="col-12">
                    <div class="card" style=" border-radius: 30px; background:#fff; padding:20px">
                        <div class="card-header" style="background:#fff;">
                            <h3 class="card-title">Faculty list</h3>
                            <!-- Button trigger modal -->

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addTeacherModal"
                                style="float: right; border-radius: 20px; background-color: #4CAF50; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: background-color 0.3s ease;">
                                Add Teacher
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="addTeacherModal" tabindex="-1"
                                aria-labelledby="addTeacherModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content" style="border-radius: 20px;">
                                        <!-- Square-ish rounded corners -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addTeacherModalLabel">Add Teacher</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @include('layout.partials.alerts')

                                            <form method="POST" action="{{ route('save_teacher') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <!-- Row for Email and Fullname side by side -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="email" class="form-label">Email:</label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control" placeholder="Enter your email"
                                                            value="{{ old('email') }}" required>
                                                        @error('email')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <div class="col-md-6">
                                                        <label for="name" class="form-label">Fullname:</label>
                                                        <input type="text" name="name" id="name"
                                                            class="form-control" placeholder="Enter your fullname"
                                                            value="{{ old('name') }}" required>
                                                        @error('name')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Age and Phone side by side -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="age" class="form-label">Age:</label>
                                                        <input type="text" name="age" id="age"
                                                            class="form-control" placeholder="Enter your age"
                                                            value="{{ old('age') }}" required>
                                                        @error('age')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <div class="col-md-6">
                                                        <label for="phone" class="form-label">Phone Number:</label>
                                                        <input type="number" name="phone" id="phone"
                                                            class="form-control" placeholder="Enter your phone number"
                                                            value="{{ old('phone') }}" required>
                                                        @error('phone')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Gender and Role side by side -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="gender" class="form-label">Gender:</label>
                                                        <select name="gender" id="gender" class="form-select" required>
                                                            <option value="">-- SELECT Gender --</option>
                                                            <option value="male"
                                                                {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                            </option>
                                                            <option value="female"
                                                                {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                                            </option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <!-- Major in what subject -->

                                                    <div class="col-md-6">
                                                        <label for="teacher_major" class="form-label">Major in:</label>
                                                        <select name="teacher_major" id="teacher_major" class="form-select"
                                                            required>
                                                            <option value="">-- SELECT MAJOR --</option>
                                                            <option value="English"
                                                                {{ old('teacher_major') == 'English' ? 'selected' : '' }}>
                                                                English</option>
                                                            <option value="Filipino"
                                                                {{ old('teacher_major') == 'Filipino' ? 'selected' : '' }}>
                                                                Filipino</option>
                                                            <option value="Mathematics"
                                                                {{ old('teacher_major') == 'Mathematics' ? 'selected' : '' }}>
                                                                Mathematics</option>
                                                            <option value="Science"
                                                                {{ old('teacher_major') == 'Science ' ? 'selected' : '' }}>
                                                                Science </option>
                                                            <option value="History"
                                                                {{ old('teacher_major') == 'History' ? 'selected' : '' }}>
                                                                History </option>
                                                            <option value="TLE"
                                                                {{ old('teacher_major') == 'TLE' ? 'selected' : '' }}>TLE
                                                            </option>
                                                            <option value="PE"
                                                                {{ old('teacher_major') == 'PE' ? 'selected' : '' }}>PE
                                                            </option>
                                                        </select>
                                                        @error('teacher_major')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="role" class="form-label">Role:</label>
                                                        <input type="text" name="role" id="role"
                                                            class="form-control" value="{{ old('role', 'Teacher') }}">
                                                        @error('role')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <!-- Profile Image -->
                                                    <div class="col-md-6">
                                                        <label for="profile_image" class="form-label">Profile
                                                            Image:</label>
                                                        <input type="file" name="profile_image" id="profile_image"
                                                            class="form-control" required>
                                                        @error('profile_image')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <input type="hidden" name="t_status" value="0">

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

                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Phone</th>
                                        <th>Major</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_teachers as $teacher)
                                        <tr>

                                            <td>
                                                @if ($teacher->profile)
                                                    <img src="{{ asset('storage/' . $teacher->profile) }}"
                                                        class="img-circle elevation-2" alt="User Image"
                                                        style="width:30px; height:30px; object-fit:cover; border-radius:50%; margin-right:10px;">
                                                @else
                                                    <img src="{{ asset('dist/img/default.png') }}"
                                                        class="img-circle elevation-2" alt="Default Image">
                                                @endif
                                                {{ $teacher->email }}
                                            </td>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->age }}</td>
                                            <td>{{ $teacher->phone }}</td>
                                            <td>{{ $teacher->teacher_major }}</td>
                                            <td>{{ $teacher->status_name }}</td>
                                            <td class ="text-center">
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteTeacherModal{{ $teacher->teachers_id }}">
                                                    <i class="bi bi-person-dash"></i>

                                                </button>

                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#UpdateTeacherModal{{ $teacher->teachers_id }}">
                                                    <i class="bi bi-pen"></i>

                                                </button>
                                            </td>
                                        </tr>


                                        <!-- Delete Teacher Modal -->
                                        <div class="modal fade" id="deleteTeacherModal{{ $teacher->teachers_id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="deleteTeacherModalLabel{{ $teacher->teachers_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteTeacherModalLabel{{ $teacher->teachers_id }}">
                                                            Deactivate Teacher</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to deactivate {{ $teacher->name }}?</p>
                                                        <form method="POST" action="{{ route('deact_teacher') }}">
                                                            @csrf
                                                            <input type="hidden" name="teachers_id"
                                                                value="{{ $teacher->teachers_id }}">
                                                            <button type="submit"
                                                                class="btn btn-danger">Deactivate</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <!-- Update Teacher Modal -->
                                        <div class="modal fade" id="UpdateTeacherModal{{ $teacher->teachers_id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="UpdateTeacherModalLabel{{ $teacher->teachers_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="UpdateTeacherModal{{ $teacher->teachers_id }}">Update
                                                            Teacher</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">


                                                        <form method="POST"
                                                            action="{{ route('update_teacher', $teacher->teachers_id) }}">
                                                            @csrf

                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" name="email"
                                                                    value="{{ $teacher->email }}" class="form-control"
                                                                    required>
                                                            </div>


                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" name="name"
                                                                    value="{{ $teacher->name }}" class="form-control"
                                                                    required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input type="number" name="phone"
                                                                    value="{{ $teacher->phone }}" class="form-control"
                                                                    required>
                                                            </div>


                                                            <div class="form-group">
                                                                <label>Age</label>
                                                                <input type="number" name="age"
                                                                    value="{{ $teacher->age }}" class="form-control"
                                                                    required>
                                                            </div>

                                                            <label>Gender:</label>
                                                            <select name="gender" required>
                                                                <option value="">-- SELECT Gender --</option>
                                                                <option value="{{ $teacher->phone }}"
                                                                    {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                                </option>
                                                                <option value="{{ $teacher->phone }}"
                                                                    {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                                    Female</option>

                                                            </select>
                                                            @error('gender')
                                                                <span class="error-message">{{ $message }}</span>
                                                            @enderror




                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </form>
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
