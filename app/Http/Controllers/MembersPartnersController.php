<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\MockObject\Exception;

class MembersPartnersController extends Controller{

  #FETCHING ALL TEAM MEMBERS
    public function fetchTeamMembers(Request $request){
        try {
        $members = DB::table('team_members')
            ->where('status', 'ACTIVE')
            ->orderBy('id', 'DESC')
            ->get();
        if($members){
            $total_members = DB::table('team_members')
                ->where('status', 'ACTIVE')
                ->count();
            return view('admin.team_members',
                ['teamMembers' => $members, 'totalMembers' => $total_members ]);
        }
    }catch (\Exception $e){
            return response()->json([
                'title' => 'error',
                'message' => 'Something went wrong, Please Contact System Admin'
            ]);
        }
    }

    public function handlePostTeamMemberRequest(Request $request){
        // Step 1: Validate the incoming request
        $validator = Validator::make($request->all(), [
            'firstname'       => 'required|string|min:2|max:255',
            'lastname'        => 'required|string|min:2|max:255',
            'email'           =>  [ 'required', 'email'],
            'phoneNo'         => 'required|string|min:8|max:15',
            'position'        => 'required|string|min:2|max:255',
            'project'         => 'required|string|min:2|max:255',
            'profile'     => 'required|string|min:10',
            'picture'         => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_type' => 'warning',
                'title'         => 'Validation Failed',
                'message'       => $validator->errors()->first(),
            ]);
        }

