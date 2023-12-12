<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //

    public function index()
    {
        try {
            $users = User::paginate(10);
            return view('userManager', ['users' => $users]);
        } catch (\Throwable $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function searchUser(Request $request)
    {
        try {
            $search = $request->get('search');
            $searchWords = explode(' ', $search);
            $users = User::query();

            foreach ($searchWords as $word) {
                $users->where(function ($query) use ($word) {
                    $query->where('name', 'like', '%' . $word . '%')
                        ->orWhere('lastname', 'like', '%' . $word . '%');
                });
            }

            //User not found
            if($users->count() == 0)
            {
                return back()->with('message', 'No se encontró el usuario.');
            }

            return view('userManager', ['users' => $users->paginate(10)]);
        } catch (\Throwable $exception) {
            throw new \Exception($exception->getMessage());
        }
        //return response()->json($users->get());
        //return response()->json($users->paginate(10)); // Change 10 to the number of items you want per page
        //$users = User::where('name', 'like', '%' . $search . '%')->get();
        //return response()->json($users);
    }

    public function toggleUser($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                if ($user->status == 'disabled'){
                    $user->status = 'active';
                }
                else{
                    $user->status = 'disabled';
                }
                $user->save();
            }
            //return response()->json($user);
            return redirect()->route('admin');
        } catch (\Throwable $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

}
