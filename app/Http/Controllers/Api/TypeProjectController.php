<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;

class TypeProjectController extends Controller
{
    public function __invoke(string $slug)
    {
        $type = Type::whereSlug($slug)->first();
        if (!$type) return response(null, 404);

        $projects = Project::whereTypeId($type->id)
            ->whereIsCompleted(true)
            ->with('technologies', 'type')
            ->get();

        return response()->json(['projects' => $projects, 'label' => $type->label ]);
    }
}
