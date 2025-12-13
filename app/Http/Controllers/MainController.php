<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // For direct database queries
use Illuminate\Validation\Rule;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Session; // For session usage
class MainController extends Controller
{
    /**
     * Show the main welcome page.
     */
    public function main(){
        return view('welcome');
    }

    /**
     * Show the registration form view.
     */


    /**
     * Handle an incoming registration request and save the new user.
     */

    /**
     * Handle user authentication (login).
     */
   
   public function auth_user(Request $request){

    $email = $request->email;
    $pass = $request->password;

    // Check admin first
    $admin = DB::table('admin')->where('email', $email)->first();

    // Check teacher
    $teacher = DB::table('teacher')->where('email', $email)->first();

    // USER FOUND?
    if(!$admin && !$teacher){
        return back()->with('errorMessage', 'User not found.');
    }

    // Determine correct user and role
    if($admin){
        $user = $admin;
        $role = 'admin';
    } else {
        $user = $teacher;
        $role = 'teacher';
    }

    // CHECK PASSWORD
    if(!Hash::check($pass, $user->password)){
        return back()->with('errorMessage', 'Invalid password.');
    }

    // STORE SESSION
    if($role == 'admin'){
        Session::put('id', $user->id);
        Session::put('profile', $user->profile);
        Session::put('name', $user->name);
         Session::put('email', $user->email);
        Session::put('phone', $user->phone);
        Session::put('gender', $user->gender);
        Session::put('user_role', 'admin');


        return redirect()->route('admin.dashboard');
    }

    if($role == 'teacher'){
        Session::put('teachers_id', $user->teachers_id);
        Session::put('profile', $user->profile);
        Session::put('name', $user->name);
        Session::put('email', $user->email);
        Session::put('age', $user->age);
        Session::put('phone', $user->phone);
        Session::put('gender', $user->gender);
        Session::put('role', 'teacher');

        return redirect()->route('teacher.dashboard');
    }
}


private function logActivity($action, $description)
{
    ActivityLog::create([
        'admin_id' => Session::get('id'), // or Auth::id() if using Auth
        'action' => $action,
        'description' => $description,
    ]);
}

    public function admin_profile()
{
    $logs = ActivityLog::latest()->take(10)->get();

    $admins = DB::table('admin')->get();

    return view('admin_profile', compact('admins','logs'));
}




    public function TeacherUI(){

     $teacherId = session ('teachers_id');

    $teacher_ui = DB::table('schedules')
            ->leftjoin('teacher', 'teacher.teachers_id', '=', 'schedules.teachers_id')
            ->leftjoin('subject', 'subject.subject_id', '=', 'schedules.subject_id')
            ->leftjoin('grade_level', 'grade_level.grade_id', '=', 'schedules.grade_id')
            ->leftjoin('section', 'section.section_id', '=', 'schedules.section_id')
            ->where('schedules.teachers_id', $teacherId)
             ->select(

            'teacher.teachers_id',
            'subject.subject_name',
            'grade_level.grade_title',
            'section.section_name',
            // 'subject.subject_gradelevel',
            'schedules.sub_date',
            'schedules.sched_year',
            'schedules.sub_Stime',
            'schedules.sub_Etime',




        )
            ->get();


    return view('TeacherUI', compact('teacher_ui'));


    }

