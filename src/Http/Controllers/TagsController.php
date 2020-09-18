<?php

namespace Laravel\Telescope\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Telescope\Storage\EntryTagModel;

class TagsController extends Controller
{
    /**
     * Get all of the tags being monitored.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'tags' => EntryTagModel::getTags(),
        ]);
    }
}
