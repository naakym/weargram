<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Follower;

class UsersController extends Controller
{
    public function index(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('profiles.users', [
            'all_users'  => $all_users
        ]);
    }

//ユーザー削除管理者
    public function show(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('profiles.admin', [
            'all_users'  => $all_users
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('timeline');
    }

//ユーザー退会
    public function shows(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('profiles.index', [
            'all_users'  => $all_users
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('login');
    }

}
