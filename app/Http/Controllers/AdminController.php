<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller{

    public function adminLoginForm(Request $request){
        return view('admin.login');
    }

    public function adminLogin(Request $request) {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'info',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Get credentials from request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the admin
        if (Auth::attempt($credentials)) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Login successful!',
            ]);
        }

        return response()->json([
            'status'  => 'warning',
            'message' => 'The provided credentials do not match our records.',
        ]);
    }




    public function adminHome(Request $request){
        $comments = DB::table('events_comments')
            ->where('status', 'ACTIVE')
            ->limit(6)
            ->orderBy('id', 'DESC')
            ->get();

        $campaigns = DB::table('campaigns')
            ->where('status', 'ACTIVE')
            ->limit(5)
            ->orderBy('id', 'DESC')
            ->get();

        $users = DB::table('users')
            ->where('status', 'ACTIVE')
            ->count();
        $smt = DB::table('team_members')
            ->where('status', 'ACTIVE')
            ->where('smt', true)
            ->count();
        $employees = DB::table('team_members')
            ->where('status', 'ACTIVE')
            ->count();


        return view('admin.home',[
            'comments'      => $comments,
            'campaigns'        => $campaigns,
            'total_users'   => $users,
            'smt'           => $smt,
            'employees'     => $employees,
        ]);
    }

    public function registerAdmin(Request $request){
        return view('admin.register_admin');

    }

    public function fetchAdmins(Request $request){
        $roles = DB::table('users')->select('*')
            ->where('status', 'ACTIVE')
            ->orderBy('id', 'DESC')
            ->get();
        if($roles->isNotEmpty()){
            $count = 0;
            $data = '';
            foreach ($roles as $row){
                $count++;
                $data .= "
                <tr>
                  <td>{$count}</td>
                  <td>{$row->name}</td>
                  <td>{$row->email}</td>
                  <td>{$row->user_type}</td>
                  <td><button type=\"button\" class=\"btn btn-success\" onclick=\"adminEditing('{$row->uuid}')\"
                  data-bs-toggle=\"modal\" data-bs-target=\"#editAdminModal\">
                   <i class=\"bi bi-pencil-fill me-1\"></i></button></td>

                  <td><button type=\"button\" class=\"btn btn-danger admin_ID\" onclick=\"adminDeletion('{$row->uuid}')\"
                  data-bs-toggle=\"modal\" data-bs-target=\"#confirmAdminDeletion\">
                  <i class=\"bi bi-trash me-1\"></i></button></td>
                </tr>";
            }
            return $data;
        }else{
            return response ()->json('<tr><td colspan="4">No active Admin found.</td></tr>'); // In case no data is found
        }
    }


    public function permissions(Request $request){
        return view('admin.permissions');
    }
    public function roles(Request $request){
        return view('admin.roles');
    }

    public function submitNewPermission(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => [ 'required', 'string'],]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = '';
            foreach ($errors->all() as $error) {
                $errorMessage = $error;
                break;
            }
            return json_encode([
                'status' => 'error',
                'message' => $errorMessage
            ]);
        }else {
            //Checking if permission exist
            $permissionExist = DB::table('permissions')->where('name', $request->name)->first();
            if ($permissionExist) {
                return json_encode([
                    'status' => 'error',
                    'message' => 'This permission exist in our database'
                ]);
            } else {
                DB::beginTransaction();
                $insert = DB::table('permissions')->insertGetId([
                    'name' => $request->name,
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'status' => 'ACTIVE'
                ]);
                if ($insert) {
                    DB::commit();
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Permission created successfully'
                    ]);
                } else {
                    DB::rollBack();
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Permission Not Created'
                    ]);
                }
            }
        }
    }

    public function submitAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => [ 'required', 'string'],
            'email' => [ 'required', 'email'],
            'user_type' => [ 'required'],
            'password' => [ 'required','max:20','min:5'],
            ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = '';
            foreach ($errors->all() as $error) {
                $errorMessage = $error;
                break;
            }
            return response()->json([
                'status' => 'error',
                'message' => $errorMessage
            ]);
        }else {

            //Check if password matches
            if($request->password != $request->repassword){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Passwords Mismatch'
                ]);

            }
            //Checking if permission exist
            $userExist = DB::table('users')->where('email', $request->email)->first();
            if ($userExist) {
                return json_encode([
                    'status' => 'error',
                    'message' => 'This user exist in our database'
                ]);
            } else {
                DB::beginTransaction();
                $insert = DB::table('users')->insertGetId([
                    'uuid' => Uuid::uuid4(),
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_type' => $request->user_type,
                    'password' => Hash::make($request->password),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'status' => 'ACTIVE'
                ]);
                if ($insert) {
                    DB::commit();
                    return json_encode([
                        'status' => 'success',
                        'message' => 'User registered successfully'
                    ]);
                } else {
                    DB::rollBack();
                    return json_encode([
                        'status' => 'error',
                        'message' => 'User Not Created'
                    ]);
                }
            }
        }
    }

    public function submitNewRole(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => [ 'required', 'string'],]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = '';
            foreach ($errors->all() as $error) {
                $errorMessage = $error;
                break;
            }
            return json_encode([
                'status' => 'error',
                'message' => $errorMessage
            ]);
        }else {
            //Checking if permission exist
            $roleExist = DB::table('roles')->where('name', $request->name)->first();
            if ($roleExist) {
                return json_encode([
                    'status' => 'error',
                    'message' => 'This role exist in our database'
                ]);
            } else {
                DB::beginTransaction();
                $insert = DB::table('roles')->insertGetId([
                    'name' => $request->name,
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'status' => 'ACTIVE'
                ]);
                if ($insert) {
                    DB::commit();
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Role inserted successfully'
                    ]);
                } else {
                    DB::rollBack();
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Role is not inserted'
                    ]);
                }
            }
        }
    }

    public function getAllActivePermissions(){
        $permissions = DB::table('permissions')->select('*')
            ->where('status', 'ACTIVE')
            ->orderBy('id', 'DESC')
            ->get();
        if($permissions->isNotEmpty()){
            $count = 0;
            $data = '';
            foreach ($permissions as $row){
                $count++;
                $data .= "
                <tr>
                  <td>{$count}</td>
                  <td>{$row->name}</td>
                  <td><button type=\"button\" class=\"btn btn-success\" onclick=\"permissionEditing({$row->id})\"
                  data-bs-toggle=\"modal\" data-bs-target=\"#editPermissionModal\">
                  Edit <i class=\"bi bi-pencil-square me-1\"></i></button></td>


                  <td><button type=\"button\" class=\"btn btn-danger confirm_deletion_ID\" onclick=\"permissionDeletion({$row->id})\"
                  data-bs-toggle=\"modal\" data-bs-target=\"#confirmPermissionDeletion\">Delete
                  <i class=\"bi bi-trash me-1\"></i></button></td>
                </tr>";
            }
            return $data;
        }else{
            return response ()->json('<tr><td colspan="4">No active permissions found.</td></tr>'); // In case no data is found
        }
    }

    public function getAllActiveRoles(){
        $roles = DB::table('roles')->select('*')
            ->where('status', 'ACTIVE')
            ->orderBy('id', 'DESC')
            ->get();
        if($roles->isNotEmpty()){
            $count = 0;
            $data = '';
            foreach ($roles as $row){
                $count++;
                $data .= "
                <tr>
                  <td>{$count}</td>
                  <td>{$row->name}</td>
                  <td><button type=\"button\" class=\"btn btn-success\" onclick=\"roleEditing({$row->id})\"
                  data-bs-toggle=\"modal\" data-bs-target=\"#editRoleModal\">
                  Edit <i class=\"bi bi-pencil-square me-1\"></i></button></td>


                  <td><button type=\"button\" class=\"btn btn-danger role_deletion_ID\" onclick=\"roleDeletion({$row->id})\"
                  data-bs-toggle=\"modal\" data-bs-target=\"#confirmRoleDeletion\">Delete
                  <i class=\"bi bi-trash me-1\"></i></button></td>
                </tr>";
            }
            return $data;
        }else{
            return response ()->json('<tr><td colspan="4">No active Role found.</td></tr>'); // In case no data is found
        }
    }


    public function deletePermission($permissionID){
        DB::beginTransaction();
        $updated = DB::table('permissions')
            ->where('id',$permissionID)
            ->update(['status'=> 'INACTIVE']);
        if($updated){
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Permission Removed Successfully"
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Remove this Permission'
            ]);
        }
    }

    public function deleteAdmin($adminUUID){
        DB::beginTransaction();
        $updated = DB::table('users')
            ->where('uuid', $adminUUID)
            ->update(['status'=> 'INACTIVE']);
        if($updated){
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Admin Removed Successfully"
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Remove this Admin'
            ]);
        }
    }
