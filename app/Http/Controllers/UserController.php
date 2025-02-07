<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use Auth;
use DataTables;
use App\Http\Controllers\GeneralController as GC;
use App\Http\Controllers\AuditController as AC;
use App\Http\Controllers\AccessController as ACC;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Users
     */
    public function index()
    {
        return view('users.user');
    }

    /**
     * Users Grant Access
     */
    public function usersGrantAccess($id)
    {
        return view('user.users-grant-access', ['user_id' => GC::decryptString($id)]);
    }

    /**
     * [userJsons Return Format in JSON]
     * @param  Request $request HTTP Request
     * @return JSON Format
     */
    public function userJson(Request $request)
    {
        // if ($request->ajax()) {
            $url = config('app.root_domain') . config('app.users_api_slug');

            $response = file_get_contents($url);
            $data = json_decode($response);
            $users = [];

            if (!empty($data)) {
                foreach ($data as $d) {
                    $id = GC::decryptString($d->id);
                    $full_name = $d->first_name . ' ' . $d->last_name;
                    $users[] = [
                        'id' => $id,
                        'first_name' => $d->first_name,
                        'last_name' => $d->last_name,
                        'system_access' => GC::checkUserAccess($id) ? '<span style="color: green;"><i class="fa-solid fa-check" style="color: green;"></i> Granted</span>' : '<span style="color: red;"><i class="fa-regular fa-circle-xmark" style="color: red;"></i> No Access</span>',
                        'role' => GC::checkUserRole($id),
                        'action' => GC::checkUserAccess($id) ?
                            '<button class="no-background AccessBtn" data-id="' . $d->id . '" data-name="' . $full_name . '" data-action="revoke" data-role="user">
                                <i class="fa-regular fa-circle-xmark" id="revoke-action" toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Revoke Access"></i>
                            </button>'
                            :
                            '<button class="no-background AccessBtn" data-id="' . $d->id . '" data-name="' . $full_name . '" data-action="grant" data-role="user">
                                <i class="fa-solid fa-check" id="grant-action" toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Grant Access"></i>
                            </button>'
                        ,
                    ];
                }
            }

            // Convert array to Laravel Collection for pagination
            $usersCollection = collect($users);
            $perPage = 10; // Number of users per page
            $currentPage = $request->input('page', 1);
            $currentItems = $usersCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

            // Create LengthAwarePaginator instance
            $paginatedUsers = new LengthAwarePaginator($currentItems, count($usersCollection), $perPage, $currentPage, [
                'path' => url()->current(),
                'query' => $request->query(),
            ]);

            return response()->json($paginatedUsers);
        // }
    }


    /**
     * Grant Access with Role in the System
     * @param   $id User ID from Auth, $role role type
     * @return  True or False Value
     */
    public function grantAccess($id = null, $role = null)
    {
        $id = GC::decryptString($id);
        $user = User::findOrFail($id);
        $name = GC::getUserFullName($id);
        $old_value = $user;
        if($user){
            $user->name = $name;
            $user->role = $role;
            if($user->save()) {
                // [action, table, old_value, new_value]
                $log_entry = [
                    'Granted Access',
                    'users',
                    $old_value,
                    $user,
                ];
                AC::logEntry($log_entry);
            }
        }
        else {
            $user = new User();
            $user->id = $id;
            $user->name = $name;
            $user->role = $role;
            if($user->save()) {
                // [action, table, old_value, new_value]
                $log_entry = [
                    'Granted Access',
                    'users',
                    '',
                    $user,
                ];
                AC::logEntry($log_entry);
                return redirect('/users')->with('success_message', 'Access Granted!');
            }
            return redirect('/users')->with('success_message', 'Access Granted!');
        }

    }
}