    /**
     * Show the dashboard view.
     */
   public function dashboard()
{
    // dd(session()->all());
    $logs = ActivityLog::latest()->take(10)->get();
    // Count data
    $totaladmin = DB::table('admin')->count();
    $totalteachers = DB::table('teacher')->count();
    $unassigned_teachers = DB::table('teacher')->where('t_status', '0')->count();
    $assigned_teachers = DB::table('teacher')->where('t_status', '1')->count();
    $view_teachers = DB::table('teacher')->get();
    $view_schedule = DB::table('schedules')->count();
    // $view_subject = DB::table('subject')->count();

    // Count subjects per grade level
    $grade1Count = DB::table('schedules')->where('grade_id', '7')->count();
    $grade2Count = DB::table('schedules')->where('grade_id', '8')->count();
    $grade3Count = DB::table('schedules')->where('grade_id', '9')->count();
    $grade4Count = DB::table('schedules')->where('grade_id', '10')->count();
    $grade5Count = DB::table('schedules')->where('grade_id', '11')->count();
    $grade6Count = DB::table('schedules')->where('grade_id', '12')->count();

//  $schoolYears = DB::table('school_year')->orderBy('schoolyear_name', 'desc')->get();

   $view_grade1 = DB::table('schedules')
    ->join('teacher', 'teacher.teachers_id', '=', 'schedules.teachers_id')
    ->join('subject', 'subject.subject_id', '=', 'schedules.subject_id')
    ->where('schedules.grade_id', 7)
    ->select(
        'subject.subject_name as sub_name',
        'teacher.name as teacher_name',
        'schedules.sub_date',
        'schedules.sub_Stime',
        'schedules.sub_Etime'
    )

    ->get();

//  dd(DB::table('schedules')->first());
   $view_grade2 = DB::table('schedules')
        ->leftJoin('teacher', 'schedules.teachers_id', '=', 'teacher.teachers_id')
        ->Join('subject', 'schedules.subject_id', '=', 'subject.subject_id')
        ->where('schedules.grade_id', 8)
        ->select(
            'subject.subject_name as sub_name',
            'teacher.name as teacher_name',
            'schedules.sub_date',
            'schedules.sub_Stime',
             'schedules.sub_Etime'
        )
        ->get();

            $logs = ActivityLog::whereIn('action', ['added','updated','deleted'])
                   ->latest()
                   ->take(10)
                   ->get();

    $add_teachers = DB::table('teacher')->get();

    return view('dashboard', compact(
        'totaladmin',
        'totalteachers',
        'unassigned_teachers',
        'assigned_teachers',
        'view_teachers',
        'add_teachers',
        'grade1Count',
        'grade2Count',
        'grade3Count',
        'grade4Count',
        'grade5Count',
        'grade6Count',
        'view_grade1',
        'view_grade2',
        'logs',
        'view_schedule',
        // 'schoolYears'
        
    ));
    
}



   public function save_section(Request $request){


       // 1. Validate input
    // $request->validate([
    //     'subject_code' => 'required|string|max:255',
    //     'subject_name' => 'required|string|max:255',
    //     'subject_gradelevel' => 'required|string|max:255',
    //     // 'subject_status' => 'required|exists:teacher,teachers_id',
    // ]);



    // 2. Save the new subject
   $save_section = DB::table('section')->insert([
        'section_name' => $request->section_name,
        'grade_id' => $request->grade_id,
        'section_capacity' => $request-> section_capacity,
        'section_strand' => $request-> section_strand,

    ]);



    return redirect()->back()->with('success', 'Section added successfully!');


    }

     public function view_section() {


       $view_section = DB::table('section')
            ->leftJoin('grade_level', 'grade_level.grade_id', '=', 'section.grade_id')
             ->select(
            'section.section_name',
            'section.section_capacity',
            'grade_level.grade_title',
            'section.section_strand'
        )
            ->get();





    return view('section', compact('view_section'));


}








    // SUBJECTS

public function save_subjects(Request $request){


       // 1. Validate input
    // $request->validate([
    //     'subject_code' => 'required|string|max:255',
    //     'subject_name' => 'required|string|max:255',
    //     'subject_gradelevel' => 'required|string|max:255',
    //     // 'subject_status' => 'required|exists:teacher,teachers_id',
    // ]);



    // 2. Save the new subject
   $save_subjects = DB::table('subject')->insert([
        'subject_name' => $request->sub_name,
        'grade_id' => $request->grade_id,
        'subject_status' => $request->t_status,
        'sub_strand' => $request->sub_strand ?? 'N/A',
        'sub_yearlevel' => $request->sub_yearlevel,

    ]);

    $this->logActivity(
    'added',
    'Added subject: ' . $request->sub_name . ' for Grade ' . $request->grade_id
);

    return redirect()->back()->with('success', 'Subject added and teacher status updated!');


    }

     public function view_subject() {


       $view_subject = DB::table('subject')
            ->leftJoin('status', 'status.status_id', '=', 'subject.subject_status')
            ->leftJoin('grade_level', 'grade_level.grade_id', '=', 'subject.grade_id')
             ->select(
            'subject.subject_name',
            'subject.sub_strand',
            'subject.sub_yearlevel',
            'grade_level.grade_title',
            'status.status_name'
        )
            ->get();





    return view('subject', compact('view_subject'));


}










        // SAVE TEACHERS

