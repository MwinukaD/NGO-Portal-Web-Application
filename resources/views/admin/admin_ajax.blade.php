<script>

    $(document).ready(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        getAllActiveAdminsFromDB();
    });
    //FUNCTION FOR POSTING DELETION ID
    function permissionDeletion(permission_id){
        $(".confirm_deletion_ID").data('id', permission_id);
    }

    function roleDeletion(role_id){
        $(".role_deletion_ID").data('id', role_id);
    }

        //getAllActivePermissionsFromDB
        function getAllActivePermissionsFromDB(){
            $.ajax({
                url : "{{ route('fetch-permissions') }}",
                method : "GET",
                beforeSend : function (){
                    $("#permission-loading").css("display", "block");
                },
                success : function (data){
                    $("#permission-loading").css("display", "none");
                    $("#permissions_data_from_database").html(data);
                },
                error : function (error){
                    console.log(error);
                    Swal.fire({
                        title: "Data Fetching Error !",
                        text: error,
                        icon: "warning"
                    });
                    $("#permission-loading").css("display", "none");
                }

            });
        }
        getAllActivePermissionsFromDB();//Callback function for fetching permission data

    //getAllActiveRolesFromDB
    function getAllActiveRolesFromDB(){
        $.ajax({
            url : "{{ route('fetch-roles') }}",
            method : "GET",
            beforeSend : function (){
                $("#role-loading").show();
            },
            success : function (data){
                $("#role-loading").hide();
                $("#roles_data_from_database").html(data);
            },
            error : function (error){
                console.log(error);
                Swal.fire({
                    title: "Data Fetching Error !",
                    text: error,
                    icon: "warning"
                });
                $("#role-loading").hide();
            }

        });
    }
    getAllActiveRolesFromDB();//Callback function for fetching permission data



    //permissionDeletion
        $(".confirm-permission-deletion").on('click', function (){
            const permissionID = $('.confirm_deletion_ID').data('id');
            const url = "{{route('delete-permission',':permissionID')}}".replace(':permissionID', permissionID )
            $.ajax({
                'url' : url,
                'method' : 'POST',
                beforeSend : function(){
                    $(".confirm-permission-deletion").hide();
                    $("#clear-permission").hide();
                    $("#permission-delete-loader").show();
                },
                success : function (response){
                    $(".confirm-permission-deletion").show();
                    $("#clear-permission").show();
                    $("#permission-delete-loader").hide();
                    $("#confirmPermissionDeletion").modal('hide');
                    console.log(response);
                        Swal.fire({
                            title: response.status,
                            text: response.message,
                            icon: response.status
                        });
                    getAllActivePermissionsFromDB();
                },
                error : function (error){
                    $(".confirm-permission-deletion").show();
                    $("#clear-permission").show();
                    $("#permission-delete-loader").hide();
                    $("#confirmPermissionDeletion").modal('hide');

                    console.error(error);
                    Swal.fire({
                        title: "Sorry!",
                        text: error,
                        icon: "warning"
                    });
                    getAllActivePermissionsFromDB();
                }
            })
        })


    //roleDeletion
    $(".confirm-role-deletion").on('click', function (){
        const roleID = $('.role_deletion_ID').data('id');
        const url = "{{route('delete-role',':roleID')}}".replace(':roleID', roleID )
        $.ajax({
            'url' : url,
            'method' : 'POST',
            beforeSend : function(){
                $(".confirm-role-deletion").hide();
                $("#clear-role").hide();
                $("#role-delete-loader").show();
            },
            success : function (response){
                $(".confirm-role-deletion").show();
                $("#clear-role").show();
                $("#role-delete-loader").hide();
                $("#confirmRoleDeletion").modal('hide');
                console.log(response);
                Swal.fire({
                    title: response.status,
                    text: response.message,
                    icon: response.status
                });
                getAllActiveRolesFromDB();
            },
            error : function (error){
                $(".confirm-role-deletion").show();
                $("#clear-role").show();
                $("#role-delete-loader").hide();
                $("#confirmRoleDeletion").modal('hide');

                console.error(error);
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
                getAllActiveRolesFromDB();
            }
        })
    })


    //SENDING PERMISSION DATA TO ADMIN CONTROLLER
        $("#permission-register-form").on('submit', function (e){
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url : "{{route('submit-permission')}}",
                method : 'POST',
                data : formData,
                dataType : 'json',
                beforeSend : function (){
                    $("#submit-permission").text('Loading...').attr('disabled','disabled');
                },
                success : function (response){
                    $("#submit-permission").text('Submit Again').attr('disabled',false);
                    if(response.status === 'success'){
                        getAllActivePermissionsFromDB();//Callback function for fetching permission data
                        Swal.fire({
                            title: "Good job!",
                            text: response.message,
                            icon: "success"
                        });
                    }else{
                        Swal.fire({
                            title: "Sorry!",
                            text: response.message,
                            icon: "warning"
                        });
                    }
                },
                error : function (response){
                    $("#submit-permission").text('Submit Again').attr('disabled',false);
                    console.error(response);
                    Swal.fire({
                        title: "Sorry!",
                        text: response,
                        icon: "warning"
                    });

                }
            })
        })




