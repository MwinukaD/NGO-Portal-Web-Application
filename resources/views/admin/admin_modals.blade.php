<!--ADD PERMISSION MODAL -->
<div class="modal fade" id="addPermissionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
            <h5 class="card-title">Create New Permission</h5>
                <form class="row g-3" id="permission-register-form">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="floatingName" placeholder="Permission Name" required>
                            <label for="floatingName">Permission Name</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="submit-permission" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--ADD NEW ADMIN MODAL-->
<div class="modal fade" id="addAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
            <h5 class="card-title text-secondary fw-bold"><i class="bi bi-person-bounding-box me-1"></i> Add New Admin</h5>
                <form class="row g-3" id="admin-register-form">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="floatingName" placeholder="Admin Name" required>
                            <label for="floatingName">Admin FullName</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="floatingName" placeholder="Admin Email" required>
                            <label for="floatingName">Admin Email</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="inputPassword4" class="form-label campaign-label">User type</label>
                        <select class="form-select campaign-form" name="user_type">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="floatingName" placeholder="Create Password" required>
                            <label for="floatingName">Create Password</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="repassword" id="floatingName" placeholder="Repeat Password" required>
                            <label for="floatingName">Repeat Password</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="submit-admin" class="btn btn-secondary">Create Admin</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!---CONFIRM PERMISSION DELETION-->
<div class="modal fade" id="confirmPermissionDeletion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title  p-2 text-danger"><b>Confirm Deletion!</b></h5>

                <p class="p-2">Are you sure you want to delete this item?, <b>NB:</b> You can not UNDO this process after you confirm deletion.</p>
                <div class="p-2">
                    <button type="button" class="btn btn-danger" id="clear-permission" data-bs-dismiss="modal">I'm Not Sure</button>
                    <button type="button" class="btn btn-success confirm-permission-deletion">I'm Sure</button>
                    <button class="btn btn-primary" type="button" id="permission-delete-loader" disabled style="display: none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Deleting...
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>


<!---CONFIRM PERMISSION DELETION-->
<div class="modal fade" id="confirmRoleDeletion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title  p-2 text-danger"><b>Confirm Deletion!</b></h5>

                <p class="p-2">Are you sure you want to delete this item?, <b>NB:</b> You can not UNDO this process after you confirm deletion.</p>
                <div class="p-2">
                    <button type="button" class="btn btn-danger" id="clear-role" data-bs-dismiss="modal">I'm Not Sure</button>
                    <button type="button" class="btn btn-success confirm-role-deletion">I'm Sure</button>
                    <button class="btn btn-primary" type="button" id="role-delete-loader" disabled style="display: none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Deleting...
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>

<!---CONFIRM PERMISSION DELETION-->
<div class="modal fade" id="confirmAdminDeletion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title  p-2 text-danger"><b>Confirm Deletion!</b></h5>

                <p class="p-2">Are you sure you want to delete this admin?, <b>NB:</b> You can not UNDO this process after you confirm deletion.</p>
                <div class="p-2">
                    <button type="button" class="btn btn-danger" id="clear-admin" data-bs-dismiss="modal">I'm Not Sure</button>
                    <button type="button" class="btn btn-success confirm-admin-deletion">I'm Sure</button>
                    <button class="btn btn-primary" type="button" id="admin-delete-loader" disabled style="display: none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Deleting...
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>

<!---CONFIRM PERMISSION DELETION-->
<div class="modal fade" id="confirmEventDeletion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title  p-2 text-danger"><b>Confirm Deletion!</b></h5>

                <p class="p-2">Are you sure you want to delete this event?, <b>NB:</b> You can not UNDO this process after you confirm deletion.</p>
                <div class="p-2">
                    <button type="button" class="btn btn-danger" id="clear-event" data-bs-dismiss="modal">I'm Not Sure</button>
                    <button type="button" class="btn btn-success confirm-event-deletion">I'm Sure</button>
                    <button class="btn btn-primary" type="button" id="event-delete-loader" disabled style="display: none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Deleting...
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>

<!--EDIT PERMISSION MODAL -->
<div class="modal fade" id="editPermissionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title">Edit Permission</h5>
                <form class="row g-3" id="permission-edit-form">

                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" id="edit-permission-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                            <span class="visually-hidden">fetching...</span>
                        </div>
                    </div><!-- End Center aligned spinner -->


                </form>
            </div>
        </div>
    </div>
