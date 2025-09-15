<?php

use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\ClubsWeaponsController;
use App\Models\Logs;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
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


            //Clubs-Weapons routes
            Route::prefix('clubs-weapons')->group(function () {
                Route::get('{cid}', [ClubsWeaponsController::class, 'index'])->name('clubs-weapons.index');
                Route::post('store', [ClubsWeaponsController::class, 'store'])->name('clubs-weapons.store');
                Route::get('{cwid}/edit', [ClubsWeaponsController::class, 'edit'])->name('clubs-weapons.edit');
                Route::put('{cwid}', [ClubsWeaponsController::class, 'update'])->name('clubs-weapons.update');
                Route::delete('{cwid}', [ClubsWeaponsController::class, 'destroy'])->name('clubs-weapons.destroy');
                Route::post('{cwid}/toggle', [ClubsWeaponsController::class, 'toggleStatus'])->name('clubs-weapons.toggle-status');
            });
        });
    }
);



require __DIR__ . '/auth.php';
