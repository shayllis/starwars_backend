<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\MostVisited;
use App\Models\MostRequested;
use App\Http\Resources\MostRequestedResource;
use App\Http\Resources\MostVisitedResource;

class StatisticsController extends Controller
{
    public function terms()
    {
        $query = MostRequested::query();
        $query
            ->orderBy('views','desc');

        return response()->json(['data' => MostRequestedResource::collection($query->paginate(20))]);
    }

    public function items()
    {
        $query = MostVisited::query();
        $query
            ->orderBy('views','desc');

        return response()->json(['data' => MostVisitedResource::collection($query->paginate(20))]);
    }
}