        //Checking if member exists
        $exist = DB::table('team_members')
            ->where('firstname', $request->firstname)
            ->where('lastname', $request->lastname)
            ->where('email', $request->email)
            ->where('phoneNo', $request->phoneNo)
            ->where('status', "ACTIVE")
            ->first();
        if($exist){
            return response()->json([
                'response_type' => 'info',
                'title'         => 'Member Exist',
                'message'       => "Sorry! This active member already registered",
            ]);
        }else{


        DB::beginTransaction();

       try {
            $picture = $request->file('picture');
            $picture_name = time() . '_' . $picture->getClientOriginalName();

            $uploadPath = public_path('team');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $upload = $picture->move($uploadPath, $picture_name);
            if (!$upload) {
                throw new \Exception('Image upload failed.');
            }
            DB::table('team_members')->insert([
                'firstname'    => $request->input('firstname'),
                'lastname'     => $request->input('lastname'),
                'email'        => $request->input('email'),
                'phoneNo'      => $request->input('phoneNo'),
                'position'     => $request->input('position'),
                'project'      => $request->input('project'),
                'profile'  => $request->input('profile'),
                'picture'      => $picture_name,
                'status'       => 'ACTIVE',
            ]);
            DB::commit();
            return response()->json([
                'response_type' => 'success',
                'title'         => 'Well Done!',
                'message'       => 'Team Member Successfully Published',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'response_type' => 'warning',
                'title'         => 'Error',
                'message'       => $e->getMessage(),
            ]);
        }
    }
    }

    public function handleDeleteTeamMemberRequest($memberID){
        $deleted = DB::table('team_members')
            ->where('id',$memberID)
            ->update([
                'status' => 'INACTIVE',
            ]);
        if($deleted){
            return response()->json([
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
            ]);
        }

    }

    public function fetchEditedMember($memberID){
        DB::beginTransaction();
        $result = DB::table('team_members')
            ->where('id',$memberID)
            ->where('status', 'ACTIVE')
            ->select('*')
            ->get();
        if($result->isNotEmpty()){
            $form = "";
            foreach ($result as $row){

                $form .= "

                  <div class=\"col-12\">
                        <label for=\"inputNanme4\" class=\"form-label campaign-label\">FirstName</label>
                        <input type=\"text\" class=\"form-control campaign-form\" value=\" {$row->firstname} \" name=\"firstname\" id=\"inputNanme4\">
                    </div>

                    <input type=\"hidden\" name=\"id\" value=\"{$row->id}\">

                    <div class=\"col-12\">
                        <label for=\"inputNanme4\" class=\"form-label campaign-label\">LastName</label>
                        <input type=\"text\" class=\"form-control campaign-form\" value=\" {$row->lastname} \"  name=\"lastname\" id=\"inputNanme4\">
                    </div>

                    <div class=\"col-12\">
                        <label for=\"inputPassword4\" class=\"form-label campaign-label\">Project</label>
                        <select class=\"form-select campaign-form\" name=\"project\">
                            <!---WILL DISPLAY PROJECTS FROM DB--->
                            <option value=\"CHANGARAWE\" ".($row->project == 'CHANGARAWE'? 'selected' : '').">CHANGARAWE</option>
                            <option value=\"MTOTO KWANZA\" ".($row->project == 'MTOTO KWANZA'? 'selected' : '').">MTOTO KWANZA</option>
                            <option value=\"AFYA YANGU MAISHA YANGU\" ".($row->project == 'AFYA YANGU MAISHA YANGU'? 'selected' : '').">AFYA YANGU MAISHA YANGU</option>
                        </select>
                    </div>

                    <div class=\"col-12\">
                        <label for=\"inputPassword4\" class=\"form-label campaign-label\">Position</label>
                        <select class=\"form-select campaign-form\" name=\"position\">
                            <!---WILL DISPLAY PROJECTS FROM DB--->
                            <option value=\"EXECUTIVE DIRECTOR\" ".($row->position == 'EXECUTIVE DIRECTOR'? 'selected' : '').">EXECUTIVE DIRECTOR</option>
                            <option value=\"PROGRAMS OFFICER\" ".($row->position == 'PROGRAMS OFFICER'? 'selected' : '').">PROGRAMS OFFICER</option>
                            <option value=\"ACCOUNTANT OFFICER\" ".($row->position == 'ACCOUNTANT OFFICER'? 'selected' : '').">ACCOUNTANT OFFICER</option>
                            <option value=\"PROCUREMENT OFFICER\" ".($row->position == 'PROCUREMENT OFFICER'? 'selected' : '').">PROCUREMENT OFFICER</option>
                            <option value=\"IT OFFICER\" ".($row->position == 'IT OFFICER'? 'selected' : '').">IT OFFICER</option>
                            <option value=\"PROJECT OFFICER\" ".($row->position == 'PROJECT OFFICER'? 'selected' : '').">PROJECT OFFICER</option>
                            <option value=\"OFFICE SECRETARY\" ".($row->position == 'OFFICE SECRETARY'? 'selected' : '').">OFFICE SECRETARY</option>
                            <option value=\"DRIVER \" ".($row->position == 'DRIVER'? 'selected' : '').">DRIVER</option>
                            <option value=\"ENVIRONMENTAL ATTENDANT\" ".($row->position == 'ENVIRONMENTAL ATTENDANT'? 'selected' : '').">ENVIRONMENTAL ATTENDANT</option>
                            <option value=\"SECURITY GUARD\" ".($row->position == 'SECURITY GUARD'? 'selected' : '').">SECURITY GUARD</option>
                            <option value=\"VOLUNTEER\" ".($row->position == 'VOLUNTEER'? 'selected' : '').">VOLUNTEER</option>
                        </select>
                    </div>

                    <div class=\"col-6\">
                        <label for=\"inputEmail4\" class=\"form-label campaign-label\">Email</label>
                        <input type=\"email\" class=\"form-control campaign-form\" value=\" {$row->email} \" name=\"email\" id=\"inputEmail4\">
                    </div>
                    <div class=\"col-6\">
                        <label for=\"inputEmail4\" class=\"form-label campaign-label\">Mobile Number</label>
                        <input type=\"text\" class=\"form-control campaign-form\" value=\" {$row->phoneNo} \" name=\"phoneNo\" id=\"inputEmail4\">
                    </div>
                    <div class=\"col-12\">
                        <label for=\"inputAddress\" class=\"form-label campaign-label\">Profile Descriptions</label>
                        <textarea class=\"form-control campaign-form\" name=\"profile\" placeholder=\"Add your simple profile \" id=\"floatingTextarea\" style=\"height: 100px;\"> {$row->profile}</textarea>
                    </div>
                    <div class=\"text-center\">
                        <button type=\"submit\" id=\"edit_member_button\" class=\"btn btn-primary\">Save Changes</button>
                        <button type=\"reset\" class=\"btn btn-secondary\">Reset</button>
                    </div>

                        ";}}
        return $form;
    }

    public function handleEditMemberRequest(Request $request) {
        $memberID = $request->id;
        $validator = Validator::make($request->all(), [
            'firstname'       => 'required|string|min:2|max:255',
            'lastname'        => 'required|string|min:2|max:255',
            'email'           =>  [ 'required', 'email'],
            'phoneNo'         => 'required|string|min:8|max:15',
            'position'        => 'required|string|min:2|max:255',
            'project'         => 'required|string|min:2|max:255',
            'profile'     => 'required|string|min:10'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response_type' => 'warning',
                'title'         => 'Validation Failed',
                'message'       => $validator->errors()->first(),  // Get the first error message
            ]);
        }
        DB::beginTransaction();
        try {
            $existingMember = DB::table('team_members')
                ->where('id', $memberID)
                ->first();
            # Check if any changes were made
            $changesMade = false;
            $newData = [
                'firstname'    => $request->input('firstname'),
                'lastname'     => $request->input('lastname'),
                'email'        => $request->input('email'),
                'phoneNo'      => $request->input('phoneNo'),
                'position'     => $request->input('position'),
                'project'      => $request->input('project'),
                'profile'      => $request->input('profile'),
            ];
            foreach ($newData as $key => $value) {
                if ($existingMember->$key != $value) {
                    $changesMade = true;
                    break;
                }
            }
            if (!$changesMade) {
                return response()->json([
                    'response_type' => 'info',
                    'title'         => 'No Changes',
                    'message'       => 'No changes were made to this member.',
                ]);
            }
            DB::table('team_members')
                ->where('id', $memberID)
                ->update([
                    'firstname'    => $request->input('firstname'),
                    'lastname'     => $request->input('lastname'),
                    'email'        => $request->input('email'),
                    'phoneNo'      => $request->input('phoneNo'),
                    'position'     => $request->input('position'),
                    'project'      => $request->input('project'),
                    'profile'      => $request->input('profile'),
                ]);

            DB::commit();
            return response()->json([
                'response_type' => 'success',
                'title'         => 'Well Done!',
                'message'       => 'Team member Successfully Updated',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'response_type' => 'error',
                'title'         => 'Error',
                'message'       => $e->getMessage(),
            ]);
        }
    }


    ////////////////////////PARTNERS SECTION//////////////////////////////
    public function fetchPartners(Request $request){
        try {
            $partners = DB::table('partners')
                ->where('status', 'ACTIVE')
                ->orderBy('id', 'DESC')
                ->get();
            if($partners){
                $total_partners = DB::table('partners')
                    ->where('status', 'ACTIVE')
                    ->count();
                return view('admin.partners',
                    ['partners' => $partners, 'totalPartners' => $total_partners ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'title' => 'error',
                'message' => 'Something went wrong, Please Contact System Admin'
            ]);
        }
    }


    public function handlePostPartnersRequest(Request $request){
        $validator = Validator::make($request->all(), [
            'name'            => 'required|string|min:2|max:255',
            'description'     => 'required|string|min:10',
            'logo'            => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_type' => 'warning',
                'title'         => 'Validation Failed',
                'message'       => $validator->errors()->first(),
            ]);
        }

        //Checking if member exists
        $exist = DB::table('partners')
            ->where('name', $request->name)
            ->where('description', $request->description)
            ->where('status', "ACTIVE")
            ->first();
        if($exist){
            return response()->json([
                'response_type' => 'info',
                'title'         => 'Member Exist',
                'message'       => "Sorry! This active partner already registered",
            ]);
        }else{
            DB::beginTransaction();
            try {
                $picture = $request->file('logo');
                $picture_name = time() . '_' . $picture->getClientOriginalName();

                $uploadPath = public_path('partners_logo');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $upload = $picture->move($uploadPath, $picture_name);
                if (!$upload) {
                    throw new \Exception('Image upload failed.');
                }
                DB::table('partners')->insert([
                    'name'    => $request->input('name'),
                    'description'     => $request->input('description'),
                    'logo'      => $picture_name,
                    'status'       => 'ACTIVE',
                ]);
                DB::commit();
                return response()->json([
                    'response_type' => 'success',
                    'title'         => 'Well Done!',
                    'message'       => 'Partner Successfully Published',
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'response_type' => 'warning',
                    'title'         => 'Error',
                    'message'       => $e->getMessage(),
                ]);
            }
        }
    }

    public function handleDeletePartnerRequest($partnerID){
        $deleted = DB::table('partners')
            ->where('id',$partnerID)
            ->update([
                'status' => 'INACTIVE',
            ]);
        if($deleted){
            return response()->json([
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
            ]);
        }

    }
    public function fetchEditedPartner($partnerID){
        DB::beginTransaction();
        $result = DB::table('partners')
            ->where('id',$partnerID)
            ->where('status', 'ACTIVE')
            ->select('*')
            ->get();
        if($result->isNotEmpty()){
            $form = "";
            foreach ($result as $row){
                $form .= "
                  <div class=\"col-12\">
                        <label for=\"inputNanme4\" class=\"form-label partner-label\">Partner Name</label>
                        <input type=\"text\" class=\"form-control partner-form\" value=\" {$row->name}\"  name=\"name\" id=\"inputNanme4\">
                    </div>

                    <input type=\"hidden\" name=\"id\" value=\"{$row->id}\">


                    <div class=\"col-12\">
                        <label for=\"inputAddress\" class=\"form-label partner-label\">Profile Descriptions</label>
                        <textarea class=\"form-control partner-form\" name=\"description\" placeholder=\"Add Partner profile \" id=\"floatingTextarea\" style=\"height: 100px;\"> {$row->description}</textarea>
                    </div>
                    <div class=\"text-center\">
                        <button type=\"submit\" id=\"edit_partner_button\" class=\"btn btn-primary\">Save Changes</button>
                        <button type=\"reset\" class=\"btn btn-secondary\">Reset</button>
                    </div>

                        ";}}
        return $form;
    }

    public function handleEditPartnerRequest(Request $request) {
        $partnerID = $request->id;
        $validator = Validator::make($request->all(), [
            'name'            => 'required|string|min:2|max:255',
            'description'     => 'required|string|min:10'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response_type' => 'warning',
                'title'         => 'Validation Failed',
                'message'       => $validator->errors()->first(),  // Get the first error message
            ]);
        }
        DB::beginTransaction();
        try {
            $existingPartner = DB::table('partners')
                ->where('id', $partnerID)
                ->first();
            # Check if any changes were made
            $changesMade = false;
            $newData = [
                'name'    => $request->input('name'),
                'description'      => $request->input('description'),
            ];
            foreach ($newData as $key => $value) {
                if ($existingPartner->$key != $value) {
                    $changesMade = true;
                    break;
                }
            }
            if (!$changesMade) {
                return response()->json([
                    'response_type' => 'info',
                    'title'         => 'No Changes',
                    'message'       => 'No changes were made to this partner.',
                ]);
            }
            DB::table('partners')
                ->where('id', $partnerID)
                ->update([
                    'name'             => $request->input('name'),
                    'description'      => $request->input('description'),
                ]);

            DB::commit();
            return response()->json([
                'response_type' => 'success',
                'title'         => 'Well Done!',
                'message'       => 'Partner Successfully Updated',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'response_type' => 'error',
                'title'         => 'Error',
                'message'       => $e->getMessage(),
            ]);
        }
    }














}