    public function save_teacher(Request $request){
    // 1. Validation
    // $request->validate([
    //     'name' => ['required', 'string', 'max:255', 'unique:teacher'],
    //     'lastname' => ['required', 'string', 'max:255'],
    //     'age' => ['required', 'integer'],
    //     'phone' => ['required', 'digits_between:7,11'], // better for phone validation
    // ]);

    $email = $request->input('email');
    $pass = $request->input('password');
    $name = $request->input('name');
    $age = $request->input('age');
    $teacher_major = $request->input('teacher_major');
    $phone = $request->input('phone');
    $gender = $request->input('gender');
    $role = $request->input('role');
    $t_status = $request->input('t_status');

    $chech_exist = DB::table('teacher')
    ->where('name', $request->name)
    ->exists();

    if($chech_exist){
        return redirect()->back()->with('errorMessage', 'Teacher already exist');
    }


        // 3. Image Handling: Store the uploaded file
        if ($request->hasFile('profile_image')) {
            $profile = $request->file('profile_image')->store('images', 'public');
        } else {
            // Should be caught by validation, but safe to check
            return redirect()->back()->with('errorMessage', 'Profile image is required.');
        }

        // 4. Save the new user to the 'admin' table
        $save = DB::table('teacher')->insert([
            // 'profile' => $profile,
            'email' => $email,
            'password' => Hash::make($pass),
            'name' => $name,
            'phone' => $phone,
            't_status' => $t_status,
            'gender' => $gender,
            'age' => $age,
            'teacher_major' => $teacher_major,
            'role' => $role,
            'profile' => $profile,
        ]);



    //  session()->flash('successMessage','Teacher added successfully');
     session()->flash('save','Teacher added successfully');

      // 3. Redirect back with success message
    return redirect()->back()->with('save', 'Teacher added successfully!');
}




        // DEACTIVATE TEACHERS
public function deact_teacher(Request $request) {
    // Update the teacher's status to 'deactivated' (assuming status_id 2 is 'deactivated')
    DB::table('teacher')
        ->where('teachers_id', $request->teachers_id)
        ->update([
            't_status' => 0 // Deactivated
        ]);

        $this->logActivity(
        'updated',
        'Deactivated teacher ID ' . $request->teachers_id
    );
    session()->flash('success', 'Teacher deactivated successfully.');
    return redirect()->back();

    }


public function update_teacher(Request $request) {
    $teachers_id = $request->teachers_id;



    DB::table('teacher')
        ->where('teachers_id', $teachers_id)
        ->update([

            'email'    => $request->email,
            'name'     => $request->name,
            'gender'     => $request->gender,
            'age'      => $request->age,
            'phone'    => $request->phone,
        ]);

         $this->logActivity(
        'updated',
        'Updated teacher ID ' . $teachers_id . ': ' . $request->name
    );
    session()->flash('update', 'Teacher updated successfully.');
    return redirect()->back();
}








    public function view_teachers() {
    // Get all records from 'teacher' table



    $view_teachers = DB::table('teacher')
            ->join('status', 'status.status_id', '=', 'teacher.t_status')
             ->select(
            'teacher.teachers_id',
             'teacher.email',
            'teacher.name',
            'teacher.age',
            'teacher.phone',
            'teacher.teacher_major',
            'status.status_name',
            'teacher.gender',
            'teacher.profile',
            'teacher.role'
        )
            ->get();





    return view('teachers', compact('view_teachers'));
}







