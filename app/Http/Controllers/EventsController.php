<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\MockObject\Exception;

class EventsController extends Controller{
    public function eventsPost(Request $request){
        DB::beginTransaction();

        try {
            $events = DB::select("
            SELECT
                e.*,

                (SELECT COUNT(ec.id)
                 FROM events_comments ec
                 WHERE ec.eventID = e.id
                 AND (ec.status = 'ACTIVE')
                ) as total_comments
            FROM events e
            WHERE e.status = 'ACTIVE'
            ORDER BY e.id DESC
        ");
            if ($events) {
                DB::commit();

                $totalEvents = DB::table('events')->where('status', 'ACTIVE')->count();

                return view('admin.events_posts', [
                    'active_events' => $events,
                    'total_events' => $totalEvents,
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'title' => 'error',
                'message' => 'Something went wrong, Please Contact System Admin'
            ]);
        }
    }



    public function handlePostEventRequest(Request $request){
        $validate = Validator::make($request ->all(), [
            'title' => 'required|string|min:2|max:255',
            'category' => 'required|string|min:2|max:255',
            'priority' => ['required'],
            'date' => 'required',
            'description' => 'required|string|min:10',
            'picture' => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ]);
        if($validate->fails()){
            $errors = $validate->errors();
            $errorMessage = '';
            foreach ($errors->all() as $error) {
                $errorMessage = $error;
                break;
            }
            return response()->json([
                'response_type' => 'warning',
                'title' => 'Validation Failed',
                'message' => $errorMessage,
            ]);
        }
        DB::beginTransaction();
       try{
            $picture = $request->file('picture');
            $picture_name = time().'_'.$picture->getClientOriginalName();
            $upload = $picture->storeAs('uploads',$picture_name);
            if(!$upload){
                return response()->json([
                    'response_type' => 'warning',
                    'title' => 'Sorry..!',
                    'message' => 'Upload failed, Please Contact System Developer'
                ]);
            }else{
                $inserting = DB::table('events')->insert([
                    'post_title' => $request->input('title'),
                    'category' => $request->input('category'),
                    'priority' => $request->input('priority'),
                    'post_date' => $request->input('date'),
                    'post_descriptions' => $request->input('description'),
                    'picture'     => $picture_name,
                    'status'    =>  'ACTIVE',
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
                if($inserting){
                    DB::commit();
                    return response()->json([
                        'response_type' => 'success',
                        'title' => 'Well Done..!',
                        'message' => 'Event Post Successfully Published'
                    ]);
                }else{
                    DB::rollBack();
                    return response()->json([
                        'response_type' => 'warning',
                        'title' => 'Sorry..!',
                        'message' => 'Request Failed, Please Contact System Developer'
                    ]);
                }
            }
       }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'response_type' => 'error',
                'title' => 'Sorry..!',
                'message' => 'Transaction failed, Please Contact Developer for the help'
            ]);
        }
    }
    public function handleEditEvent(Request $request){
        $validate = Validator::make($request ->all(), [
            'title' => 'required|string|min:2|max:255',
            'category' => 'required|string|min:2|max:255',
            'priority' => ['required'],
            'date' => 'required',
            'description' => 'required|string|min:10',
            'picture' => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ]);
        if($validate->fails()){
            $errors = $validate->errors();
            $errorMessage = '';
            foreach ($errors->all() as $error) {
                $errorMessage = $error;
                break;
            }
            return response()->json([
                'response_type' => 'warning',
                'title' => 'Validation Failed',
                'message' => $errorMessage,
            ]);
        }
        DB::beginTransaction();
       try{
            $picture = $request->file('picture');
            $picture_name = time().'_'.$picture->getClientOriginalName();
            $upload = $picture->storeAs('uploads',$picture_name);
            if(!$upload){
                return response()->json([
                    'response_type' => 'warning',
                    'title' => 'Sorry..!',
                    'message' => 'Upload failed, Please Contact System Developer'
                ]);
            }else{
                $inserting = DB::table('events')
                    ->where('id',$request->input('event_id') )
                    ->update([
                    'post_title' => $request->input('title'),
                    'category' => $request->input('category'),
                    'priority' => $request->input('priority'),
                    'post_date' => $request->input('date'),
                    'post_descriptions' => $request->input('description'),
                    'picture'     => $picture_name,
                    'status'    =>  'ACTIVE',
                    'updated_at'          => now(),
                ]);
                if($inserting){
                    DB::commit();
                    return response()->json([
                        'response_type' => 'success',
                        'title' => 'Well Done..!',
                        'message' => 'Event Post Successfully Updated'
                    ]);
                }else{
                    DB::rollBack();
                    return response()->json([
                        'response_type' => 'warning',
                        'title' => 'Sorry..!',
                        'message' => 'Request Failed, Please Contact System Developer'
                    ]);
                }
            }
       }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'response_type' => 'error',
                'title' => 'Sorry..!',
                'message' => 'Transaction failed, Please Contact Developer for the help'
            ]);
        }
    }
    public function handleDeleteEvent($eventID){

        DB::beginTransaction();
        try{
        $updated = DB::table('events')
            ->where('id',$eventID)
            ->update(['status'=> 'INACTIVE']);
        if($updated){
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Event Removed Successfully"
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Remove this Event'
            ]);
        }
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, Contact system developer'
            ]);
        }

    }


    public function fetchPostComments($eventID){
        try {
            $comments = DB::table('events_comments')
                ->where('eventID', $eventID)
                ->where(function ($query) {
                    $query->where('status', 'ACTIVE')
                        ->orWhere('status', 'READED');
                })
                ->limit(50)
                ->orderBy('id', 'DESC')
                ->get();
            if ($comments->isEmpty()) {
                return "<p> No comment available for this post </p>";
            } else {
                $comment = "";
                foreach ($comments as $row) {
                    $readStatus = !$row->read_status ? 'New Comment' : 'Old Comment';
                    $color = !$row->read_status ? 'success' : 'secondary';
                    $labelText = $row->read_status ? 'Mark as Unread' : 'Mark as Read';
                    $checkStatus = $row->read_status ? 'checked': '';

                    $comment .= "
                <div class=\"d-flex flex-start mt-3 mb-3\" id=\"comment-{$row->id}\">
                    <img class=\"rounded-circle shadow-1-strong me-3\"
                         src=\"https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(23).webp\" alt=\"avatar\" width=\"60\"
                         height=\"60\" />
                    <div>
                        <h6 class=\"fw-bold mb-1\">Maggie Marsh</h6>
                        <div class=\"d-flex align-items-center mb-3\">
                            <p class=\"mb-0\">
                               <i> March 07, 2021</i>
                            <span class=\"badge bg-{$color}\">{$readStatus}</span>
                            </p>
                            <a href=\"#\" class=\"link-muted\"><i class=\"fas fa-pencil-alt ms-2\"></i></a>
                            <a href=\"#!\" class=\"link-muted\"><i class=\"fas fa-redo-alt ms-2\"></i></a>
                            <a href=\"#!\" class=\"link-muted\"><i class=\"fas fa-heart ms-2\"></i></a>
                        </div>
                        <p class=\"mb-0\">{$row->comment}</p><br>

                    <p>


                      <input class=\"form-check-input markAsReadCheckbox\"
                       data-id=\"{$row->id}\"
                       type=\"checkbox\"
                       id=\"gridCheck1\"
                       style='border: 1px solid grey'
                       {$checkStatus}
                      <label class=\"form-check-label text-primary check-label\" for=\"gridCheck1\">
                         {$labelText}
                      </label>  |

                      <a href='#' class=\"text-danger\"
                        onclick=\"commentDeletion('{$row->id}')\">
                        <i class=\"fas bi-trash-fill ms-2\" data-id=''></i>
                        Remove
                      </a>

                       <a href='#' class=\"text-success\" onclick=\"replyToComment({$row->id})\">
                        <i class=\"fas bi-reply-fill ms-2\" ></i> Reply
                      </a>
                      </p>


                    </div>
                    <div id=\"replyMessage\" style=\"display:none; margin-top: 10px;\"></div>
                </div>



                <hr class=\"my-0\"/> ";
                }
                return $comment;
            }
        }catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "Something Went Wrong | Failed to mark the comment"
            ]);
        }

        }




        public function handleMarkAsRead($commentID){
        DB::beginTransaction();
        try{
            $updateReadStatus = DB::table('events_comments')
                ->where('id', $commentID)
                ->update([
                    'status' => 'READED',
                    'read_status' => true
                ]);
            if($updateReadStatus){
                DB::commit();
                return response()->json([
                    "status" => "success",
                    "message" => "Comment Marked as Read"
                ]);
            }else{
                DB::rollBack();
                return response()->json([
                    "status" => "warning",
                    "message" => "failed to mark the comment"
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "Something Went Wrong | Failed to mark the comment"
            ]);

        }

        }


    public function handleMarkAsUnread($commentID){
        DB::beginTransaction();
        try{
            $updateReadStatus = DB::table('events_comments')
                ->where('id', $commentID)
                ->update([
                    'status' => 'ACTIVE',
                    'read_status' => false
                ]);
            if($updateReadStatus){
                DB::commit();
                return response()->json([
                    "status" => "success",
                    "message" => "Comment Marked as Unread"
                ]);
            }else{
                DB::rollBack();
                return response()->json([
                    "status" => "error",
                    "message" => "failed to Unmark the comment"
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "Something Went Wrong | Failed to unmark the comment"
            ]);
        }
    }

    public function handleDeleteComment( $commentID){
        $deleted = DB::table('events_comments')
            ->where('id',$commentID)
            ->update([
                'status' => 'INACTIVE'
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

    public function handleReplyToComment(Request $request, $commentID){
        $reply_message = $request->input('reply');
        $replyed = DB::table('events_comments')
            ->where('id',$commentID)
            ->update([
                'reply' => $reply_message
            ]);
        if($replyed){
            return response()->json([
                'status' => 'success',
                'reply' => $reply_message
            ]);
        }else{
            return response()->json([
                'status' => 'error',
            ]);
        }

    }

    public function handleCampaigns(Request $request){
        try {
            $campaigns = DB::table('campaigns')
                ->where('status', 'ACTIVE')
                ->orderBy('id', 'DESC')
                ->get();
            if ($campaigns->isNotEmpty()) {
                $total_campaigns = DB::table('campaigns')->where('status', 'ACTIVE')->count();
                return view('admin.campaigns_posts', [
                    'active_campaigns' => $campaigns,
                    'total_campaigns' => $total_campaigns,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'warning',
                'message' => 'Something went wrong, Please Contact System Admin'
            ]);
        }
    }

    public function handlePostCampaignRequest(Request $request)
    {
        // Step 1: Validate the incoming request
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|min:2|max:255',
            'popup'        => 'required',
            'startingDate' => 'required|date',
            'endingDate'   => 'required|date',
            'description'  => 'required|string|min:10',
            'picture'      => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_type' => 'warning',
                'title'         => 'Validation Failed',
                'message'       => $validator->errors()->first(),  // Gets the first error message
            ]);
        }

        DB::beginTransaction();

        try {
            $picture = $request->file('picture');
            $picture_name = time() . '_' . $picture->getClientOriginalName();

            $uploadPath = public_path('uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $upload = $picture->move($uploadPath, $picture_name);
            if (!$upload) {
                throw new \Exception('Image upload failed.');
            }
            DB::table('campaigns')->insert([
                'title'        => $request->input('title'),
                'popup'        => $request->input('popup'),
                'startingDate' => $request->input('startingDate'),
                'endingDate'   => $request->input('endingDate'),
                'descriptions' => $request->input('description'),
                'picture'      => $picture_name,
                'status'       => 'ACTIVE',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
            DB::commit();
            return response()->json([
                'response_type' => 'success',
                'title'         => 'Well Done!',
                'message'       => 'Campaign Successfully Published',
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


    public function handleDeleteCampaign($campaignID){
        $deleted = DB::table('campaigns')
            ->where('id',$campaignID)
            ->update([
                'status' => 'INACTIVE',
                'updated_at' => now()
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

    public function fetchEditedEvent($eventID){
        DB::beginTransaction();
        $result = DB::table('events')
            ->where('id',$eventID)
            ->where('status', 'ACTIVE')
            ->select('*')
            ->get();

        if($result->isNotEmpty()){
            $form = "";
            foreach ($result as $row){

                $form .= "
                    <div class=\"form-floating mb-3\">
                        <input type=\"hidden\" class=\"form-control\" value=\"{$row->id}\" name=\"event_id\" id=\"floatingInput\" placeholder=\"Enter title of the post\" style='font-size: 14px'>
                        <input type=\"text\" class=\"form-control\" value=\"{$row->post_title}\" name=\"title\" id=\"floatingInput\" placeholder=\"Enter title of the post\" style='font-size: 14px'>
                        <label for=\"floatingInput\">Event Title</label>
                    </div>

                    <div class=\"col-md-6 form-floating mb-6\">
                        <select class=\"form-select\" id=\"floatingSelect\" name=\"category\" aria-label=\"Floating label select example\" style='font-size: 14px'>
                            <option value=\"Recent Event\" ".($row->category=='Recent Event'? 'selected' : '')." >Recent Event</option>
                            <option value=\"Upcoming Event\" ".($row->category=='Upcoming Event'? 'selected' : '').">Upcoming Event</option>
                        </select>
                        <label for=\"floatingSelect\">Post Category</label>
                    </div>
                    <div class=\"col-md-6 form-floating mb-6\">
                        <select class=\"form-select\" id=\"floatingSelect\" name=\"priority\" aria-label=\"Floating label select example\" style='font-size: 14px'>
                            <option value=\"Top\" ".($row->priority == 'Top'? 'selected' : '').">Top Event</option>
                            <option value=\"Normal\" ".($row->priority == 'Normal'? 'selected' : '').">Normal Event</option>
                        </select>
                        <label for=\"floatingSelect\">Post Priority</label>
                    </div>

                    <div class=\"col-md-12\">
                        <input type=\"date\" class=\"form-control\" value=\"{$row->post_date}\" name=\"date\" placeholder=\"Date of Event\" style='font-size: 14px'>
                    </div>

                    <div class=\"col-md-12\ justify-content-center\">
                        <img src=\"{{asset('storage/' . $row->picture) }}\" alt=\"Event Image\" class=\"img-thumbnail\" style=\"width: 150px; height: auto;\">
                        <input type=\"file\" class=\"form-control\" name=\"picture\" value=\"{$row->picture}\" placeholder=\"Picture\">
                    </div>

                    <div class=\"form-floating mb-3\">
                        <textarea class=\"form-control\" name=\"description\" placeholder=\"Leave a comment here\" id=\"floatingTextarea\" style=\"height: 150px; font-size: 13px\">{$row->post_descriptions}</textarea>
                        <label for=\"floatingTextarea\">Post Description</label>
                    </div>
                    <div class=\"text-center\">
                        <button type=\"submit\" id=\"edit_event_button\" class=\"btn btn-primary\">Update Event</button>
                        <button type=\"reset\" class=\"btn btn-secondary\">Reset</button>
                    </div>
            ";}}
        return $form;
    }

    public function fetchEditedCampaign($campaignID) {
        DB::beginTransaction();
        $result = DB::table('campaigns')
            ->where('id', $campaignID)
            ->where('status', 'ACTIVE')
            ->select('*')
            ->get();

        if ($result->isNotEmpty()) {
            $form = "";
            foreach ($result as $row) {

                $form .= "
                <div class=\"col-12\">
                    <label for=\"inputNanme4\" class=\"form-label campaign-label\">Campaign Title</label>
                    <textarea class=\"form-control campaign-form\" name=\"title\" placeholder=\"Add the Campaign Descriptions\" id=\"floatingTextarea\" style=\"height: 100px;\">{$row->title}</textarea>
                </div>

                <input type=\"hidden\" name=\"id\" value=\"{$row->id}\">

                <div class=\"col-12\">
                    <label for=\"inputPassword4\" class=\"form-label campaign-label\">Nature of the campaign</label>
                    <select class=\"form-select campaign-form\" name=\"popup\">
                        <option value=\"1\" ".($row->popup ? 'selected' : '').">Popup</option>
                        <option value=\"0\" ".(!$row->popup ? 'selected' : '').">Not Popup</option>
                    </select>
                </div>

                <div class=\"col-6\">
                    <label for=\"inputEmail4\" class=\"form-label campaign-label\">Starting Date</label>
                    <input type=\"date\" class=\"form-control campaign-form\" name=\"startingDate\" value=\"".date('Y-m-d', strtotime($row->startingDate))."\" id=\"inputEmail4\">
                </div>

                <div class=\"col-6\">
                    <label for=\"inputEmail4\" class=\"form-label campaign-label\">Ending Date</label>
                    <input type=\"date\" value=\"".date('Y-m-d', strtotime($row->endingDate))."\" class=\"form-control campaign-form\" name=\"endingDate\">
                </div>

                <div class=\"col-12\">
                    <label for=\"inputAddress\" class=\"form-label campaign-label\">Campaign Descriptions</label>
                    <textarea class=\"form-control campaign-form\" name=\"description\" placeholder=\"Add the Campaign Descriptions\" id=\"floatingTextarea\" style=\"height: 100px;\">{$row->descriptions}</textarea>
                </div>

                <div class=\"text-center\">
                    <button type=\"submit\" id=\"edit_campaign_button\" class=\"btn btn-primary\">Save Changes</button>
                    <button type=\"reset\" class=\"btn btn-secondary\">Reset</button>
                </div>";
            }
        }
        return $form;
    }

    public function handleEditCampaignRequest(Request $request) {
        $campaignID = $request->id;
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|min:2|max:255',
            'popup'        => 'required',
            'startingDate' => 'required|date',
            'endingDate'   => 'required|date',
            'description'  => 'required|string|min:10',
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
            $existingCampaign = DB::table('campaigns')
                ->where('id', $campaignID)
                ->first();
            # Check if any changes were made
            $changesMade = false;
            $newData = [
                'title'        => $request->input('title'),
                'popup'        => $request->input('popup'),
                'startingDate' => $request->input('startingDate'),
                'endingDate'   => $request->input('endingDate'),
                'descriptions' => $request->input('description'),
            ];
            foreach ($newData as $key => $value) {
                if ($existingCampaign->$key != $value) {
                    $changesMade = true;
                    break;
                }
            }
            if (!$changesMade) {
                return response()->json([
                    'response_type' => 'info',
                    'title'         => 'No Changes',
                    'message'       => 'No changes were made to the campaign.',
                ]);
            }
            DB::table('campaigns')
                ->where('id', $campaignID)
                ->update([
                    'title'        => $request->input('title'),
                    'popup'        => $request->input('popup'),
                    'startingDate' => $request->input('startingDate'),
                    'endingDate'   => $request->input('endingDate'),
                    'descriptions' => $request->input('description'),
                    'updated_at'   => now(),
                ]);

            DB::commit();
            return response()->json([
                'response_type' => 'success',
                'title'         => 'Well Done!',
                'message'       => 'Campaign Successfully Updated',
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


