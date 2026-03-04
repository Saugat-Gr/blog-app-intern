<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditUserRequest;
use App\Models\User;
use App\Models\UserRequest;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Traits\ToastrTrait;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use ToastrTrait;

    protected $adminRepo;


    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->adminRepo = $adminRepo;
        $this->middleware("auth.check");
    }


    public function dashboard()
    {

        $totalUsers = $this->adminRepo->countAllUsers();
        $activeUsers = $this->adminRepo->countAllUsersByStatus(UserStatus::ACTIVE);
        $inactiveUsers = $this->adminRepo->countAllUsersByStatus(UserStatus::INACTIVE);
        $suspendedUsers = $this->adminRepo->countAllUsersByStatus(UserStatus::SUSPENDED);

        $recentUsers = $this->adminRepo->getRecentUsers(UserStatus::ACTIVE, 5);

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'suspendedUsers',
            'recentUsers'
        ));
    }

    public function index()
    {
        $users = $this->adminRepo->getAllUsers();
        return view('admin.user.users', compact('users'));
    }


    public function create()
    {
        //
    }


    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.admin-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function renderUserRequest()
    {

        $requests = UserRequest::with('user')->where('status', '!=', 'approved')->get();

        return view('admin.user.UserRequest', compact('requests'));
    }

    public function accUserRequest(UserRequest $userRequest)
    {

        if ($userRequest->status === "pending") {
            $userRequest->status = "approved";

            $userRequest->save();
            $user = $userRequest->user;
            $user->status = UserStatus::ACTIVE;

            $user->save();

            return redirect()->route("admin.dashboard");
        }

    }

    public function declineUserRequest(UserRequest $userRequest)
    {

        if ($userRequest->status === "pending") {
            $userRequest->status = "rejected";

            $userRequest->save();

            return redirect()->route("admin.dashboard");
        }

    }

    public function filterUsers(Request $request)
    {

        $status = $request->query('status');

        $users = $status === 'all' ? $this->adminRepo->getAllUsers() : $this->adminRepo->getUsersByStatus($status);

        return view('admin.user._user-cards', compact('users'));

    }

    public function destroyUser(User $user)
    {
        $deleteUser = $this->adminRepo->destroyUser($user);

        if ($deleteUser) {
            $this->toastrSuccess("User deleted successfully");
        } else {
            $this->toastrError("Failed to delete user");
        }

        return redirect()->route('admin.dashboard');
    }

    public function suspendUser(User $user)
    {

        $suspendUser = $this->adminRepo->suspendUser($user);

        if ($suspendUser) {
            $this->toastrSuccess("User suspended successfully");
        } else {
            $this->toastrError("Failed to suspend user");
        }

        return redirect()->route('admin.dashboard');

    }


    public function createUser()
    {
        $statuses = UserStatus::cases();
        return view('admin.user.create', compact('statuses'));
    }


    public function editUser(User $user)
    {
        $statuses = UserStatus::cases();
        return view('admin.user.edit', compact('user', 'statuses'));
    }

    public function updateUser(AdminEditUserRequest $request, User $user)
    {

        $validated_data = $request->validated();

        $updated =  $this->adminRepo->updateUser($user, $validated_data);

        if ($updated) {
            $this->toastrSuccess("User updated successfully");
        } else {
            $this->toastrError("Failed to update user");
        }

        return redirect()->route('admin.index');
    }

}