        // SAVE SUBJECTS


public function save_schedule(Request $request)
{
        // Basic validation with min/max rules
    // $request->validate([
    //     'subject_id' => 'required|exists:subject,subject_id',  // Required and must exist
    //     'days' => 'required|array|min:1|max:5',  // At least 1 day, max 5 days
    //     'sub_Stime' => 'required|date_format:H:i|after:06:00|before:22:00',  // Required time, min 6 AM, max 10 PM
    //     'sub_Etime' => 'required|date_format:H:i|after:sub_Stime|before:22:00',  // Must be after start, max 10 PM
    //     'sched_year' => 'required|string|min:9|max:10',  // Required, min 9 chars (e.g., "2023-2024"), max 10
    //     'teachers_id' => [
    //         'nullable',  // Optional
    //         'string',
    //         function ($attribute, $value, $fail) {
    //             if ($value && $value !== '0' && !DB::table('teacher')->where('teachers_id', $value)->exists()) {
    //                 $fail('The selected teacher is invalid.');
    //             }
    //         },
    //     ],
    // ]);
    // Get data from the form


$teacher_id = $request->teachers_id;  // Can be empty or "0"
$subject_id = $request->subject_id;
$section_id = $request->section_id;
$newday = $request->days;
$dayString = implode('-', $newday);
$start = $request->sub_Stime;
$end = $request->sub_Etime;
$schoolyear_id = $request->schoolyear_id;

// Step 1: Get the grade from the subject
$grade_id = DB::table('subject')
    ->where('subject_id', $subject_id)
    ->value('grade_id');

if (!$grade_id) {
    return back()->with('error', 'Subject not found. Please check your selection.');
}

// Step 2: Check for conflicts in the same grade
$existingSchedules = DB::table('schedules')
    ->where('grade_id', $grade_id)
    ->get();

foreach ($existingSchedules as $sched) {
    $existingDay = explode('-', $sched->sub_date);
    $dayConflict = array_intersect($newday, $existingDay);

    if (!empty($dayConflict)) {
        $existingStart = $sched->sub_Stime;
        $existingEnd = $sched->sub_Etime;

        if ($start < $existingEnd && $end > $existingStart) {
            return back()->with(
                'errorMessage',
                'Conflict! Grade ' . $grade_id . ' has a class on ' . implode(', ', $dayConflict) . ' at this time.'
            );
        }
    }
}

// Step 3: Check for teacher conflicts (only if assigned)
if ($teacher_id && $teacher_id != "0") {
    $teacherSchedules = DB::table('schedules')
        ->where('teachers_id', $teacher_id)
        ->get();

    foreach ($teacherSchedules as $sched) {
        $existingDay = explode('-', $sched->sub_date);
        $dayConflict = array_intersect($newday, $existingDay);

        if (!empty($dayConflict)) {
            $existingStart = $sched->sub_Stime;
            $existingEnd = $sched->sub_Etime;

            if ($start < $existingEnd && $end > $existingStart) {
                return back()->with(
                    'errorMessage',
                    'Conflict! Teacher is busy on ' . implode(', ', $dayConflict) . ' at this time.'
                );
            }
        }
    }
}

// Step 4: Check for section conflicts
$sectionSchedules = DB::table('schedules')
    ->where('section_id', $section_id)
    ->get();

foreach ($sectionSchedules as $sched) {
    $existingDay = explode('-', $sched->sub_date);
    $dayConflict = array_intersect($newday, $existingDay);

    if (!empty($dayConflict)) {
        $existingStart = $sched->sub_Stime;
        $existingEnd = $sched->sub_Etime;

        if ($start < $existingEnd && $end > $existingStart) {
            return back()->with(
                'errorMessage',
                'Conflict! Section ' . $section_id . ' has a class on ' . implode(', ', $dayConflict) . ' at this time.'
            );
        }
    }
}
    
    


    // Step 4: Set status
    $sched_status = ($teacher_id && $teacher_id != "0") ? 1 : 0;

    // Step 5: Try to save the schedule (with error handling)
    try {
    // Perform the insert

    $schoolyear_name = $request->schoolyear_id ?? null;
        
     $existingYear = DB::table('school_year')
        ->where('schoolyear_name', $schoolyear_name)
        ->first();

        if(!$existingYear){
            $schoolyear_ID = DB::table('school_year')->insertGetId([
                'schoolyear_name' => $schoolyear_name
            ]);
        } else {
            $schoolyear_ID = $existingYear->schoolyear_ID;
        }

DB::table('schedules')->insert([
    'subject_id' => $subject_id,
    'section_id' => $section_id,
    'grade_id' => $grade_id,
    'teachers_id' => $teacher_id ?: null,
    'sub_date' => $dayString,
    'sub_Stime' => $start,
    'sub_Etime' => $end,
    'schoolyear_id' => $schoolyear_ID,
    'sched_status' => $sched_status,
]);




    } catch (\Exception $e) {
        // If insert fails, show the error
        return back()->with('error', 'Failed to save schedule: ' . $e->getMessage());
    }



    // Step 6: Try to update teacher status (only if assigned)
    if ($teacher_id && $teacher_id != "0") {
        try {
            DB::table('teacher')
                ->where('teachers_id', $teacher_id)
                ->update(['t_status' => 1]);
        } catch (\Exception $e) {
            // If update fails, show the error (but don't stop the save)
            return back()->with('error', 'Schedule saved, but failed to update teacher: ' . $e->getMessage());
        }
    }


// Fetch teacher name
// Get teacher name
$teacher = DB::table('teacher')->where('teachers_id', $teacher_id)->first();
$teacher_name = $teacher ? $teacher->name : 'unassigned';

// Get subject name
$subject = DB::table('subject')->where('subject_id', $subject_id)->first();
$subject_name = $subject ? $subject->subject_name : 'unassigned';

// Log activity
$this->logActivity(
    'added',
    'Added schedule for teacher name ' . $teacher_name . ', subject name ' . $subject_name
);

    // Success!
    session()->flash('save', 'Schedule saved successfully!');
    return redirect()->back();
}


