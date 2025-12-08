@extends('themes.main')

{{-- 1. DEFINE PAGE TITLE --}}
@section('title', 'User Profile')

{{-- 2. DEFINE CONTENT HEADER (Breadcrumbs) --}}
@section('content_header')
    <div class="header">
        <h1 class="title" style="margin-left: 50px; ">Subject Management</h1>
        <p style="margin-left: 50px;">Manage Subjects and their class assignments</p>
    </div>

    <section class="content" style="width: 1400px; margin-left: 20px; margin-top: 20px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- MAIN CARD -->
                    <div class="card" style="border-radius: 30px; background:#fff; padding:20px">

                        <div class="card-header" style="background:#fff;">
                            <h3 class="card-title">Subject List</h3>

                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" style="float: right;">
                                Add Subject
                            </button>
                        </div>

                        <!-- MODAL -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Add Subject</h1>
                                    </div>

                                    <div class="modal-body">
                                        <h4 class="mb-4 text-center">Subject Information</h4>

                                        <form method="POST" action="{{ route('save_subjects') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="mb-3">
                                                <label class="form-label">Subject Name</label>
                                                <input type="text" class="form-control" name="sub_name" required>
                                                @error('sub_name')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Grade Level</label>
                                                <select class="form-control" name="grade_id" required>
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

                                            <input type="hidden" name="t_status" value="unassigned">

                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-primary w-100">Register</button>
                                            </div>

                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- DATATABLE -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Grade Level</th>
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
                                    <div class="dataTables_info">

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div><!-- end main card -->

                </div>
            </div>
        </div>
    </section>

@endsection

@section('tables')
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

@endsection
