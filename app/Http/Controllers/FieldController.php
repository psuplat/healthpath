<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Practice;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FieldController extends Controller
{
    /**
     * show all practices
     */
    public function index()
    {
        $fields = Field::orderBy('tag', 'ASC')->get();

        $fields = Field::orderBy('tag', 'ASC')->get()->map(function($field){
            return [
                'id' => $field->id,
                'tag' => $field->tag,
                'practice_count' => count($field->practices)
            ];
        });

        return Inertia::render(
            'Field/Index',
            [
                'fields' => $fields
            ]
        );
    }

    /**
     * save new practice
     */
    public function store(Request $request)
    {
        Field::create([
            'tag' => strtolower($request->tag),
        ]);
        return redirect()->route('fields.index');
    }

    /**
     * remove the tag but only if it is not assigned to any practice 
     */
    public function destroy(Field $field)
    {
        $field->delete();

        return redirect()->route('fields.index');
    }
}