</div>
<!--EDIT PERMISSION MODAL -->
<div class="modal fade" id="editAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title">Edit Admin</h5>
                <form class="row g-3" id="admin-edit-form">

                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" id="edit-admin-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                            <span class="visually-hidden">fetching...</span>
                        </div>
                    </div><!-- End Center aligned spinner -->


                </form>
            </div>
        </div>
    </div>
</div>


<!--EDIT PERMISSION MODAL -->
<div class="modal fade" id="editRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title">Edit Role</h5>
                <form class="row g-3" id="role-edit-form">

                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" id="edit-role-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                            <span class="visually-hidden">fetching...</span>
                        </div>
                    </div><!-- End Center aligned spinner -->


                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title">Create New Role</h5>
                <form class="row g-3" id="role-register-form">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="floatingName" placeholder="Role Name" required>
                            <label for="floatingName">Role Name</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="submit-role" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewPostModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title">Create New Post</h5>
                <form class="row g-3" id="post_event_form" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="title" id="floatingInput" placeholder="Enter title of the post">
                        <label for="floatingInput">Event Title</label>
                    </div>
                    <div class="col-md-6 form-floating mb-6">
                        <select class="form-select" id="floatingSelect" name="category" aria-label="Floating label select example">
                            <option value="Recent Event">Recent Event</option>
                            <option value="Upcoming Event">Upcoming Event</option>
                            <option value="Blog">Blog</option>
                        </select>
                        <label for="floatingSelect">Post Category</label>
                    </div>
                    <div class="col-md-6 form-floating mb-6">
                        <select class="form-select" id="floatingSelect" name="priority" aria-label="Floating label select example">
                            <option value="Top">Top Event</option>
                            <option value="Normal">Normal Event</option>
                        </select>
                        <label for="floatingSelect">Post Priority</label>
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="picture" placeholder="Picture">
                    </div>
                    <div class="col-md-6">
                        <input type="date" class="form-control" name="date" placeholder="Date of Event">
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
                        <label for="floatingTextarea">Post Description</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="post_event_button" class="btn btn-primary">Post Event</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End No Labels Form -->

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editEventModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title">EDIT THIS POST</h5>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" id="edit-event-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                        <span class="visually-hidden">fetching...</span>
                    </div>
                </div><!-- End Center aligned spinner -->
                <form class="row g-3 fs-6" id="edit_event_form" enctype="multipart/form-data">



                </form><!-- End No Labels Form -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="displayEventComments" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <section>
                    <div class="container py-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12 col-lg-12">
                                <div class="card text-body">
                                    <div class="card-body p-4">
                                        <h4 class="mb-0">Recent comments</h4>
                                        <p class="fw-light mb-4 pb-2">Latest Comments from users</p>
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border text-primary" id="display-comments-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                                                <span class="visually-hidden">fetching...</span>
                                            </div>
                                        </div>
                                      <div id="display-comments-section">




                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div><!-- End Modal Dialog Scrollable-->


