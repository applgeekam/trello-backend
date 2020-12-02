<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function save (Request $request)
    {
        $this->validateRequest($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'secteur' => ['required', 'string', 'max:255'],
        ]);

        $team = new Team;
        $team->fill($request->only(['name', 'secteur']));
        $team->save();

        return response()->json(['team_id' => $team->id], 200);
    }

}