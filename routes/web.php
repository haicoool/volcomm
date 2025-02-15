<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CertificateController;

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');


// Volunteer Routes
Route::prefix('volunteer')->group(function () {
    Route::get('login', [VolunteerController::class, 'showLoginForm'])->name('volunteer.login');
    Route::post('login', [VolunteerController::class, 'login']);
    Route::get('register', [VolunteerController::class, 'showRegistrationForm'])->name('volunteer.register');
    Route::post('register', [VolunteerController::class, 'register']);
    Route::get('interest', [VolunteerController::class, 'showInterestForm'])->name('volunteer.interest');
    Route::post('interest', [VolunteerController::class, 'updateInterest'])->name('volunteer.updateInterest');
    Route::post('logout', [VolunteerController::class, 'logout'])->name('volunteer.logout');

    Route::get('profile/edit', [VolunteerController::class, 'editProfile'])->name('volunteer.edit-profile');
    Route::get('history', [VolunteerController::class, 'viewHistory'])->name('volunteer.view-history');

    // Volunteer Dashboard Route
    Route::get('dashboard', [OpportunityController::class, 'index'])->name('volunteer.dashboard');

    // Route to display the details of a specific opportunity
    Route::get('opportunities/{id}', [OpportunityController::class, 'show'])->name('opportunities.show');

    // Route to register for an opportunity
    Route::post('opportunity/register/{id}', [VolunteerController::class, 'registerForOpportunity'])->name('volunteer.registerOpportunity');

    // Route to show the edit profile form
    Route::get('profile/edit', [VolunteerController::class, 'editProfile'])->name('volunteer.edit-profile');

// Route to handle the update profile form submission
    Route::post('profile/update', [VolunteerController::class, 'updateProfile'])->name('volunteer.update-profile');

// Route to remove a qualification
    Route::delete('qualification/remove', [VolunteerController::class, 'removeQualification'])->name('volunteer.remove-qualification');

// Route to add qualifications
    Route::post('qualification/add', [VolunteerController::class, 'addQualification'])->name('volunteer.add-qualification');

    // Route to view the history of registered opportunities
    Route::get('view-history', [VolunteerController::class, 'viewHistory'])->name('volunteer.history');

// Route to generate a certificate for a specific opportunity
    Route::get('certificate/{opportunityId}', [VolunteerController::class, 'generateCertificate'])->name('volunteer.certificate');

});

Route::get('/volunteer/password/reset', [VolunteerController::class, 'showResetRequestForm'])->name('volunteer.password.request');
Route::post('/volunteer/password/email', [VolunteerController::class, 'sendResetLinkEmail'])->name('volunteer.password.email');
Route::get('/volunteer/password/reset/{token}', [VolunteerController::class, 'showResetForm'])->name('volunteer.password.reset');
Route::post('/volunteer/password/reset', [VolunteerController::class, 'reset'])->name('volunteer.password.update');

Route::post('/volunteer/update-interests', [VolunteerController::class, 'updateInterests'])->name('volunteer.update-interests');

Route::get('/certificate/download/{registrationId}', [VolunteerController::class, 'downloadCertificate'])->name('downloadCertificate');



// Organization Routes
Route::prefix('organization')->group(function () {
    Route::get('login', [OrganizationController::class, 'showLoginForm'])->name('organization.login');
    Route::post('login', [OrganizationController::class, 'login']);
    Route::get('register', [OrganizationController::class, 'showRegistrationForm'])->name('organization.register');
    Route::post('register', [OrganizationController::class, 'register']);
    Route::post('logout', [OrganizationController::class, 'logout'])->name('organization.logout');

    // Organization Dashboard Route
    Route::get('dashboard', [OrganizationController::class, 'showDashboard'])
        ->middleware('auth:organization')
        ->name('organization.dashboard');

    // Opportunity Management Routes
    Route::get('create-opportunity', [OrganizationController::class, 'createOpportunity'])->name('organization.create-opportunity');
    Route::post('store-opportunity', [OrganizationController::class, 'storeOpportunity'])->name('organization.store-opportunity');

    Route::get('validate-registration', [OrganizationController::class, 'validateRegistration'])->name('organization.validate-registration');
    Route::get('/edit-profile', [OrganizationController::class, 'editProfile'])->name('organization.edit-profile');
    Route::post('/update-profile', [OrganizationController::class, 'updateProfile'])->name('organization.update-profile');

    Route::get('/generate-certificate', [OrganizationController::class, 'generateCertificate'])->name('organization.generate-certificate');

    Route::get('confirm-attendance', [AttendanceController::class, 'confirmAttendance'])
        ->middleware('auth:organization') // Ensure that only authenticated organizations can access this route
        ->name('attendance.confirm');

    Route::get('confirm-attendance/{oppId}/registrations', [AttendanceController::class, 'showRegistrations'])
        ->middleware('auth:organization')
        ->name('registrations.show');

    Route::post('attendance', [AttendanceController::class, 'storeAttendance'])
        ->middleware('auth:organization')
        ->name('attendance.store');


});