//EDITING CLICKED PERMISSION
    function permissionEditing(permissionID){
        const url = "{{route('fetch-edited-permission',':permissionID')}}".replace(':permissionID',permissionID);
        $.ajax({
            'url' : url,
            'method' : 'GET',
            beforeSend : function(){
                $("#edit-permission-loading").show()

            },
            success : function (response){
                $("#edit-permission-loading").hide()
                $("#permission-edit-form").html(response);
            },
            error : function (xhr, status, error){
                $("#edit-permission-loading").hide()
                $("#editPermissionModal").modal('hide');
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
            }
        })
    }
//DISPLAYING COMMENTS
 function displayPostComments(eventID){
        const url = "{{route('fetch-post-comments',':eventID')}}".replace(':eventID',eventID);
        $.ajax({
            'url' : url,
            'method' : 'GET',
            beforeSend : function(){
                $("#display-comments-loading").show()

            },
            success : function (response){
                $("#display-comments-loading").hide()
                $("#display-comments-section").html(response);
            },
            error : function (xhr, status, error){
                $("#display-comments-loading").hide()
                $("#displayEventComments").modal('hide');
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
            }
        })
    }




//EDITING CLICKED PERMISSION
    function editEvent(eventID){
        const url = "{{route('fetch-edited-event',':eventID')}}".replace(':eventID',eventID);
        $.ajax({
            'url' : url,
            'method' : 'GET',
            beforeSend : function(){
                $("#edit-event-loading").show()

            },
            success : function (response){
                $("#edit-event-loading").hide()
                $("#edit_event_form").html(response);
            },
            error : function (xhr, status, error){
                $("#edit-event-loading").hide()
                $("#editEventModal").modal('hide');
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
            }
        })
    }


//EDITING CLICKED PERMISSION
    function adminEditing(adminID){
        const url = "{{route('fetch-edited-admin',':adminID')}}".replace(':adminID',adminID);
        $.ajax({
            'url' : url,
            'method' : 'GET',
            beforeSend : function(){
                $("#edit-admin-loading").show()

            },
            success : function (response){
                $("#edit-admin-loading").hide()
                $("#admin-edit-form").html(response);
            },
            error : function (xhr, status, error){
                $("#edit-admin-loading").hide()
                $("#editAdminModal").modal('hide');
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
            }
        })
    }

    //EDITING CLICKED ROLE
    function roleEditing(roleID){
        const url = "{{route('fetch-edited-role',':roleID')}}".replace(':roleID',roleID);
        $.ajax({
            'url' : url,
            'method' : 'GET',
            beforeSend : function(){
                $("#edit-role-loading").show()

            },
            success : function (response){
                $("#edit-role-loading").hide()
                $("#role-edit-form").html(response);
            },
            error : function (xhr, status, error){
                $("#edit-role-loading").hide()
                $("#editRoleModal").modal('hide');
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
            }
        })
    }

