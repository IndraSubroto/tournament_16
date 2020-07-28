<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Payment;
use App\Model\Promotor;
use App\Model\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::all()->count();
        $tournaments = Tournament::paginate(6);
        $count = Tournament::all()->count();
        $promotor = Promotor::all()->count();
        $payment = Payment::where('status','success')->count();
        return view('home',compact('user','tournaments','promotor','payment','count'));
    }

    public function userTable(Request $request)
    {
        $users = User::all();
        return view('user.table',compact('users'));
    }

    public function changeRole($id)
    {
        $user = User::find($id);

        if ($user->role_id == '2') {
            $user->update([
                'role_id'=>'3',
            ]);
            $role = '3';
        } elseif($user->role_id == '3'){
            $user->update([
                'role_id'=>'2',
            ]);
            $role = '2';
        }
        return response()->json(['role'=>$role]);
    }
}
