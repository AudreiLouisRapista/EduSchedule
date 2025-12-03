@extends('themes.main')

{{-- 1. DEFINE PAGE TITLE --}}
@section('title', 'User Profile')

{{-- 2. DEFINE CONTENT HEADER (Breadcrumbs) --}}
@section('content_header')
<div class="header">
     <h1 class="title" style="margin-left: 50px; ">Subject Management</h1>
     <p style="margin-left: 50px;">Manage Subjects and their class assignments</p>
</div>
   
<section class="content" style = "width: 1400 px; margin-left: 20px; margin-top: 20px;">
      <div class="container-fluid;">
        <div class="row">
          <div class="col-12">
            <div class="card" style=" border-radius: 30px; background:#fff; padding:20px">
              <div class="card-header" style="background:#fff;">
                <h3 class="card-title">Subject list</h3>
                    <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
                           Add Subject
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add subject</h1>

                                </div>
                                                <div class="modal-body">
                                                <h4 class="mb-4 text-center">Subject information</h4>

                                                <form method="POST" action="{{ route('save_subjects') }}" enctype="multipart/form-data">
                                                    @csrf

                                                  

                                                    <!-- Subject name -->
                                                    <div class="mb-3">
                                                    <label for="sub_name" class="form-label">Subject name (e.g Subject-1)</label>
                                                    <input type="text" class="form-control" id="sub_name" name="sub_name" placeholder="subject_name" required>
                                                    @error('sub_name')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                    </div>

                                                    <!-- Grade Level -->
                                                    <div class="mb-3">
                                                    <label for="grade_id" class="form-label">Grade Level</label>
                                                    <select type="text" class="form-control" id="grade_id" name="grade_id" placeholder="Grade Level" required>
                                                        <option value="">-- Select Grade Level --</option>
                                                        <option value="7">Grade 7</option>
                                                        <option value="8">Grade 8</option>
                                                        <option value="9">Grade 9</option>
                                                        <option value="10">Grade 10</option>
                                                        <option value="11">Grade 11</option>
                                                        <option value="12">Grade 12</option>
                                                    </select>
                                                    @error('grade_id')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                    </div>

                                                    <!-- Status -->
                                                  <input type="hidden" name="t_status" value="unassigned">

                                            
                                                    
                                                
        
                                                    <!-- Submit -->
                                                    <div class="text-center mt-4">
                                                    <button type="submit" class="btn btn-primary w-100">Register</button>
                                                    </div>
                                                </form>
                                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 
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
                                <th>Subject Name</th>
                                <th>Grade Level</th>
                                <!-- <th>ACtion</th> -->
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($view_subject as $sub)
                                    <tr>
                                        <td>{{ $sub->subject_name }}</td>
                                        <td>{{ $sub->grade_title }}</td>
                                       
                                    </tr>
                                @endforeach

                            </tbody>
                            </table>

                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 11 to 20 of 57 entries
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            <ul class="pagination"><li class="paginate_button page-item previous" id="example2_previous">
                                <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                            </li><li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                            </li>
                            <li class="paginate_button page-item active">
                                <a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                            </li>
                            <li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                            </li>
                            <li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                            </li>
                            <li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                            </li>
                            <li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                            </li>
                            <li class="paginate_button page-item next" id="example2_next">
                                <a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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