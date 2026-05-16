<?php

namespace App\Http\Controllers;

use App\Http\Services\TopicServices;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    protected TopicServices $topicServices;

    public function __construct(TopicServices $topicServices)
    {
        $this->topicServices = $topicServices;
    }

    public function get() {
        return response()->json($this->topicServices->get());
    }

    public function getById($id) {

        return response()->json($this->topicServices->getById($id));
    }

    public function create(Request $request) {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        return response()->json($this->topicServices->create($request->input('name')));
    }

    public function update(Request $request) {
        $request->validate([
            'id' => ['required', 'int'],
            'name' => ['required', 'string'],
        ]);

        return response()->json($this->topicServices->update($request->input('id'), $request->input('name')));
    }

    public function delete($id) {
        return response()->json($this->topicServices->delete($id));
    }
}
