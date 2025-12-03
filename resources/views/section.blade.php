@extends('themes.main')

{{-- 1. DEFINE PAGE TITLE --}}
@section('title', 'User Profile')

{{-- 2. DEFINE CONTENT HEADER (Breadcrumbs) --}}
@section('content_header')
<div class="content-header">
    {{-- Left Column: User Card/Image --}}
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    {{-- Assuming user profile image exists --}}
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('dist/img/user4-128x128.jpg') }}"
                         alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Alexander Pierce</h3>
                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Followers</b> <a class="float-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b>Projects</b> <a class="float-right">15</a>
                    </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Update Status</b></a>
            </div>
            </div>
        </div>
    {{-- Right Column: Account Settings Tabs --}}
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                </ul>
            </div><div class="card-body">
                <div class="tab-content">
                    {{-- Settings Tab --}}
                    <div class="tab-pane active" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Name" value="Alexander Pierce">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="alex@example.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="e.g. PHP, Laravel, Blade" value="Coding, UI/UX, Teaching">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- Activity Tab (You can add your activity feed here) --}}
                    <div class="tab-pane" id="activity">
                        <p>No recent activity to show.</p>
                    </div>
                    </div>
                </div></div>
        </div>
    </div>
@endsection