public function deleteRole($roleID){
        DB::beginTransaction();
        $updated = DB::table('roles')
            ->where('id',$roleID)
            ->update(['status'=> 'INACTIVE']);
        if($updated){
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Role Removed Successfully"
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Remove this Role'
            ]);
        }
    }

    public function fetchSelectedPermission($permissionID){
        DB::beginTransaction();
        $result = DB::table('permissions')
            ->where('id',$permissionID)
            ->where('status', 'ACTIVE')
            ->select('*')
            ->get();
        if($result->isNotEmpty()){
            $form = "";
            foreach ($result as $row){

            $form .= "
                    <div class=\"col-md-12\">
                        <div class=\"form-floating\">
                            <input type=\"text\" class=\"form-control\" name=\"permissionID\" id=\"floatingName\" value=\"{$row->id}\" placeholder=\"Permission Name\" hidden >
                            <input type=\"text\" class=\"form-control\" name=\"name\" id=\"floatingName\" value=\"{$row->name}\" placeholder=\"Permission Name\" required>
                            <label for=\"floatingName\">Permission Name</label>
                        </div>
                    </div>
                    <div class=\"text-center\">
                        <button type=\"submit\" id=\"submit-permission\" class=\"btn btn-primary\">Submit</button>
                        <button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\">Close</button>
                    </div>
            ";}}
         return $form;
    }
    public function fetchEditedAdmin($adminID){
        DB::beginTransaction();
        $result = DB::table('users')
            ->where('uuid',$adminID)
            ->where('status', 'ACTIVE')
            ->select('*')
            ->get();
        if($result->isNotEmpty()){
            $form = "";
            foreach ($result as $row){

            $form .= "
                     <div class=\"col-md-12\">
                        <div class=\"form-floating\">
                            <input type=\"text\" class=\"form-control\" name=\"uuid\" id=\"floatingName\" value=\" {$row->uuid} \" placeholder=\"Admin Name\" hidden required>
                            <input type=\"text\" class=\"form-control\" name=\"name\" id=\"floatingName\" value=\" {$row->name} \" placeholder=\"Admin Name\" required>
                            <label for=\"floatingName\">Admin FullName</label>
                        </div>
                    </div>
                    <div class=\"col-md-12\">
                        <div class=\"form-floating\">
                            <input type=\"email\" class=\"form-control\" name=\"email\" id=\"floatingName\" value=\" {$row->email} \" placeholder=\"Admin Email\" required>
                            <label for=\"floatingName\">Admin Email</label>
                        </div>
                    </div>

                    <div class=\"text-center\">
                        <button type=\"submit\" id=\"edit-admin\" class=\"btn btn-secondary\">Update</button>
                        <button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\">Close</button>
                    </div>
            ";}}
         return $form;
    }

    public function fetchSelectedRole($roleID){
        DB::beginTransaction();
        $result = DB::table('roles')
            ->where('id',$roleID)
            ->where('status', 'ACTIVE')
            ->select('*')
            ->get();
        if($result->isNotEmpty()){
            $form = "";
            foreach ($result as $row){

            $form .= "
                    <div class=\"col-md-12\">
                        <div class=\"form-floating\">
                            <input type=\"text\" class=\"form-control\" name=\"roleID\" id=\"floatingName\" value=\"{$row->id}\" placeholder=\"Role Name\" hidden >
                            <input type=\"text\" class=\"form-control\" name=\"name\" id=\"floatingName\" value=\"{$row->name}\" placeholder=\"Role Name\" required>
                            <label for=\"floatingName\">Role Name</label>
                        </div>
                    </div>
                    <div class=\"text-center\">
                        <button type=\"submit\" id=\"submit-role\" class=\"btn btn-primary\">Submit</button>
                        <button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\">Close</button>
                    </div>
            ";}}
         return $form;
    }

    public function updateSelectedAdmin(Request $request){
        $adminUUID = $request->uuid;
        $adminName = $request->name;
        $adminEmail = $request->email;

        $emailExist = DB::table('users')
            ->where('email',$adminEmail)
            ->where('uuid', '!=',$adminUUID)
            ->exists();
        if($emailExist){
            return response()->json([
                'status' => 'error',
                'message' => 'Another admin is using this email, please choose another email'
            ]);
        }else{

       $noChanges = DB::table('users')
           ->where('uuid',$adminUUID)
           ->where('name',$adminName)
           ->where('email',$adminEmail)
           ->exists();
        if($noChanges){
            return response()->json([
                'status' => 'error',
                'message' => 'No Changes has been made'
            ]);
        }else{



        DB::beginTransaction();
        $request = DB::table('users')
            ->where('uuid', $adminUUID)
            ->where('status', 'ACTIVE')
            ->update([
                'name' => $adminName,
                'email' => $adminEmail]);
        if($request){
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Admin Data Updated Successfully"
            ]);
        }else{
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Update Admin'
            ]);
        }
        }
    }
    }

    public function updateSelectedPermission(Request $request){
        $permissionID = $request->permissionID;
        $permissionName = $request->name;

        $exist = DB::table('permissions')->where('name',$permissionName)->first();
        if($exist){
            return response()->json([
                'status' => 'error',
                'message' => 'This permission already exists in the Dataset'
            ]);
        }else{

        DB::beginTransaction();
        $request = DB::table('permissions')
            ->where('id', $permissionID)
            ->where('status', 'ACTIVE')
            ->update(['name'=>$permissionName]);
        if($request){
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Permission Updated Successfully"
            ]);
        }else{
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Update this Permission'
            ]);
        }
        }
    }

    public function updateSelectedRole(Request $request){
        $roleID = $request->roleID;
        $roleName = $request->name;

        $exist = DB::table('roles')->where('name',$roleName)->first();
        if($exist){
            return response()->json([
                'status' => 'error',
                'message' => 'This role already exists in the Dataset'
            ]);
        }else{

        DB::beginTransaction();
        $request = DB::table('roles')
            ->where('id', $roleID)
            ->where('status', 'ACTIVE')
            ->update(['name'=>$roleName]);
        if($request){
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Role Updated Successfully"
            ]);
        }else{
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Update this Role'
            ]);
        }
        }
    }



    /*public function adminLogin(Request $request){
        return view('admin.login');

    }
    //LOGIN FUNCTIONALITIES
    public function adminAuthentication(Request $request){
    $remember = !empty($request->remember) ? true : false;
    if(Auth::attempt(['email' => $request->email, 'password'=>$request->password])){

    }else{

    }

    }*/
    public function adminRegister(Request $request){
        return view('admin.register');

    }
}
