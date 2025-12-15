@extends('themes.main')

@section('content_header')
    <section class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">

                <!-- Profile Container (Full Card) -->
                <div class="col-md-8" style="margin-top: 30px;">

                    <div class="card shadow-lg" style="border-radius: 20px; padding: 25px;">

                        <div class="row">

                            <!-- LEFT SIDE: PROFILE IMAGE -->
                            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                                <img class="img-fluid rounded-circle shadow"
                                    src="{{ asset('storage/' . session('profile')) }}"
                                    style="width:150px; height:150px; object-fit:cover; border:4px solid #586bff;">

                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#updateAdmin">
                                    <i class="bi bi-pen"></i>
                                </button>

                                <div class="modal fade" id="updateAdmin" tabindex="-1" role="dialog"
                                    aria-labelledby="updateAdmin" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content" style="border-radius: 20px;">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Schedule</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            @foreach ($admins as $admin)
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('adminProfile', $admin->id) }}">
                                                        @csrf

                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" name="email" value="{{ $admin->email }}"
                                                                class="form-control" required>
                                                        </div>


                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" name="name" value="{{ $admin->name }}"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input type="number" name="phone" value="{{ $admin->phone }}"
                                                                class="form-control" required>
                                                        </div>




                                                        <label>Gender:</label>
                                                        <select name="gender" required>
                                                            <option value="">-- SELECT Gender --</option>
                                                            <option value="{{ $admin->phone }}"
                                                                {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                            </option>
                                                            <option value="{{ $admin->phone }}"
                                                                {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                                Female</option>


                                                            <label for="profile">
                                                                Profile Picture:
                                                                <input type="file" name="profile" id="profile"
                                                                    accept="image/*">

                                                            </label>

                                                        </select>
                                                        @error('gender')
                                                            <span class="error-message">{{ $message }}</span>
                                                        @enderror




                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT SIDE: PROFILE INFORMATION -->
                            <div class="col-md-8">

                                <h2 class="mb-1">{{ session('name') }}</h2>
                                <p class="text-muted" style="font-size: 14px;">{{ session('role') }}</p>


                                <hr>
                                @foreach ($admins as $admin)
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong>Email</strong>
                                            <p>{{ $admin->email }}</p>
                                        </div>

                                        <div class="col-sm-6">
                                            <strong>Name</strong>
                                            <p>{{ $admin->name }}</p>
                                        </div>


                                        <div class="col-sm-6">
                                            <strong>Phone</strong>
                                            <p>{{ $admin->phone }}</p>
                                        </div>

                                        <div class="col-sm-6">
                                            <strong>Gender</strong>
                                            <p>{{ $admin->gender }}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <section class="content ">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card" style="border-radius: 10px; padding:15px;">

                        <!-- Role above Name -->
                        <h4 style="margin: 0; font-size: 20px; font-weight: 600; text-align:center;">
                            Recent Activity
                        </h4>

                        <!-- Activity Log Section -->
                        <div class="activity-log mt-4">
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