       // Delete Schedule
public function delete_schedule(Request $request) {

    // Fetch the schedule first
    $schedule = DB::table('schedules')->where('schedule_id', $request->schedule_id)->first();

    if ($schedule) {
        // Get teacher and subject IDs from the schedule
        $teachers_id = $schedule->teachers_id;
        $subject_id = $schedule->subject_id;

        // Fetch teacher name
        $teacher = DB::table('teacher')->where('teachers_id', $teachers_id)->first();
        $teacher_name = $teacher ? $teacher->name : 'unassigned';

        // Fetch subject name
        $subject = DB::table('subject')->where('subject_id', $subject_id)->first();
        $subject_name = $subject ? $subject->subject_name : 'unassigned';

        // Delete the schedule
        DB::table('schedules')->where('schedule_id', $request->schedule_id)->delete();

        // Log activity
        $this->logActivity(
            'deleted',
            'Deleted schedule for teacher name ' . $teacher_name . ', subject name ' . $subject_name
        );

        session()->flash('success', 'Schedule deleted successfully.');
    } else {
        session()->flash('error', 'Schedule not found.');
    }

    return redirect()->back();
}




    //Update Schedule
public function update_schedule(Request $request) {
    $schedule_id = $request->schedule_id;

    $days = implode('-', $request->days);

    DB::table('schedules')
        ->where('schedule_id', $schedule_id)
        ->update([

            'subject_id'    => $request->subject_id,
            'teachers_id'     => $request->teachers_id,
            'section_id'     => $request->section_id,
            'sub_date'     =>  $days,
            'sub_Stime'      => $request->sub_Stime,
            'sub_Etime'    => $request->sub_Etime,
            'schoolyear_id'    => $request->schoolyear_id,

        ]);

        $this->logActivity(
        'updated',
        'Updated schedule ID ' . $schedule_id . ' for teacher ID ' . $request->teachers_id
    );

    session()->flash('update', 'Schedule updated successfully.');
    return redirect()->back();
}



// public function set_system_schoolyear(Request $request)
// {
//     $selectedSchoolYear = $request->input('filter_schoolyear_name'); // string like "2025-2026"

//     if ($selectedSchoolYear) {
//         session(['system_schoolyear' => $selectedSchoolYear]);
//     }

//     return redirect()->back(); // redirect to dashboard or current page
// }







    public function updateTeacherStatus($teachers_id) {

        $count = DB::table('schedules')
        ->where('teachers_id', $teachers_id)
        ->count();

        DB::table('teacher')
        ->where('teachers_id', $teachers_id)
        ->update([
            't_status' => ($count > 0) ? 1 : 0 // 1 = Assigned, 0 = Unassigned
        ]);

    }