Route::get('/opportunities/manage/{id}', [OpportunityController::class, 'manage'])->name('opportunities.manage');
Route::get('/opportunities/{id}/edit', [OpportunityController::class, 'edit'])->name('opportunities.edit');
Route::delete('/opportunities/{id}', [OpportunityController::class, 'destroy'])->name('opportunities.destroy');
Route::put('/opportunities/{id}', [OpportunityController::class, 'update'])->name('opportunities.update');

// Approve Registration
Route::post('/organization/approve-registration/{regId}', [OrganizationController::class, 'approveRegistration'])->name('organization.approve-registration');

// Reject Registration
Route::post('/organization/reject-registration/{regId}', [OrganizationController::class, 'rejectRegistration'])->name('organization.reject-registration');

//Route::get('/certificates/generate', [OrganizationController::class, 'generateCertificate'])->name('certificates.generate');
Route::post('/certificates/update', [OrganizationController::class, 'updateCertStatus'])->name('certificates.update');

// Route to display past opportunities for certificate generation
Route::get('/organization/certificates', [CertificateController::class, 'showPastOpportunities'])
    ->name('certificates.pastOpportunities')
    ->middleware('auth:organization');

// Route to generate a certificate for a specific registration
Route::post('/organization/certificates/generate/{registration}', [CertificateController::class, 'generateCertificate'])
    ->name('certificates.generate')
    ->middleware('auth:organization');

// Route to display volunteers for a specific opportunity
Route::get('/organization/certificates/volunteers/{opportunity}', [CertificateController::class, 'showVolunteers'])
    ->name('certificates.volunteers')
    ->middleware('auth:organization');


// Admin Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/add', [AdminController::class, 'showAddAdminForm'])->name('admin.add.form');
    Route::post('/admin/add', [AdminController::class, 'addAdmin'])->name('admin.add');

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // ... existing routes ...

    Route::get('volunteers', [AdminController::class, 'indexVolunteers'])->name('admin.volunteers.index');
    Route::get('volunteers/{id}', [AdminController::class, 'showVolunteer'])->name('admin.volunteers.show');
    Route::delete('volunteers/{id}', [AdminController::class, 'terminateVolunteer'])->name('admin.volunteers.terminate');

    Route::get('organizations', [AdminController::class, 'indexOrganizations'])->name('admin.organizations.index');
    Route::get('organizations/{id}', [AdminController::class, 'showOrganization'])->name('admin.organizations.show');
    Route::delete('organizations/{id}', [AdminController::class, 'terminateOrganization'])->name('admin.organizations.terminate');

    // Route to show the edit form for an admin
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');

    // Route to update an admin
    Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');

    // Route to delete an admin
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

    Route::get('/admin/opportunities', [AdminController::class, 'indexOpportunities'])->name('admin.opportunities.index');
    Route::get('/admin/opportunities/{id}/edit', [AdminController::class, 'editOpportunity'])->name('admin.opportunities.edit');
    Route::put('/admin/opportunities/{id}', [AdminController::class, 'updateOpportunity'])->name('admin.opportunities.update');
    Route::delete('/admin/opportunities/{id}', [AdminController::class, 'deleteOpportunity'])->name('admin.opportunities.delete');

    Route::get('/admin/opportunities/{id}/view', [AdminController::class, 'viewOpportunity'])->name('admin.opportunities.view');
});


Route::get('certificates/bulk/form', [CertificateController::class, 'showBulkCertificateForm'])->name('certificates.bulk_form');
Route::post('certificates/bulk/generate', [CertificateController::class, 'generateBulkCertificates'])->name('certificates.bulk_generate');


Route::get('/volunteer/certificates/{certificate}', [CertificateController::class, 'showCertificate'])
    ->name('volunteer.show-certificate')
    ->middleware('auth');

Route::get('/volunteer/certificates', [CertificateController::class, 'viewCertificates'])
    ->name('volunteer.certificates')
    ->middleware('auth');


Route::get('/admin/register', [AdminController::class, 'showRegisterForm'])->name('admin.register.form');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register');

Route::get('/admin/approved-organizations', [AdminController::class, 'showApprovedOrganizations'])->name('admin.approved.organizations');

Route::post('/admin/organizations/accept/{id}', [AdminController::class, 'acceptOrganization'])->name('admin.organizations.accept');
Route::post('/admin/organizations/reject/{id}', [AdminController::class, 'rejectOrganization'])->name('admin.organizations.reject');

Route::get('/admin/manage', [AdminController::class, 'manageAdmins'])->name('admin.manage');
