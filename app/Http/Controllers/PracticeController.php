<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Practice;
use App\Models\Field;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class PracticeController extends Controller
{
    /**
     * show all practices
     */
    public function index()
    {
        $practices = Practice::paginate(10);
        $items = $practices->getCollection();

        //manipulate the items to add the count of employees & logo url
        foreach($items as $key => $item)
        {
            if($item->logo !== null)
            {
                $items[$key]->logo = asset('storage/'.$item->logo);
            }
            $items[$key]->employees_count = count($item->employees);
        }
        $practices->setCollection($items);

        return Inertia::render(
            'Practice/Index',
            [
                'practices' => $practices
            ]
        );
    }


    /**
     * add new practice
     */
    public function create()
    {
        return Inertia::render(
            'Practice/Create'
        );
    }

    /**
     * save new practice
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:practices',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
        ]);

        $logo = ($request->file('logo') == null) ? null : $request->file('logo')->store('practice', 'public');
        Practice::create([
            'name' => $request->name,
            'email' => $request->email,
            'website_url' => $request->website_url,
            'logo' => $logo,
        ]);

        return redirect()->route('practices.index');
    }

    /**
     * show practice data
     */
    public function show(Practice $practice)
    {
        $fields = Field::orderBy('tag', 'ASC')->get();
        $info = Practice::find($practice->id);
        $employees = $info->employees;
        $practice_fields = $info->fields->map(function($fld){
            return $fld->field_of_practice_id;
        });

        return Inertia::render(
            'Practice/Show',
            [
                'practice' => $info,
                'practice_fields' => $practice_fields,
                'logo' => asset('storage/'.$info->logo),
                'employees' => $employees,
                'fields' => $fields
            ]
        );
    }

    /**
     * edit practice
     */
    public function edit(Practice $practice)
    {
        return Inertia::render(
            'Practice/Edit',
            [
                'practice' => $practice,
                'logo' => ($practice->logo == null) ? null : asset('storage/'.$practice->logo)
            ]
        );
    }

    /**
     * Update the practice
     */
    public function update(Request $request, Practice $practice)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:practices,email,'.$practice->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
        ]);

        $logo = $practice->logo;
        if($request->file('logo')){
            Storage::disk('public')->delete($practice->logo);
            $logo = $request->file('logo')->store('practice', 'public');
        }

        $practice->update([
            'name' => $request->name,
            'email' => $request->email,
            'website_url' => $request->website_url,
            'logo' => $logo,
        ]);

        return redirect()->route('practices.index');

    }

    /**
     * delete practice
     * */
    public function destroy(Practice $practice)
    {
        Storage::disk('public')->delete($practice->logo);
        $practice->delete();

        return redirect()->route('practices.index');
    }

    public function assignField(Request $request, Practice $practice) {
        DB::table('practice_field_of_practice')->insert([
            'practice_id' => $practice->id,
            'field_of_practice_id' => $request->field_id
        ]);

        return redirect()->route('practices.show', ['practice' => $practice->id]);
    }

    public function unassignField(Request $request, Practice $practice) {
        DB::table('practice_field_of_practice')
        ->where('practice_id',  $practice->id)
        ->where('field_of_practice_id',  $request->field_id)
        ->delete();

        return redirect()->route('practices.show', ['practice' => $practice->id]);
    }
}
