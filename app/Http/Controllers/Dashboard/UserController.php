<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('view', User::class);
        $query = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $users = $query->paginate(10);


        return view('dashboard.users.index', compact('users'));
    }


    public function create(Request $request)
    {
        $this->authorize('create', User::class);
        $user = new User();
        return view('dashboard.users.create', compact('user'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required|same:password',
        ], [
            'password.same' => 'كلمة المرور غير متطابقة',
            'confirm_password.same' => 'كلمة المرور غير متطابقة',
        ]);
        DB::beginTransaction();
        try {
            $request['password'] = Hash::make($request->password);
            $request['type'] = 'admin';
            $user = User::create($request->all());
            if($request->abilities){
                foreach ($request->abilities as $role) {
                    RoleUser::create([
                        'role_name' => $role,
                        'user_id' => $user->id,
                        'ability' => 'allow',
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect()->route('dashboard.users.index')->with('success', 'تم اضافة مستخدم جديد');
    }


    public function show(User $user)
    {
        //
    }


    public function profile(User $user)
    {
        if (auth()->user()->id != $user->id) {
            $this->authorize('view', User::class);
        }
        return view('dashboard.users.profile', compact('user'));
    }



    public function edit(Request $request, User $user)
    {
        $this->authorize('edit', User::class);
        $btn_label = __('Edit');
        return view('dashboard.users.edit', compact('user', 'btn_label'));
    }


    public function update(Request $request, User $user)
    {
        $this->authorize('edit', User::class);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
            // 'confirm_password' => 'nullable|same:password',
        ]);
        DB::beginTransaction();
        try {
            if($request->super_admin == null){
                $request['super_admin'] = $user->super_admin;
            }
            if ($request->password != null) {
                $request['password'] = Hash::make($request->password);
                $request['type'] = 'admin';
                $user->update($request->all());
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'super_admin' => $request->super_admin ?? $user->super_admin,
                    'type' => 'admin',
                ]);
            }

            if ($request->abilities != null) {
                $role_old = RoleUser::where('user_id', $user->id)->pluck('role_name')->toArray();
                $role_new = $request->abilities;
                foreach ($role_old as $role) {
                    if (!in_array($role, $role_new)) {
                        RoleUser::where('user_id', $user->id)->where('role_name', $role)->delete();
                    }
                }
                foreach ($role_new as $role) {
                    $role_f = RoleUser::where('user_id', $user->id)->where('role_name', $role)->first();
                    if ($role_f == null) {
                        RoleUser::create([
                            'role_name' => $role,
                            'user_id' => $user->id,
                            'ability' => 'allow',
                        ]);
                    } else {
                        $role_f->update(['ability' => 'allow']);
                    }
                }
            } else {
                RoleUser::where('user_id', $user->id)->delete();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect()->back()->with('success', 'تم تعديل المستخدم');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', User::class);
        $user->delete();
        return redirect()->route('dashboard.users.index')->with('success', 'تم حذف المستخدم');
    }
}
