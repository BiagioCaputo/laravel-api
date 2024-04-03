<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;

class TechnologyProjectController extends Controller
{
    public function __invoke(string $slug)
    {
        $technology = Technology::whereSlug($slug)->first();
        if (!$technology) return response(null, 404);

        $technology_id = $technology->id;

        $projects = Project::whereIsCompleted(true)->whereHas('technologies', function ($query) use ($technology_id){
            $query->where('technologies.id', $technology_id);
        })->with('technologies', 'type')->get();

        return response()->json(['projects' => $projects, 'label' => $technology->label ]);
    }
}
