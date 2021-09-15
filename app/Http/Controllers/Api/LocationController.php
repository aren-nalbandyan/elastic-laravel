<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = [];
        if ($request->has('search')) {
            $locations = Location::search( $request->input('search') )->toArray();
        }

        return response()->json(['success' => true, 'data' => $locations], 200);
    }

    public function create(Request $request)
    {
        $validatedData = $this->validate($request, [
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);

        $location = Location::create($validatedData);
        $location->addToIndex();

        return response()->json(['success' => true, 'message' => 'Successfully stored'], 200);
    }
}
