<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

use Auth;
use DataTables;
use App\Http\Controllers\GeneralController as GC;
use App\Http\Controllers\AuditController as AC;
use App\Http\Controllers\AccessController as ACC;
use App\Models\User;
use App\Models\AccessLogs as AL;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Users
     */
    public function index()
    {
        return view('user-logs.logs');
    }

    public function index2()
    {
        return view('users.user');
    }

    /**
     * Access Logs
     */
    public function accessLogs()
    {
        return view('user-logs.logs');
    }

    /**
     * Users Grant Access
     */
    public function usersGrantAccess($id)
    {
        return view('user.users-grant-access', ['user_id' => GC::decryptString($id)]);
    }

    /**
     * Users JSON
     *
     * Fetches users from API and returns a JSON response, which is used by
     * DataTables to populate the table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userJson(Request $request)
    {
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
                    'full_name' => $full_name,
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
    
        $usersCollection = collect($users);
    
        // Apply search filter
        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $usersCollection = $usersCollection->filter(function ($user) use ($search) {
                return str_contains(strtolower($user['full_name']), $search) || str_contains(strtolower($user['role']), $search);
            });
        }
    
        // Apply sorting
        if ($request->has('sort_by') && $request->has('sort_order')) {
            $sortBy = $request->input('sort_by');
            $sortOrder = strtolower($request->input('sort_order')) === 'desc' ? 'desc' : 'asc';
        
            // Handle sorting of 'system_access' separately because it contains HTML
            if ($sortBy === 'system_access') {
                $usersCollection = $usersCollection->sortBy(function ($user) {
                    return strpos($user['system_access'], 'Granted') !== false ? 1 : 0;
                }, SORT_REGULAR, $sortOrder === 'desc');
            } else {
                $usersCollection = $sortOrder === 'desc' ? 
                    $usersCollection->sortByDesc($sortBy) : 
                    $usersCollection->sortBy($sortBy);
            }
        
            // Re-index the collection after sorting
            $usersCollection = $usersCollection->values();
        }
        
    
        // Pagination
        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $currentItems = $usersCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();
    
        // Create LengthAwarePaginator instance
        $paginatedUsers = new LengthAwarePaginator($currentItems, count($usersCollection), $perPage, $currentPage, [
            'path' => url()->current(),
            'query' => $request->query(),
        ]);
    
        return response()->json($paginatedUsers);
    }
    
    /**
     * Grant or revoke access to a user
     *
     * @param int $id The ID of the user
     * @param string|null $role The role to assign to the user
     * @param string|null $action The action to perform (grant or revoke)
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function grantAccess($id, $role = null, $action = null)
    {
        try {
            $id = GC::decryptString($id);
            if ($action == 'revoke')
            {
                $user = User::find($id);
                if ($user->delete()) {
                    $log_entry = [
                        'Revoked Access',
                        'users',
                        '',
                        $user,
                    ];
                    AC::logEntry($log_entry);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Access revoked successfully.',
                        'user' => $user
                    ]);
                }
            }else
            {
                $user = new User();
                // $old_value = $user->getOriginal(); // Get original data before changes

                $user->id = $id;
                $user->role = $role;

                if ($user->save()) {
                    $log_entry = [
                        'Granted Access',
                        'users',
                        '',
                        $user,
                    ];
                    AC::logEntry($log_entry);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Access granted successfully.',
                        'user' => $user
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public static function accessLogEntry($id)
    {
    	$log = new AL();
    	$log->user_id = $id;
    	$log->save();
    }
    public function accessLogsJson(Request $request) {
        $data = AL::all();
        $access_logs = [];
    
        if (!empty($data)) {
            foreach ($data as $d) {
                $access_logs[] = [
                    'id' => $d->id,
                    'user_id' => $d->user_id,
                    'full_name' => GC::getUserFullName($d->user_id),
                    'date_time' => Carbon::parse($d->created_at)->format('Y-m-d H:i:s'),
                ];
            }
        }
    
        // Convert array to collection
        $usersCollection = collect($access_logs);
    
        // Get search query
        $search = $request->input('search', '');
    
        // Filter results if search query is provided
        if (!empty($search)) {
            $usersCollection = $usersCollection->filter(function ($item) use ($search) {
                return stripos($item['full_name'], $search) !== false ||
                       stripos($item['user_id'], $search) !== false ||
                       stripos($item['id'], $search) !== false ||
                       stripos($item['date_time'], $search) !== false;
            });
        }
    
        // Get sorting parameters
        $sortBy = $request->input('sortBy', 'date_time');
        $order = $request->input('order', 'desc');
    
        // Sort data
        $usersCollection = ($order === 'desc') ? $usersCollection->sortByDesc($sortBy) : $usersCollection->sortBy($sortBy);
    
        // Pagination
        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $currentItems = $usersCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();
    
        // Create paginator
        $paginatedUsers = new LengthAwarePaginator($currentItems, $usersCollection->count(), $perPage, $currentPage, [
            'path' => url()->current(),
            'query' => $request->query(),
        ]);
    
        return response()->json($paginatedUsers);
    }    
}