<div class="modal fade" id="addNewCampaignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title text-success">Create New Campaign</h5>
                <form class="row g-3" id="post_campaign_form" enctype="multipart/form-data">

                    <div class="col-12">
                        <label for="inputNanme4" class="form-label campaign-label">Campaign Title</label>
                        <input type="text" class="form-control campaign-form"  name="title" id="inputNanme4">
                    </div>

                    <div class="col-12">
                        <label for="inputPassword4" class="form-label campaign-label">Nature of the campaign</label>
                        <select class="form-select campaign-form" name="popup">
                            <option value="1">Popup</option>
                            <option value="0">Not Popup</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label campaign-label">Campaign Poster</label>
                        <input type="file" name="picture" class="form-control campaign-form" id="inputAddress">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label campaign-label">Starting Date</label>
                        <input type="date" class="form-control campaign-form" name="startingDate" id="inputEmail4">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label campaign-label">Ending Date</label>
                        <input type="date" class="form-control campaign-form" name="endingDate" id="inputEmail4">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label campaign-label">Campaign Descriptions</label>
                        <textarea class="form-control campaign-form" name="description" placeholder="Add the Campaign Descriptions" id="floatingTextarea" style="height: 100px;"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="post_campaign_button" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End No Labels Form -->

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addNewTeamMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title text-success">Create New Member</h5>
                <form class="row g-3" id="post_member_form" enctype="multipart/form-data">

                    <div class="col-12">
                        <label for="inputNanme4" class="form-label campaign-label">FirstName</label>
                        <input type="text" class="form-control campaign-form"  name="firstname" id="inputNanme4">
                    </div>

                    <div class="col-12">
                        <label for="inputNanme4" class="form-label campaign-label">LastName</label>
                        <input type="text" class="form-control campaign-form"  name="lastname" id="inputNanme4">
                    </div>

                    <div class="col-12">
                        <label for="inputPassword4" class="form-label campaign-label">Project</label>
                        <select class="form-select campaign-form" name="project">
                            <!---WILL DISPLAY PROJECTS FROM DB--->
                            <option value="CHANGARAWE">CHANGARAWE</option>
                            <option value="MTOTO KWANZA">MTOTO KWANZA</option>
                            <option value="AFYA YANGU MAISHA YANGU">AFYA YANGU MAISHA YANGU</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="inputPassword4" class="form-label campaign-label">Position</label>
                        <select class="form-select campaign-form" name="position">
                            <!---WILL DISPLAY PROJECTS FROM DB--->
                            <option value="EXECUTIVE DIRECTOR">EXECUTIVE DIRECTOR</option>
                            <option value="PROGRAMS OFFICER">PROGRAMS OFFICER</option>
                            <option value="ACCOUNTANT OFFICER">ACCOUNTANT OFFICER</option>
                            <option value="PROCUREMENT OFFICER">PROCUREMENT OFFICER</option>
                            <option value="IT OFFICER">IT OFFICER</option>
                            <option value="PROJECT OFFICER">PROJECT OFFICER</option>
                            <option value="OFFICE SECRETARY">OFFICE SECRETARY</option>
                            <option value="DRIVER">DRIVER</option>
                            <option value="ENVIRONMENTAL ATTENDANT">ENVIRONMENTAL ATTENDANT</option>
                            <option value="SECURITY GUARD">SECURITY GUARD</option>
                            <option value="VOLUNTEER">VOLUNTEER</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="inputAddress" class="form-label campaign-label">Profile picture</label>
                        <input type="file" name="picture" class="form-control campaign-form" id="inputAddress">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label campaign-label">Email</label>
                        <input type="email" class="form-control campaign-form" name="email" id="inputEmail4">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label campaign-label">Mobile Number</label>
                        <input type="text" class="form-control campaign-form" name="phoneNo" id="inputEmail4">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label campaign-label">Profile Descriptions</label>
                        <textarea class="form-control campaign-form" name="profile" placeholder="Add your simple profile " id="floatingTextarea" style="height: 100px;"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="post_member_button" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End No Labels Form -->

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editCampaignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title text-success"><b>EDIT CAMPAIGN</b></h5>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" id="display-campaign-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                        <span class="visually-hidden">fetching...</span>
                    </div>
                </div>
                <form class="row g-3" id="edit_campaign_form" enctype="multipart/form-data">


                </form><!-- End No Labels Form -->

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title text-success"><b>EDIT TEAM MEMBER</b></h5>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" id="display-member-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                        <span class="visually-hidden">fetching...</span>
                    </div>
                </div>
                <form class="row g-3" id="edit_member_form" enctype="multipart/form-data">


                </form><!-- End No Labels Form -->

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addNewPartnerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title text-primary">Create New Working Partner</h5>
                <form class="row g-3" id="post_partner_form" enctype="multipart/form-data">

                    <div class="col-12">
                        <label for="inputNanme4" class="form-label partner-label">Partner Name</label>
                        <input type="text" class="form-control partner-form"  name="name" id="inputNanme4">
                    </div>

                    <div class="col-12">
                        <label for="inputAddress" class="form-label partner-label">Partner Logo</label>
                        <input type="file" name="logo" class="form-control partner-form" id="inputAddress">
                    </div>

                    <div class="col-12">
                        <label for="inputAddress" class="form-label partner-label">Profile Descriptions</label>
                        <textarea class="form-control partner-form" name="description" placeholder="Add Partner profile " id="floatingTextarea" style="height: 100px;"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="post_partner_button" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End No Labels Form -->

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editPartnerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <h5 class="card-title text-primary"><b>EDIT PARTNER</b></h5>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" id="display-partner-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                        <span class="visually-hidden">fetching...</span>
                    </div>
                </div>
                <form class="row g-3" id="edit_partner_form" enctype="multipart/form-data">


                </form><!-- End No Labels Form -->

            </div>
        </div>
    </div>
</div>
