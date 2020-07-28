<?php

namespace App\Http\Controllers;

use App\Model\Age;
use App\Model\Promotor;
use App\Model\Team;
use App\Model\Province;
use App\Model\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use function PHPSTORM_META\type;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $tournaments = Tournament::get();
        } else {
            $tournaments = Tournament::where('user_id',auth()->id())->get();
        }
        return view('tournament.table',compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ages = Age::all();
        $user = User::with('promotor')->findOrFail(auth()->id());
        return view('tournament.create',compact('ages'),['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tournament::create([
            'title' => $request['title'],
            'description' => $request['description'],
            // 'tournament_code' => Hash::make($request->title),
            'pricePool' => $request['pricepool'],
            'slot' => $request['slot'],
            'fee' => $request['fee'],
            'athlete' => $request['athlete'],
            'dateRegisLimit' => $request['dateRegisLimit'],
            'dateInitial' => $request['dateInitial'],
            'dateFinal' => $request['dateFinal'],
            'user_id' => auth()->id(),
        ]);
        return redirect('listTournaments');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $check = Team::where('tournament_id',$id)->where('user_id',auth()->id())->get()->count();
        return view('tournament.detail', compact('check') ,['tournament' => Tournament::with('district.city.province','user.promotor','team')->findOrFail($id)]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ages = Age::all();
        $tournament = Tournament::with('user.promotor')->findOrFail($id);
        return view('tournament.edit',compact('ages'), ['tournament' => Tournament::with('user.promotor')->findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tournament = Tournament::find($id);

        $tournament->update([
            // 'tournament_code' => Hash::make($request->title),
            'title' => $request->title,
            'description' => $request->description,
            'pricepool' => $request->pricePool,
            'slot' => $request->slot,
            'fee' => $request->fee,
            'athlete' => $request->athlete,
            'dateRegisLimit' => $request->dateRegisLimit,
            'dateInitial' => $request->dateInitial,
            'dateFinal' => $request->dateFinal,
            'user_id' => auth()->id(),
        ]);
        return redirect('listTournaments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tournament = Tournament::find($id);
        $tournament->delete();
        return response()->json(['success'=>'done']);
    }
}
