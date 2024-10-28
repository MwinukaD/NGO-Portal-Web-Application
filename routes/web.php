<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MembersPartnersController;


//Route::resource('/permission', App\Http\Controllers\Permission::class);
Route::get('/admin/login/form',[AdminController::class, 'adminLoginForm'])->name('admin/login/form');
Route::post('admin/login', [AdminController::class, 'adminLogin'])->name('admin/login');

Route::post('/submit-admin',[AdminController::class, 'submitAdmin'])->name('submit-admin');
Route::get('/admin-register',[AdminController::class, 'adminRegister'])->name('admin-register');
Route::get('/admin-home',[AdminController::class, 'adminHome'])->name('admin-home');



Route::get('/permissions',[AdminController::class, 'permissions'])->name('permissions');
Route::get('/fetch-permissions',[AdminController::class, 'getAllActivePermissions'])->name('fetch-permissions');
Route::get('/fetch-roles',[AdminController::class, 'getAllActiveRoles'])->name('fetch-roles');
Route::get('/fetch-edited-permission/{id}',[AdminController::class, 'fetchSelectedPermission'])->name('fetch-edited-permission');
Route::get('/fetch-edited-role/{id}',[AdminController::class, 'fetchSelectedRole'])->name('fetch-edited-role');
Route::get('/roles',[AdminController::class, 'roles'])->name('roles');
Route::get('/register-admin',[AdminController::class, 'registerAdmin'])->name('register-admin');
Route::get('/fetch-admins',[AdminController::class, 'fetchAdmins'])->name('fetch-admins');
Route::get('/fetch-edited-admin/{id}',[AdminController::class, 'fetchEditedAdmin'])->name('fetch-edited-admin');
Route::get('/events-post',[EventsController::class, 'eventsPost'])->name('events-post');
Route::get('/fetch-edited-event/{id}',[EventsController::class, 'fetchEditedEvent'])->name('fetch-edited-event');
Route::get('/fetch-edited-campaign/{id}',[EventsController::class, 'fetchEditedCampaign'])->name('fetch-edited-campaign');
Route::get('/fetch-post-comments/{id}',[EventsController::class, 'fetchPostComments'])->name('fetch-post-comments');
Route::get('/campaigns/',[EventsController::class, 'handleCampaigns'])->name('campaigns');


Route::get('/team_members/',[MembersPartnersController::class, 'fetchTeamMembers'])->name('team_members');
Route::get('/working-partners/',[MembersPartnersController::class, 'fetchPartners'])->name('working-partners');
Route::get('/fetch-edited-member/{id}',[MembersPartnersController::class, 'fetchEditedMember'])->name('fetch-edited-member');
Route::get('/fetch-edited-partner/{id}',[MembersPartnersController::class, 'fetchEditedPartner'])->name('fetch-edited-partner');



Route::post('/submit-permission',[AdminController::class, 'submitNewPermission'])->name('submit-permission');
Route::post('/submit-role',[AdminController::class, 'submitNewRole'])->name('submit-role');
Route::post('/delete-permission/{id}',[AdminController::class, 'deletePermission'])->name('delete-permission');
Route::post('/delete-admin/{id}',[AdminController::class, 'deleteAdmin'])->name('delete-admin');
Route::post('/delete-role/{id}',[AdminController::class, 'deleteRole'])->name('delete-role');
Route::post('/update-selected-permission',[AdminController::class, 'updateSelectedPermission'])->name('update-selected-permission');
Route::post('/update-selected-role',[AdminController::class, 'updateSelectedRole'])->name('update-selected-role');
Route::post('/update-selected-admin',[AdminController::class, 'updateSelectedAdmin'])->name('update-selected-admin');
Route::post('/handle-post-event',[EventsController::class, 'handlePostEventRequest'])->name('handle-post-event');
Route::post('/delete-event/{id}',[EventsController::class, 'handleDeleteEvent'])->name('delete-event');
Route::post('/delete-campaign/{id}',[EventsController::class, 'handleDeleteCampaign'])->name('delete-campaign');
Route::post('/handle-edit-event',[EventsController::class, 'handleEditEvent'])->name('handle-edit-event');
Route::post('/handle-edit-campaign',[EventsController::class, 'handleEditCampaignRequest'])->name('handle-edit-campaign');
Route::post('/post-new-campaign',[EventsController::class, 'handlePostCampaignRequest'])->name('post-new-campaign');

Route::post('/mark-as-read/{id}',[EventsController::class, 'handleMarkAsRead'])->name('mark-as-read');
Route::post('/mark-as-unread/{id}',[EventsController::class, 'handleMarkAsUnread'])->name('mark-as-unread');
Route::post('/delete-comment/{id}',[EventsController::class, 'handleDeleteComment'])->name('delete-comment');
Route::post('/reply-to-comment/{id}',[EventsController::class, 'handleReplyToComment'])->name('reply-to-comment');


Route::post('/post-team-members/',[MembersPartnersController::class, 'handlePostTeamMemberRequest'])->name('post-team-members');
Route::post('/delete-member/{id}',[MembersPartnersController::class, 'handleDeleteTeamMemberRequest'])->name('delete-member');
Route::post('/delete-partner/{id}',[MembersPartnersController::class, 'handleDeletePartnerRequest'])->name('delete-partner');
Route::post('/handle-edit-member/',[MembersPartnersController::class, 'handleEditMemberRequest'])->name('handle-edit-member');
Route::post('/handle-edit-partner/',[MembersPartnersController::class, 'handleEditPartnerRequest'])->name('handle-edit-partner');
Route::post('/post-partners/',[MembersPartnersController::class, 'handlePostPartnersRequest'])->name('post-partners');


Route::get('/', function () {
    return view('welcome');
});




require __DIR__.'/auth.php';