    public function teacher_loads(Request $request)
    {
        // Get the selected school year from the request (no default now)
      $selected_year_id = $request->get('schoolyear_id');  // Can be null if not selected
        // Fetch all teachers
        $teachers = DB::table('teacher')->get();
        // Fetch available school years
        $school_years_map = DB::table('school_year')->pluck('schoolyear_name', 'schoolyear_id');
        // Fetch loads for each teacher
        $teacher_loads = [];
        foreach ($teachers as $teacher) {
            $query = DB::table('schedules')
            ->join('teacher', 'schedules.teachers_id', '=', 'teacher.teachers_id')
            ->join('subject', 'schedules.subject_id', '=', 'subject.subject_id')
            ->join('grade_level', 'schedules.grade_id', '=', 'grade_level.grade_id')
            ->join('section', 'schedules.section_id', '=', 'section.section_id')
            ->select(
                'schedules.*',  // Includes all schedule columns (e.g., sub_Stime, sub_Etime, sub_date)
                'teacher.name as teacher_name',
                'teacher.role as teacher_role',
                'subject.subject_name as sub_name',
                'grade_level.grade_title as grade_name',
                'section.section_name as sec_name',
              
            ) 

            -> where('schedules.teachers_id', $teacher->teachers_id);
            // Only filter by school_year if one is selected
            if ($selected_year_id) {
                $query->where('schedules.schoolyear_id', $selected_year_id);
            }
            $loads = $query->get();
            $teacher_loads[$teacher->teachers_id] = $loads;
        }
        // Pass data to view
        return view('teacher_loadView', compact('teachers', 'teacher_loads', 'school_years_map', 'selected_year_id'));
    }
  

   
        // VIEW SCHEDULES

public function view_schedule() {

    $view_schedule = DB::table('schedules')
        ->leftJoin('teacher', 'schedules.teachers_id', '=', 'teacher.teachers_id')
        ->leftJoin('grade_level', 'schedules.grade_id', '=', 'grade_level.grade_id')
        ->leftJoin('subject', 'schedules.subject_id', '=', 'subject.subject_id')
        ->leftJoin ('status', 'status.status_id', '=', 'schedules.sched_status')
        ->leftJoin ('section', 'schedules.section_id', '=', 'section.section_id')
        ->leftJoin ('school_year', 'schedules.schoolyear_id', '=', 'school_year.schoolyear_ID')
        

        ->select(
            'schedules.*',
            'teacher.name as teacher_name',
            'grade_level.grade_title as grade_name',
            'subject.subject_name as sub_name',
            'section.section_name as sec_name',
            'status.status_name',
            'school_year.schoolyear_name'

        )
        ->get();

    // 3. AUTO-UPDATE TEACHER STATUS → Assigned
  $teachers = DB::table('teacher')
    ->whereRaw('(SELECT COUNT(*) FROM schedules WHERE schedules.teachers_id = teacher.teachers_id) < 5')
    ->get();


    $subject = DB::table('subject')
        ->select('subject_id', 'subject_name') // All subject
        ->get();

      $section = DB::table('section')
        ->select('section_id', 'section_name') // All subject
        ->get();

     $school_year = DB::table('school_year')
        ->select('schoolyear_ID', 'schoolyear_name') // All year
        ->get();

    return view('schedule', compact('view_schedule','subject', 'teachers','section', 'school_year'));
}









public function update_subject(Request $request) {

    $update_subject = DB::table('schedules')
        ->where('teacher-id', $request->teacher_id)
        ->where('sub_id', '!=', $request->sub_id)
        ->count();


        if($update_subject >= 5) {
            return redirect()->back()->with('error', 'This teacher is already assigned to another subject.');
        }

    DB::table('schedules')
        ->where('sub_id', $request->sub_id)
        ->update([
            'sub_code' => $request->sub_code,
            'sub_name' => $request->sub_name,
            'teachers_id' => $request->teachers_id,
            'sub_date' => $request->sub_date,
            'sub_Stime' => $request->sub_Stime,
            'sub_Etime' => $request->sub_Etime,
        ]);
        $this->logActivity(
    'updated',
    'Updated subject ID ' . $request->sub_id . ' to ' . $request->sub_name
);
    return redirect()->back()->with('success', 'Subject updated successfully.');

}



        // TEACHERS


     public function teachers() {
        $teachers = DB::table('teacher')->get();
        return view('schedule', compact('schedule', 'teachers'));

     }

     public function subject() {
        $subject = DB::table('subject')->get();
        return view('schedule', compact('schedule', 'subject'));

     }




        // TEACHERS STATUS

     public function teacher_status() {
        $teacher_status = DB::table('teacher')
            ->join('status', 'status.status_id', '=', 'teacher.t_status')
             ->select(
            'teacher.name',
            'teacher.lastname',
            'teacher.age',
            'teacher.phone',
            'status.status_name'
        )
            // ->where('t_status', 1) // Assuming 1 indicates 'active' status
            ->get();

        return view('teachers', compact('teacher_status'));
    }





        
   public function save_student(Request $request){





    // 2. Save the new subject
   $save_student = DB::table('students')->insert([
        'student_firstname' => $request->student_firstname,
        'student_lastname' => $request-> student_lastname,

    ]);



    return redirect()->back()->with('success', 'Student added successfully!');


    }

     public function view_student() {


       $view_student = DB::table('students') ->get();





    return view('student', compact('view_student'));


}

   

        // LOG OUT

        public function logout(){
         Session::flush();
           return redirect('/');// Clear all session data
        }



}
