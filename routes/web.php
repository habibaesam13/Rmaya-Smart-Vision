<?php

use App\Http\Controllers\FinalResultsController;
use App\Models\Logs;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\ResultsService;
use Illuminate\Support\Facades\App;
use App\Exports\GroupsExportProvider;
use Illuminate\Support\Facades\Route;
use App\Exports\MembersExportProvider;
use App\Exports\PersonalResultsExport;
use App\Http\Controllers\PDFController;
use App\Services\GroupsDetailsProvider;
use App\Services\GroupsMembersProvider;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\GroupController;
use App\Services\PersonalMembersProvider;
use App\Services\PersonalResultsProvider;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultsController;
use App\Exports\GroupsMembersExportProvider;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Services\PersonalWeaponReportProvider;
use App\Http\Controllers\ClubsWeaponsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\PublicRegistration\PersonalRegistration;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/', function () {
        return view('admin.index');
    })->middleware('auth');

    Route::get('/dashboard', function () {
        return view('admin.index');
    })->middleware(['auth', 'verified'])->name('dashboard');
});




Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');








Route::name('admin.')->group(
    function () {
        /***************admin////////*/
        Route::group(
            [
                'prefix' => LaravelLocalization::setLocale() . '/admin',
                'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
            ],
            function () { //...
                Route::get('test', function () {
                    return view('admin/role-permission/role/test');
                });






                #############################################guest visitor ############################
                Route::group(
                    [
                        'middleware' => ['guest:web']
                    ],
                    function () { //...
                        Route::get('/login', function () {
                            return view('auth/login');
                        })->name('login');
                    }
                );
                ############################################# guest visitor ############################







                ############################################# auth   ############################
                Route::group(
                    [
                        'middleware' => ['auth:web']
                    ],
                    function () { //...

                        Route::get('/', function () {
                            return view('admin/index');
                        });

                        Route::get('/dashboard', function () {
                            return view('admin/index');
                        })->name('main_dashboard.index');

                        /*******start roles permissions *************/
                        Route::resource('users', UserController::class);
                        Route::get('users/{userId}/delete', [UserController::class, 'destroy'])->name('users.delete');
                        Route::resource('roles', RoleController::class);
                        Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy'])->name('roles.delete');
                        Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('roles.add-permissions');
                        Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('roles.give-permissions');
                        //    Route::get('test_roles/{id}' , [RoleController::class , 'giveModuleToRole'])->name('test_roles');
                        //    Route::get('give_roles_to_user/{id}' , [RoleController::class , 'giveRoleToUserShow']);
                        Route::get('give_module_to_role/{id}', [RoleController::class, 'giveModuleToRoleShow'])->name('give_module_to_role_show');
                        Route::put('give_module_to_role_store/{id}', [RoleController::class, 'giveModuleToRoleStore'])->name('give_module_to_role_store');
                        /*******end roles permissions *************/


                        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
                        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
                        Route::resource('logs', LogsController::class)->except('edit', 'update', 'store', 'edit', 'show');
                        Route::resource('users', UserController::class);
                        Route::get('users/{userId}/delete', [UserController::class, 'destroy'])->name('users.delete');
                        Route::resource('roles', RoleController::class);
                        Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy'])->name('roles.delete');
                        Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('roles.add-permissions');
                        Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('roles.give-permissions');
                        //    Route::get('test_roles/{id}' , [RoleController::class , 'giveModuleToRole'])->name('test_roles');
                        //    Route::get('give_roles_to_user/{id}' , [RoleController::class , 'giveRoleToUserShow']);
                        Route::get('give_module_to_role/{id}', [RoleController::class, 'giveModuleToRoleShow'])->name('give_module_to_role_show');
                        Route::put('give_module_to_role_store/{id}', [RoleController::class, 'giveModuleToRoleStore'])->name('give_module_to_role_store');
                    }
                );
                ############################################# end auth   ############################


            }
        );


        //            Route::get('get_admin_logout', function () {
        //                $id = auth()->id();
        //                auth()->guard('web')->logout();
        //                Session::flush();
        //                session()->regenerate(true);



        //                Logs::create(
        //                    [
        //                        'admin_id' => $id,
        //                        'module_name' => 'users',
        //                        'item_id' => $id,
        //                        'action' => 'logout',
        //                    ]
        //                );
        //
        //
        //                return redirect()->route('admin.login');
        //            })->name('get_admin_logout');


        /**********end admin********/


        Route::get('get_admin_logout', function () {
            $id = auth()->id();
            auth()->guard('web')->logout();
            Session::flush();
            session()->regenerate(true);

            Logs::create(
                [
                    'admin_id' => $id,
                    'module_name' => 'users',
                    'item_id' => $id,
                    'action' => 'logout',
                ]
            );

            App::setLocale('ar');

            return redirect(LaravelLocalization::getURLFromRouteNameTranslated('ar', 'admin.login'));
        })->name('get_admin_logout')->middleware('auth');
    }
);




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {

        // Admin routes
        Route::prefix('admin')->group(function () {

            // Weapons routes
            Route::get('weapons', [WeaponController::class, 'index'])->name('weapons.index');
            Route::post('weapons', [WeaponController::class, 'store'])->name('weapons.store');
            Route::get('weapons/{id}/edit', [WeaponController::class, 'edit'])->name('weapons.edit');
            Route::put('weapons/{id}', [WeaponController::class, 'update'])->name('weapons.update');
            Route::delete('weapons/{id}', [WeaponController::class, 'destroy'])->name('weapons.destroy');

            // Clubs routes
            Route::get('clubs', [ClubsController::class, 'index'])->name('clubs.index');
            Route::post('clubs', [ClubsController::class, 'store'])->name('clubs.store');
            Route::get('clubs/{id}/edit', [ClubsController::class, 'edit'])->name('clubs.edit');
            Route::put('clubs/{id}', [ClubsController::class, 'update'])->name('clubs.update');
            Route::delete('clubs/{id}', [ClubsController::class, 'destroy'])->name('clubs.destroy');
            Route::post('clubs/{id}/toggle-status', [ClubsController::class, 'toggleStatus'])->name('clubs.toggle-status');
            Route::get('clubs/{cid}/weapons', [ClubsWeaponsController::class, 'getClubWeapons'])->name('clubs.weapons');
            Route::get('/clubs/{club}/weapons-by-age', [ClubsController::class, 'getWeaponsByAge'])
                ->name('clubs.weapons.by.age');

            //Clubs-Weapons routes
            Route::prefix('clubs-weapons')->group(function () {
                Route::get('{cid}', [ClubsWeaponsController::class, 'index'])->name('clubs-weapons.index');
                Route::post('store', [ClubsWeaponsController::class, 'store'])->name('clubs-weapons.store');
                Route::get('{cwid}/edit', [ClubsWeaponsController::class, 'edit'])->name('clubs-weapons.edit');
                Route::put('{cwid}', [ClubsWeaponsController::class, 'update'])->name('clubs-weapons.update');
                Route::delete('{cwid}', [ClubsWeaponsController::class, 'destroy'])->name('clubs-weapons.destroy');
                Route::post('{cwid}/toggle', [ClubsWeaponsController::class, 'toggleStatus'])->name('clubs-weapons.toggle-status');
            });



            //Personal Routes
            Route::prefix('personal')->group(
                function () {
                    Route::get('registered', [PersonalController::class, 'index'])->name('personal-registration');
                    Route::get('registered/edit', [PersonalController::class, 'edit'])->name('personal.edit');
                    Route::post('registered/update/{mid}', [PersonalController::class, 'update'])->name('personal.update');
                    Route::get('register', [PersonalController::class, 'create'])->name('personal-create');
                    Route::post('register', [PersonalController::class, 'store'])->name('personal-store');
                    Route::delete('registered', [PersonalController::class, 'destroy'])->name('personal-registration-delete');
                    Route::post('registered/toggle', [PersonalController::class, 'toggleAcivationStatus'])->name('personal-registration-toggle');
                    //excel
                    Route::post('/members/export-excel', function(Request $request){
                        $provider = new MembersExportProvider($request);
                        $controller = new ExcelController($provider);
                        return $controller->export($request, 'Personal_registered.xlsx');
                    })->name('members.export.excel');
                    // Personal PDF
                    Route::get('members/view-pdf', function (Request $request, PersonalMembersProvider $provider) {
                        $controller = new PDFController($provider, 'pdf.members', 'Registered_Members.pdf');
                        return $controller->viewPDF($request);
                    })->name('members-view-pdf');

                    Route::get('members/download-pdf', function (Request $request, PersonalMembersProvider $provider) {
                        $controller = new PDFController($provider, 'pdf.members', 'Registered_Members.pdf');
                        return $controller->downloadPDF($request);
                    })->name('members-download-pdf');
                }
            );
            //age calculation
            Route::get('/calculate-age', function (\Illuminate\Http\Request $request) {
                if ($request->has('dob')) {
                    $dob = \Carbon\Carbon::parse($request->dob);
                    $age = $dob->age;
                    return response()->json(['age' => $age]);
                }
                return response()->json(['age' => null]);
            })->name('calculate.age');

            //registered groups
            Route::prefix('groups')->group(
                function () {
                    Route::get('registered', [GroupController::class, 'index'])->name('group-registration');
                    Route::get('search', [GroupController::class, 'search'])->name('group-search');
                    Route::delete('registered', [GroupController::class, 'delete'])->name('group-destroy');
                    Route::get('registered/members', [GroupController::class, 'show'])->name('group-members');
                    Route::get('registered/edit', [GroupController::class, 'edit'])->name('group-edit');
                    Route::put('registered/{tid}/edit', [GroupController::class, 'update'])->name('group-update');
                    //Edit group member details
                    Route::get('registered/member/edit', [GroupController::class, 'editMemberData'])->name('memeber-edit');
                    Route::put('registered/member/{mid}/edit', [GroupController::class, 'updateMemberData'])->name('memeber-update');

                    Route::get('members', [GroupController::class, 'getMembersWithGroups'])->name('groups-members');
                    Route::get('members-search', [GroupController::class, 'membersByGroupSearch'])->name('groups-members-search');
                    //excel
                    Route::post('export-excel', function(Request $request, GroupService $groupService){
                        $provider = new GroupsExportProvider($request,$groupService);
                        $controller = new ExcelController($provider);
                        return $controller->export($request, 'Groups_registered.xlsx');})->name('groups.export.excel');

                    Route::post('/members/export-excel',function(Request $request){
                        $provider = new GroupsMembersExportProvider($request);
                        $controller = new ExcelController($provider);
                        return $controller->export($request, 'Groups_Members_registered.xlsx');})->name('groups.members.export.excel'); //extra
                    // Groups PDF
                    Route::get('members/view-pdf', function (Request $request, GroupsMembersProvider $provider) {
                        $controller = new PDFController($provider, 'pdf.groups_members', 'Registered_Groups_Members.pdf');
                        return $controller->viewPDF($request);
                    })->name('groups-view-pdf');

                    Route::get('members/download-pdf', function (Request $request, GroupsMembersProvider $provider) {
                        $controller = new PDFController($provider, 'pdf.groups_members', 'Registered_Groups_Members.pdf');
                        return $controller->downloadPDF($request);
                    })->name('groups-download-pdf');
                    //groups details pdf
                    Route::get('groups-details/view-pdf', function (Request $request, GroupsDetailsProvider $provider) {
                        $controller = new PDFController($provider, 'pdf.groups', 'Registered_Groups_Details.pdf');
                        return $controller->viewPDF($request);
                    })->name('view-groups-details-pdf');

                    Route::get('groups-details/download-pdf', function (Request $request, GroupsDetailsProvider $provider) {

                        $controller = new PDFController($provider, 'pdf.groups', 'Registered_Groups_Details.pdf');
                        return $controller->downloadPDF($request);
                    })->name('download-groups-details-pdf');
                }


            );
            Route::prefix('results')->group(
                function () {
                    Route::delete('report-members/{rid}/player/{player_id}', [ResultsController::class, 'deletePlayerFromReport'])
                        ->name('report-player-delete');
                    Route::get('registered-members', [ResultsController::class,'index'])->name('results-registered-members');
                    Route::get('search-members', [ResultsController::class, 'index'])->name('search-results-registered-members');

                    Route::post('generate-report', [ResultsController::class, 'store'])->name('generate-report-registered-members');
                    Route::get('report-members/{rid}', [ResultsController::class, 'show'])->name('report-members');
                    Route::post('confirm-report/{rid}', [ResultsController::class, 'confirmReport'])->name('report-confirmation');
                    Route::post('members/detailed-repoert/{rid}',[ResultsController::class, 'saveReport'])->name('detailed-members-report-save');
                    //get total for R1->10 in report
                    Route::post('calculate-total', [ResultsController::class, 'calculateTotal'])->name('calculate-total');
                    //add new player to report
                    Route::get('add-player-to-report/{rid}',[ResultsController::class, 'addPlayer'])->name('add-player-to-report');
                    Route::post('update-report-registered-members/{rid}', [ResultsController::class, 'updateReport'])->name('update-report-registered-members');
                    //report for members with same weapon
                    Route::get('report-{rid}-members/view-pdf', function (Request $request, PersonalWeaponReportProvider $provider) {
                        $controller = new PDFController($provider, 'pdf.personal_report', 'details-for-weapon-report.pdf');
                        return $controller->viewPDF($request);
                    })->name('personal-results-report-view-pdf');
                    /*for report page */
                    //pdf
                    Route::get('report-{rid}-members/download-pdf', function (Request $request, PersonalWeaponReportProvider $provider) {
                        $controller = new PDFController($provider, 'pdf.personal_report', 'details-for-weapon-report.pdf');
                        return $controller->downloadPDF($request);
                    })->name('personal-results-report-download-pdf');
                    //for index page
                    //excel
                    Route::post('personal/results/export-excel',function(Request $request,ResultsService $results_service){
                        $provider = new PersonalResultsExport($request,$results_service);
                        $controller = new ExcelController($provider);
                        return $controller->export($request, 'Personal_results_report.xlsx');})->name('personal.results.export.excel');

                    //pdf
                    Route::get('personal/results/view-pdf', function (Request $request, PersonalResultsProvider $provider) {
                        $controller = new PDFController($provider, 'pdf.members', 'Personal_Results.pdf');
                        return $controller->viewPDF($request);
                    })->name('personal-results-view-pdf');
                    Route::get('personal/results/download-pdf', function (Request $request, PersonalResultsProvider $provider) {
                        $controller = new PDFController($provider, 'pdf.members', 'Personal_Results.pdf');
                        return $controller->downloadPDF($request);
                    })->name('personal-results-download-pdf');

                    //print report data
                    // web.php
                    Route::get('/reports/{rid}/print', [ReportController::class, 'print'])->name('report.print');

                    /**Preliminary results reports - clubs - details */
                    Route::get('reports-details',[ResultsController::class,'getResportsDetails'])->name('reports-details');
                }
            );

            Route::prefix('final-results')->group(
                function () {
                    Route::get('reports' , [ FinalResultsController::class , 'index']);
                    Route::post('update-report-registered-members_final/{rid}', [FinalResultsController::class, 'updateReport'])->name('update-report-registered-members_final');
                    Route::post('generate-report_final', [FinalResultsController::class, 'store'])->name('generate-report-registered-members_final');
                    Route::post('calculate-total', [FinalResultsController::class, 'calculateTotal'])->name('calculate-total_final');
                    Route::post('final-members/detailed-repoert/{rid}',[FinalResultsController::class, 'saveReport'])->name('detailed-members-report-save_final');
                    Route::get('final-report-members/{rid}', [FinalResultsController::class, 'show'])->name('report-members_final');
                    Route::post('final-confirm-report/{rid}', [FinalResultsController::class, 'confirmReport'])->name('report-confirmation_final');

                }
            );



        });




        //Public Routes
        Route::prefix('public')->group(function(){
            //Personal Registration
            Route::prefix('personal')->group(function(){
                    Route::get('registration',[PersonalRegistration::class,'index'])->name('public-personal-registration');
                    Route::post('register',[PersonalRegistration::class,'store'])->name('store-public-personal-registration');

            });
        });
    }
);



require __DIR__ . '/auth.php';
