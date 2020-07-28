<?php

namespace App\Http\Controllers;

use App\Model\Athlete;
use App\Model\Team;
use App\Model\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $teams = Team::with('tournament.user','payment')->get();
        } else {
            $teams = Team::with('tournament.user','payment')->where('user_id',auth()->id())->get();
        }
        return view('team.table',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Team::create([
            'id' => $request['id'],
            'name' => $request['name'],
            'tournament_id' => $request['tournament_id'],
            'user_id' => auth()->id(),
        ]);
        return redirect('listTeams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTeam($id)
    {
        $team = Team::find($id);
        $team->delete();
        return response()->json(['success'=>'done']);
    }

    public function destroyAthlete($id)
    {
        $athlete = Athlete::with('tournament.team.user')->find($id);
        $team_id = $athlete->team->id;
        $team_name = $athlete->team->name;
        $tournament_id = $athlete->tournament->id;
        $tournament_athlete = $athlete->tournament->athlete;
        $tournament_title = $athlete->tournament->title;
        $athlete->delete();
        $count = Athlete::where('team_id',$team_id)->count();
        return response()->json([
            'count'=>$count, 
            'team_id' => $team_id, 
            'user_id' => auth()->id(),
            'tournament_id' => $tournament_id, 
            'athleteTotal' => $tournament_athlete, 
            'title' => $tournament_title,
            'teamName' => $team_name]);
    }

    public function addAthlete(Request $request)
    {
        $rules = [];

        foreach($request->input('first','last') as $key => $value) {
            $rules["first.{$key}"] = 'required';
            $rules["last.{$key}"] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->validated()) {
            $first = $request->input('first');
            foreach($request->input('last') as $key => $value) {
                Athlete::create([
                    'user_id'=>$request->user_id,
                    'team_id'=>$request->team_id,
                    'tournament_id'=>$request->tournament_id,
                    'first'=>$first[$key],
                    'last'=>$value,
                    ]);
                    $athlete = Athlete::with('team.tournament.user')->where('tournament_id',$request->tournament_id)->where('team_id',$request->team_id)->where('user_id',auth()->id())->get();
                    $tournament_athlete = Tournament::where('id',$request->tournament_id)->pluck('athlete');
                    $tournament_name = Tournament::where('id',$request->tournament_id)->pluck('title');
                    $team_name = Team::where('id',$request->team_id)->pluck('name');
                    $count = $athlete->count();
                    $team_id = $request->team_id;
                    $tournament_id = $request->tournament_id;
                }
            return response()->json([
                'count'=>$count, 
                'key' => $key, 
                'value' => $value, 
                'team_id' => $team_id, 
                'user_id' => auth()->id(),
                'tournament_id' => $tournament_id, 
                'athleteTotal' => $tournament_athlete, 
                'title' => $tournament_name,
                'teamName' => $team_name]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    //Make DataTable Athlete
    public function athleteByTeam(Request $request, $id)
    {
        if($request->ajax())
        {
            $data = Athlete::where('team_id',$id)->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    // $button = '<span type="button" name="edit" id="'.$data->id.'" class="edit disabled btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i></span>';
                    $button = '<span type="button" name="edit" id="'.$data->id.'" data-id="'.$data->id.'" class="delete-athlete btn btn-danger btn-sm m-1"><i class="fas fa-trash"></i></span>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    // Get Data for Payment
    public function getDataPayment( $id)
    {
        $team = Team::with('tournament.user','payment')->findOrFail($id);
        $user_id = $team->user->id;
        $team_id = $team->id;
        $tournament_id = $team->tournament->id;
        $user_name = $team->user->name;
        $user_email = $team->user->email;
        $amount = $team->tournament->fee;
        $payment_type = 'Registration';

        return response()->json([
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'tournament_id' => $tournament_id,
            'amount' => $amount,
            'team_id' => $team_id,
            'payment_type' => $payment_type,
            ]);
    }
}
