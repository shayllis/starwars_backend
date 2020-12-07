<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Term;
use App\Models\Category;
use App\Models\Visited;
use App\Models\Device;

class EventsController extends Controller
{
    private function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'data' => $errorMessages ?: ''
        ];

        return response()->json($response, $code);
    }

    public function view(Request $request)
    {

        $data = [
            'device_id' => $request->get('device_id'),
            'category_id' => Category::where('name', $request->category)->first()->id ?? null,
            'item' => $request->input('item')
        ];

        $validator = Validator::make($data, [
            'device_id' => 'required|integer|different:from_user_id,exists:devices,id',
            'category_id' => 'required|integer|different:from_user_id,exists:categories,id',
            'item' => 'required',
        ]);

        // Validation
        if ($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors());

        $visited = new Visited();
        $visited->fill($data)
            ->save();

        return response(null, 200);
    }

    public function search(Request $request)
    {
        $data = [
            'device_id' => $request->get('device_id'),
            'category_id' => Category::where('name', $request->category)->first()->id ?? null,
            'term' => $request->input('q')
        ];


        //  Basic validation rules
        $validator = Validator::make($data, [
            'device_id' => 'required|integer|different:from_user_id,exists:devices,id',
            'category_id' => 'required|integer|different:from_user_id,exists:categories,id',
            'term' => 'required',
        ]);

        // Validation
        if ($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors());

        $term = new Term();
        $term->fill($data)
            ->save();

        return response(null, 200);
    }
}