$("#permission-edit-form").on('submit', function (event){
    event.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
        'url' : "{{route('update-selected-permission')}}",
        'method' : 'POST',
        'data' : formData,
        beforeSend : function (){


        },
        success : function(response){
            if(response.status === 'success'){
                Swal.fire({
                    title: "Good job!",
                    text: response.message,
                    icon: "success"
                });
                getAllActivePermissionsFromDB();//Callback function for fetching permission data
            }else{
                Swal.fire({
                    title: "Sorry!",
                    text: response.message,
                    icon: "warning"
                });
            }
        },
        error : function(xhr, status, error){

            Swal.fire({
                title: "Sorry!",
                text: error,
                icon: "warning"
            });
        }
    })
})
$("#admin-edit-form").on('submit', function (event){
    event.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
        'url' : "{{route('update-selected-admin')}}",
        'method' : 'POST',
        'data' : formData,
        beforeSend : function (){
            $("#edit-admin").attr("disabled", true).text("Processing...");
        },
        success : function(response){
            $("#edit-admin").attr("disabled", false).text("Update");
            if(response.status === 'success'){
                Swal.fire({
                    title: "Good job!",
                    text: response.message,
                    icon: "success"
                });
                getAllActiveAdminsFromDB();//Callback function for fetching permission data
            }else{
                $("#edit-admin").attr("disabled", false).text("Update");

                Swal.fire({
                    title: "Sorry!",
                    text: response.message,
                    icon: "warning"
                });
            }
        },
        error : function(xhr, status, error){
            $("#edit-admin").attr("disabled", false).text("Update");
            Swal.fire({
                title: "Sorry!",
                text: error,
                icon: "warning"
            });
        }
    })
})

    $("#role-edit-form").on('submit', function (event){
    event.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
        'url' : "{{route('update-selected-role')}}",
        'method' : 'POST',
        'data' : formData,
        beforeSend : function (){


        },
        success : function(response){
            if(response.status === 'success'){
                Swal.fire({
                    title: "Good job!",
                    text: response.message,
                    icon: "success"
                });
                getAllActiveRolesFromDB();//Callback function for fetching permission data
            }else{
                Swal.fire({
                    title: "Sorry!",
                    text: response.message,
                    icon: "warning"
                });
            }
        },
        error : function(xhr, status, error){

            Swal.fire({
                title: "Sorry!",
                text: error,
                icon: "warning"
            });
        }
    })
})

    //SENDING PERMISSION DATA TO ADMIN CONTROLLER
    $("#role-register-form").on('submit', function (e){
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
            url : "{{route('submit-role')}}",
            method : 'POST',
            data : formData,
            dataType : 'json',
            beforeSend : function (){
                $("#submit-role").text('Loading...').attr('disabled','disabled');
            },
            success : function (response){
                $("#submit-role").text('Submit Again').attr('disabled',false);
                if(response.status === 'success'){
                    getAllActiveRolesFromDB();//Callback function for fetching permission data
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success"
                    });
                }else{
                    Swal.fire({
                        title: "Sorry!",
                        text: response.message,
                        icon: "warning"
                    });
                }
            },
            error : function (response){
                $("#submit-role").text('Submit Again').attr('disabled',false);
                console.error(response);
                Swal.fire({
                    title: "Sorry!",
                    text: response,
                    icon: "warning"
                });

            }
        })
    })

    function getAllActiveAdminsFromDB(){
        $.ajax({
            url : "{{ route('fetch-admins') }}",
            method : "GET",
            beforeSend : function (){
                $("#admin-loading").show();
            },
            success : function (data){
                $("#admin-loading").hide();
                $("#admins_data_from_database").html(data);
            },
            error : function (error){
                console.log(error);
                Swal.fire({
                    title: "Data Fetching Error !",
                    text: error,
                    icon: "warning"
                });
                $("#role-loading").hide();
            }

        });
    }
    getAllActiveAdminsFromDB();//Callback function for fetching permission data


    $("#admin-register-form").on('submit', function (e){
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
            url : "{{route('submit-admin')}}",
            method : 'POST',
            data : formData,
            dataType : 'json',
            beforeSend : function (){
                $("#submit-admin").text('Loading...').attr('disabled','disabled');
            },
            success : function (response){
                $("#submit-admin").text('Submit Again').attr('disabled',false);
                if(response.status === 'success'){
                    getAllActiveAdminsFromDB();//Callback function for fetching permission data
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success"
                    });
                }else{
                    Swal.fire({
                        title: "Sorry!",
                        text: response.message,
                        icon: "warning"
                    });
                }
            },
            error : function (response){
                $("#submit-admin").text('Submit Again').attr('disabled',false);
                console.error(response);
                Swal.fire({
                    title: "Sorry!",
                    text: response,
                    icon: "warning"
                });

            }
        })
    })

    //DELETING SELECTED ADMIN
    function adminDeletion(admin_uuid){
        $(".admin_ID").data('uuid', admin_uuid);
    }
    //permission FOR ADMIN Deletion
    $(".confirm-admin-deletion").on('click', function (){
        const adminUUID = $('.admin_ID').data('uuid');

        const url = "{{route('delete-admin',':adminUUID')}}".replace(':adminUUID', adminUUID )
        $.ajax({
            'url' : url,
            'method' : 'POST',
            beforeSend : function(){
                $(".confirm-admin-deletion").hide();
                $("#clear-admin").hide();
                $("#admin-delete-loader").show();
            },
            success : function (response){
                $(".confirm-admin-deletion").show();
                $("#clear-admin").show();
                $("#admin-delete-loader").hide();
                $("#confirmAdminDeletion").modal('hide');
                console.log(response);
                Swal.fire({
                    title: response.status,
                    text: response.message,
                    icon: response.status
                });
                getAllActiveAdminsFromDB();
            },
            error : function (error){
                $(".confirm-admin-deletion").show();
                $("#clear-admin").show();
                $("#admin-delete-loader").hide();
                $("#confirmAdminDeletion").modal('hide');

                console.error(error);
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
                getAllActiveAdminsFromDB();
            }
        })
    })

    $("#post_event_form").on('submit', function (event) {
        event.preventDefault();
        const form_data = new FormData($(this)[0]);

        $.ajax({
            url: '{{route('handle-post-event')}}',
            method: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#post_event_button").attr('disabled', true).text('Loading.....');
            },
            success: function (response) {
                $("#post_event_button").attr('disabled', false).text('Post Event');
                if (response.title === 'success') {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type,
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                $("#post_event_button").attr('disabled', false).text('Post Event');
            }
        });
    });

