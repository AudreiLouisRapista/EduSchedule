<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // For direct database queries
use Illuminate\Validation\Rule;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Session; // For session usage
use Exception;
use DateTime;
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
   
public function auth_user(Request $request) {
    $email = $request->email;
    $pass = $request->password;

    $admin = DB::table('admin')->where('email', $email)->first();
    $teacher = DB::table('teacher')->where('email', $email)->first();
    // dd($admin, $teacher);

    if(!$admin && !$teacher){
        return back()->with('errorMessage', 'User not found.');
    }

    // Determine user and role
    $user = $admin ? $admin : $teacher;
    $role = $admin ? 'admin' : 'Teacher';
    // dd($user, $role);

    if(!Hash::check($pass, $user->password)){
        return back()->with('errorMessage', 'Invalid password.');
    }

    // Clear old session data first to prevent role mixing
    Session::flush();

    // Store common data
    // Session::put('id', $user->id ?? $user->teachers_id);
    Session::put('name', $user->name);
    Session::put('email', $user->email);
    Session::put('user_role', $role); 
    Session::put('profile', $user->profile);
    Session::put('phone', $user->phone);
    Session::put('gender', $user->gender);
    
    
    // This saves 'admin' or 'teacher'

    if($role == 'admin'){
        Session::put('id', $user->id);
        Session::put('user_role', $role); 
        Session::put('name', $user->name);
        Session::put('email', $user->email);
        Session::put('profile', $user->profile);
        Session::put('phone', $user->phone);
        Session::put('gender', $user->gender);
        Session::save(); // CRITICAL
        return redirect()->route('admin.dashboard');
    } else {
    // dd(session('name'),session('email'),session('user_role'));   

        Session::put('id', $user->teachers_id);
        // Session::save(); // CRITICAL
        return redirect()->route('Teacher.TeacherUI');
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

public function adminProfile(Request $request) {
    $admins = $request->id;



    DB::table('admin')
        ->where('id', $admins)
        ->update([

            'email'    => $request->email,
            'name'     => $request->name,
            'gender'     => $request->gender,
            'phone'    => $request->phone,
            'profile'    => $request->profile,
        ]);

         $this->logActivity(
        'updated',
        'Updated teacher ID ' . $admins . ': ' . $request->name
    );
    session()->flash('update', 'Admin updated successfully.');
    return redirect()->back();
}

public function Update_teacherProfile(Request $request, $id) { // Accept $id from route
    
    // Handle the image upload
    $imageName = $request->hidden_profile; // Fallback to old image if no new one
    if ($request->hasFile('profile')) {
        $imageName = time().'.'.$request->profile->extension();  
        $request->profile->move(public_path('profiles'), $imageName);
    }

    DB::table('teacher')
        ->where('teachers_id', $id) // Use the ID passed from the route
        ->update([
            'teachers_id' => $request->teachers_id,
            'email'   => $request->email,
            'name'    => $request->name,
            'gender'  => $request->gender,
            'phone'   => $request->phone,
            'profile' => $imageName,
        ]);

    $this->logActivity('updated', "Updated teacher ID $id: $request->name");
    
    return redirect()->back()->with('update', 'Teacher updated successfully.');
}




public function TeacherUI(Request $request) {
    // 1. Get the logged-in teacher's ID from the session
    $teacherId = session('id'); 
    
    if (!$teacherId) {
        return redirect()->route('login')->with('error', 'Session expired.');
    }

    // 2. Data for the dropdown
    $school_years_map = DB::table('school_year')->pluck('schoolyear_name', 'schoolyear_id');
    $selected_year_id = $request->get('schoolyear_id');

    // 3. Fetch specific teacher profile info
    $teachers = DB::table('teacher')
        ->where('teachers_id', $teacherId)
        ->select(
            'teachers_id', 
            'email as teacher_email', 
            'name as teacher_name', 
            'phone as teacher_phone', 
            'gender as teacher_gender', 
            'profile as teacher_profile'
        )
        ->get();

    // 4. Fetch the specific teacher's schedule/loads
    $query = DB::table('schedules')
        ->join('subject', 'schedules.subject_id', '=', 'subject.subject_id')
        ->join('grade_level', 'schedules.grade_id', '=', 'grade_level.grade_id')
        ->join('section', 'schedules.section_id', '=', 'section.section_id')
        ->where('schedules.teachers_id', $teacherId) // Only this teacher
        ->select(
            'schedules.*', 
            'schedules.create_at',
            'subject.subject_name as sub_name',
            'grade_level.grade_title as grade_name',
            'section.section_name as sec_name'
        );

    // Filter by year if selected
    if ($selected_year_id) {
        $query->where('schedules.schoolyear_id', $selected_year_id);
    }

    $teacher_ui = $query->get();

    return view('TeacherUI', compact('teachers', 'teacher_ui', 'school_years_map', 'selected_year_id'));
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


public function save_schedule(Request $request){
    // ... (Your request variable setup is here) ...
    $teacher_id = $request->teachers_id; 
    $subject_id = $request->subject_id;
    $section_id = $request->section_id;
    $newday = $request->days;
    $dayString = implode('-', $newday);
    $start = $request->sub_Stime;
    $end = $request->sub_Etime;
    $schoolyear_name = $request->schoolyear_id; 

    // Time validation and parsing
    try {
        $startTime = DateTime::createFromFormat('H:i', $start);
        $endTime = DateTime::createFromFormat('H:i', $end);
        if (!$startTime || !$endTime) {
            throw new Exception('Invalid format');
        }
    } catch (Exception $e) {
        return back()->with('error', 'Invalid time format. Please use HH:MM (24-hour).');
    }
    
    // Check if start is before end
    if ($startTime >= $endTime) {
        return back()->with('error', 'Start time must be before end time.');
    }

    // Step 1: Get the grade from the subject (Needed for Step 3)
    $grade_id = DB::table('subject')
        ->where('subject_id', $subject_id)
        ->value('grade_id');
    if (!$grade_id) {
        return back()->with('error', 'Subject not found. Please check your selection.');
    }


    // ----------------------------------------------------------------------
    // 💥 REORDERED CONFLICT CHECKS START HERE 💥
    // ----------------------------------------------------------------------


    // Step 2: HIGHEST PRIORITY - Check for an EXACT duplicate schedule (Same time, section, day)
    $duplicate = DB::table('schedules')
        ->where('section_id', $section_id)
        ->where('sub_date', $dayString)
        ->where('sub_Stime', $start) // Exact match on start time
        ->where('sub_Etime', $end)   // Exact match on end time
        ->exists();
    if ($duplicate) {
        // NEED EDIT THE NAME 
        return back()->with('errorMessage', 'Conflict! This exact schedule (Time, Section, and Days) already exists.');
    }


    // Step 3: Check for conflicts within the SAME SECTION (Time Overlap)
    // This is the correct logic for preventing students from being double-booked.
    $existingSectionSchedules = DB::table('schedules')
        ->where('section_id', $section_id) // Filter by the specific section
        ->get();
        
    foreach ($existingSectionSchedules as $sched) {
        $existingDay = explode('-', $sched->sub_date);
        $dayConflict = array_intersect($newday, $existingDay);
        
        if (!empty($dayConflict)) {
            try {
                // Robust Time Parsing (H:i:s is common in DB, H:i is from input)
                $existingStartTime = DateTime::createFromFormat('H:i:s', $sched->sub_Stime)
                                     ?: DateTime::createFromFormat('H:i', $sched->sub_Stime);
                $existingEndTime = DateTime::createFromFormat('H:i:s', $sched->sub_Etime)
                                   ?: DateTime::createFromFormat('H:i', $sched->sub_Etime);

                if (!$existingStartTime || !$existingEndTime) {
                    continue; // Skip invalid existing times
                }
            } catch (Exception $e) {
                continue; 
            }
            
            // Check for overlap: new start < existing end AND new end > existing start
            if ($startTime < $existingEndTime && $endTime > $existingStartTime) {
                return back()->with(
                    'errorMessage',
                    'Conflict! Section ' . $section_id . ' is already booked on ' . implode(', ', $dayConflict) . ' at this time.'
                );
            }
        }
    }
    

    // Step 4: Check for teacher conflicts (Time Overlap, only if assigned)
    if ($teacher_id && $teacher_id != "0") {
        $teacherSchedules = DB::table('schedules')
            ->where('teachers_id', $teacher_id)
            ->get();
            
        foreach ($teacherSchedules as $sched) {
            $existingDay = explode('-', $sched->sub_date);
            $dayConflict = array_intersect($newday, $existingDay);
            
            if (!empty($dayConflict)) {
                try {
                    // Robust Time Parsing
                    $existingStartTime = DateTime::createFromFormat('H:i:s', $sched->sub_Stime)
                                         ?: DateTime::createFromFormat('H:i', $sched->sub_Stime);
                    $existingEndTime = DateTime::createFromFormat('H:i:s', $sched->sub_Etime)
                                       ?: DateTime::createFromFormat('H:i', $sched->sub_Etime);
                                       
                    if (!$existingStartTime || !$existingEndTime) {
                        continue; 
                    }
                } catch (Exception $e) {
                    continue; 
                }
                
                if ($startTime < $existingEndTime && $endTime > $existingStartTime) {
                    return back()->with(
                        'errorMessage',
                        'Conflict! Teacher is busy on ' . implode(', ', $dayConflict) . ' at this time.'
                    );
                }
            }
        }
    }
    
    // ----------------------------------------------------------------------
    // 💥 CONFLICT CHECKS END HERE 💥
    // ----------------------------------------------------------------------

    // Step 5: Set status and save
    $sched_status = ($teacher_id && $teacher_id != "0") ? 1 : 0;
    
    // Handle school year (Remaining code unchanged)
    $existingYear = DB::table('school_year')
        // ... (rest of your school year logic) ...
        ->first();
    if (!$existingYear) {
        $schoolyear_ID = DB::table('school_year')->insertGetId([
            'schoolyear_name' => $schoolyear_name
        ]);
    } else {
        $schoolyear_ID = $existingYear->schoolyear_ID;
    }
    
    // Try to insert
    try {
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
        return back()->with('error', 'Failed to save schedule: ' . $e->getMessage());
    }

    // ... (Your teacher status update and logging code) ...
    
    session()->flash('save', 'Schedule saved successfully!');
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
    // 1. Get the selected school year from the request
    $selected_year_id = $request->get('schoolyear_id'); 

    // Fetch available school years (always needed for the select box)
    $school_years_map = DB::table('school_year')->pluck('schoolyear_name', 'schoolyear_id');
    
    // --- Initialize variables ---
    $teachers = collect(); // Initialize as an empty collection
    $teacher_loads = [];   // Initialize as an empty array

    // 2. Conditional Logic: Load data ONLY if a year is selected
    if ($selected_year_id) {
        
        // Fetch only the teachers who have schedules in the selected year
        // We do this by joining schedules and filtering by the selected year ID.
        $teachers = DB::table('teacher')
            ->join('schedules', 'teacher.teachers_id', '=', 'schedules.teachers_id')
            ->where('schedules.schoolyear_id', $selected_year_id)
            ->distinct() // Ensure each teacher only appears once
            ->select('teacher.*') // Select all columns from the teacher table
            ->get();


        // 3. Process Loads for the filtered teachers
        foreach ($teachers as $teacher) {
            $query = DB::table('schedules')
                ->join('subject', 'schedules.subject_id', '=', 'subject.subject_id')
                ->join('grade_level', 'schedules.grade_id', '=', 'grade_level.grade_id')
                ->join('section', 'schedules.section_id', '=', 'section.section_id')
                ->select(
                    'schedules.*', 
                    'subject.subject_name as sub_name',
                    'grade_level.grade_title as grade_name',
                    'section.section_name as sec_name',
                ) 
                ->where('schedules.teachers_id', $teacher->teachers_id)
                ->where('schedules.schoolyear_id', $selected_year_id); // Filter loads by year
                
            $loads = $query->get();
            $teacher_loads[$teacher->teachers_id] = $loads;
        }
    }
    
    // 4. Pass data to view
    return view('teacher_loadView', compact('teachers', 'teacher_loads', 'school_years_map', 'selected_year_id'));
}



public function section_loads(Request $request)
{
    // 1. Get the selected school year from the request
    $selected_year_id = $request->get('schoolyear_id'); 

    // Fetch available school years (always needed for the select box)
    $school_years_map = DB::table('school_year')->pluck('schoolyear_name', 'schoolyear_id');
    
    // --- Initialize variables ---
    $section = collect(); // Initialize as an empty collection
    $section_loads = [];   // Initialize as an empty array

   // 2. Conditional Logic: Load data ONLY if a year is selected
if ($selected_year_id) {
    
    // Fetch only the sections that have schedules in the selected year.
    $section = DB::table('section')
        // CORRECTED JOIN: Match section.section_id with schedules.section_id
        ->join('schedules', 'section.section_id', '=', 'schedules.section_id') 
        ->where('schedules.schoolyear_id', $selected_year_id)
        ->distinct() // Ensure each section only appears once
        ->select('section.*') // Select all columns from the section table
        ->get();

        // 3. Process Loads for the filtered sections
        foreach ($section as $sec) {
            $query = DB::table('schedules')
                ->join('subject', 'schedules.subject_id', '=', 'subject.subject_id')
                ->join('grade_level', 'schedules.grade_id', '=', 'grade_level.grade_id')
                ->select(
                    'schedules.*', 
                    'subject.subject_name as sub_name',
                    'grade_level.grade_title as grade_name',
                ) 
                ->where('schedules.section_id', $sec->section_id)
                ->where('schedules.schoolyear_id', $selected_year_id); // Filter loads by year
                
            $loads = $query->get();
            $section_loads[$sec->section_id] = $loads;
        }
    }
    
    // 4. Pass data to view
    return view('section_loadView', compact('section', 'section_loads', 'school_years_map', 'selected_year_id'));
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

    public function logout(Request $request)
{
    // 1. Tell Laravel's Auth system to log the current user out.
    Auth::logout();

    // 2. Invalidate the current session and remove all session data.
    // This is the core action that destroys the 'user_role' key and all other data.
    $request->session()->invalidate(); 

    // 3. Regenerate the session's CSRF token for security.
    $request->session()->regenerateToken();

    // 4. Redirect the user.
    return redirect('/');
}

}