$("#edit_event_form").on('submit', function (event) {
        event.preventDefault();
        const form_data = new FormData($(this)[0]);

        $.ajax({
            url: '{{route('handle-edit-event')}}',
            method: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#edit_event_button").attr('disabled', true).text('Loading.....');
            },
            success: function (response) {
                $("#edit_event_button").attr('disabled', false).text('Post Event');
                if (response.title === 'success') {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type,
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type
                    })
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                $("#edit_event_button").attr('disabled', false).text('Post Event');
            }
        });
    });


    function eventDeletion(id){
        $(".eventID").data('id', id);
    }
    //permission FOR ADMIN Deletion
    $(".confirm-event-deletion").on('click', function (){
        const eventID = $('.eventID').data('id');
        const url = "{{route('delete-event',':eventID')}}".replace(':eventID', eventID )
        $.ajax({
            'url' : url,
            'method' : 'POST',
            beforeSend : function(){
                $(".confirm-event-deletion").hide();
                $("#clear-event").hide();
                $("#event-delete-loader").show();
            },
            success : function (response){
                $(".confirm-event-deletion").show();
                $("#clear-event").show();
                $("#event-delete-loader").hide();
                $("#confirmEventDeletion").modal('hide');
                Swal.fire({
                    title: response.status,
                    text: response.message,
                    icon: response.status
                }).then(function() {
                    window.location.reload();
                });
            },
            error : function (error){
                $(".confirm-event-deletion").show();
                $("#clear-event").show();
                $("#event-delete-loader").hide();
                $("#confirmEventDeletion").modal('hide');

                console.error(error);
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
            }
        })
    })


    $(document).on('change', '.markAsReadCheckbox', function () {
        const isChecked = $(this).is(':checked');
        const commentID = $(this).data('id');

        const routes = {
            markAsRead: "{{ route('mark-as-read', ':commentID') }}",
            markAsUnread: "{{ route('mark-as-unread', ':commentID')}}"
        };

        const newLabelText = isChecked ? 'Mark as Unread' : 'Mark as Read';
        const url = isChecked ? routes.markAsRead.replace(':commentID', commentID) : routes.markAsUnread.replace(':commentID', commentID);

        $.ajax({
            url: url,
            method: 'POST',
            beforeSend: function () {
                $(".markAsReadCheckbox").prop('disabled', true);
                $(".check-label").text('marking...');
            },
            success: function (response) {
                $(".markAsReadCheckbox").prop('disabled', false);
                Swal.fire({
                    title: response.status,
                    text: response.message,
                    icon: response.status
                });
                $(".check-label").text(newLabelText);


            },
            error: function (error) {
                $(".markAsReadCheckbox").prop('disabled', false);
                console.error(error);
                Swal.fire({
                    title: "Sorry!",
                    text: `Failed to ${isChecked ? 'mark' : 'unmark'} the comment`,
                    icon: "warning"
                });
                $(".check-label").text(newLabelText);
            }
        });
    });

    function commentDeletion(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const url = "{{route('delete-comment',':commentID')}}".replace(':commentID', id);
                $.ajax({
                    url: url,
                    method : 'POST',
                    data: id,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Deleted!',
                                'The item has been deleted.',
                                'success'
                            );
                            $('#comment-' + id).remove();
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete this iterm',
                                'warning'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was a problem with the server. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    }


    function campaignDeletion(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const url = "{{route('delete-campaign',':campaignID')}}".replace(':campaignID', id);
                $.ajax({
                    url: url,
                    method : 'POST',
                    data: id,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Deleted!',
                                'The item has been deleted.',
                                'success'
                            );
                            $('#campaign-' + id).remove();
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete this iterm',
                                'warning'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was a problem with the server. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    }


    function replyToComment(commentId) {
        const url = "{{route('reply-to-comment',':commentID')}}".replace(':commentID',commentId);
        Swal.fire({
            title: 'Reply to Comment',
            input: 'textarea',
            inputLabel: 'Your reply',
            inputPlaceholder: 'Type your reply here...',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to write something!'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        reply: result.value,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Replied!',
                                'Your reply has been posted.',
                                'success'
                            );
                            $('#comment-' + commentId).append('<div class="reply">' + response.reply + '</div>');
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error posting your reply.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was a problem with the server. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    }


    $("#post_campaign_form").on('submit', function (event) {
        event.preventDefault();
        const form_data = new FormData($(this)[0]);
        $.ajax({
            url: '{{route('post-new-campaign')}}',
            method: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#post_campaign_button").attr('disabled', true).text('Loading.....');
            },
            success: function (response) {
                $("#post_campaign_button").attr('disabled', false).text('Submit');
                if (response.title === 'success') {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type,
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                $("#post_campaign_button").attr('disabled', false).text('Submit');
            }
        });
    });

    function editCampaign(campaignID){
        const url = "{{route('fetch-edited-campaign',':campaignID')}}".replace(':campaignID',campaignID);
        $.ajax({
            'url' : url,
            'method' : 'GET',
            beforeSend : function(){
                $("#display-campaign-loading").show()
            },
            success : function (response){
                $("#display-campaign-loading").hide()
                $("#edit_campaign_form").html(response);
            },
            error : function (xhr, status, error){
                $("#display-campaign-loading").hide()
                $("#editCampaignModal").modal('hide');
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
            }
        })
    }

    $("#edit_campaign_form").on('submit', function (event) {
        event.preventDefault();
        const form_data = $(this).serialize();

        $.ajax({
            url: '{{route('handle-edit-campaign')}}',
            method: 'POST',
            data: form_data,
            beforeSend: function () {
                $("#edit_campaign_button").attr('disabled', true).text('Loading.....');
            },
            success: function (response) {
                $("#edit_campaign_button").attr('disabled', false).text('Save Changes');
                if (response.title === 'success') {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type,
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type
                    })
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                $("#edit_campaign_button").attr('disabled', false).text('Save Changes');
            }
        });
    });

    $("#post_member_form").on('submit', function (event) {
        event.preventDefault();
        const form_data = new FormData($(this)[0]);
        $.ajax({
            url: '{{route('post-team-members')}}',
            method: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#post_member_button").attr('disabled', true).text('Loading.....');
            },
            success: function (response) {
                $("#post_member_button").attr('disabled', false).text('Submit');
                if (response.title === 'success') {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type,
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                $("#post_member_button").attr('disabled', false).text('Submit');
            }
        });
    });

    function memberDeletion(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const url = "{{route('delete-member',':memberID')}}".replace(':memberID', id);
                $.ajax({
                    url: url,
                    method : 'POST',
                    data: id,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Deleted!',
                                'The item has been deleted.',
                                'success'
                            );
                            $('#member-' + id).remove();
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete this iterm',
                                'warning'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was a problem with the server. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    }


    function editTeamMember(memberID){
        const url = "{{route('fetch-edited-member',':memberID')}}".replace(':memberID',memberID);
        $.ajax({
            'url' : url,
            'method' : 'GET',
            beforeSend : function(){
                $("#display-member-loading").show()
            },
            success : function (response){
                $("#display-member-loading").hide()
                $("#edit_member_form").html(response);
            },
            error : function (xhr, status, error){
                $("#display-member-loading").hide()
                $("#editMemberModal").modal('hide');
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
            }
        })
    }



    $("#edit_member_form").on('submit', function (event) {
        event.preventDefault();
        const form_data = $(this).serialize();

        $.ajax({
            url: '{{route('handle-edit-member')}}',
            method: 'POST',
            data: form_data,
            beforeSend: function () {
                $("#edit_member_button").attr('disabled', true).text('Loading.....');
            },
            success: function (response) {
                $("#edit_member_button").attr('disabled', false).text('Save Changes');
                if (response.title === 'success') {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type,
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type
                    })
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                $("#edit_member_button").attr('disabled', false).text('Save Changes');
            }
        });
    });



    $("#post_partner_form").on('submit', function (event) {
        event.preventDefault();
        const form_data = new FormData($(this)[0]);
        $.ajax({
            url: '{{route('post-partners')}}',
            method: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#post_partner_button").attr('disabled', true).text('Loading.....');
            },
            success: function (response) {
                $("#post_partner_button").attr('disabled', false).text('Submit');
                if (response.title === 'success') {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type,
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                $("#post_partner_button").attr('disabled', false).text('Submit');
            }
        });
    });


    function partnerDeletion(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const url = "{{route('delete-partner',':partnerID')}}".replace(':partnerID', id);
                $.ajax({
                    url: url,
                    method : 'POST',
                    data: id,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Deleted!',
                                'The item has been deleted.',
                                'success'
                            );
                            $('#partner-' + id).remove();
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete this iterm',
                                'warning'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was a problem with the server. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    }


    function editPartner(partnerID){
        const url = "{{route('fetch-edited-partner',':partnerID')}}".replace(':partnerID',partnerID);
        $.ajax({
            'url' : url,
            'method' : 'GET',
            beforeSend : function(){
                $("#display-partner-loading").show()
            },
            success : function (response){
                $("#display-partner-loading").hide()
                $("#edit_partner_form").html(response);
            },
            error : function (xhr, status, error){
                $("#display-partner-loading").hide()
                $("#editPartnerModal").modal('hide');
                Swal.fire({
                    title: "Sorry!",
                    text: error,
                    icon: "warning"
                });
            }
        })
    }




    $("#edit_partner_form").on('submit', function (event) {
        event.preventDefault();
        const form_data = $(this).serialize();

        $.ajax({
            url: '{{route('handle-edit-partner')}}',
            method: 'POST',
            data: form_data,
            beforeSend: function () {
                $("#edit_partner_button").attr('disabled', true).text('Loading.....');
            },
            success: function (response) {
                $("#edit_partner_button").attr('disabled', false).text('Save Changes');
                if (response.title === 'success') {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type,
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.response_type
                    })
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                $("#edit_partner_button").attr('disabled', false).text('Save Changes');
            }
        });
    });


    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
            url: '{{ route("admin/login") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.status === "success") {
                    window.location.href = '{{ route("admin-home") }}';
                } else {

                    Swal.fire({
                        title: response.status,
                        text: response.message,
                        icon: response.status
                    })
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'error',
                    text: error,
                    icon: 'error'
                })
            }
        });
    });

</script>
