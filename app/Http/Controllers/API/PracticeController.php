<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Practice;
use App\Models\Field;
use Validator;
use App\Http\Resources\ProductResource;

class PracticeController extends BaseController
{
    /**
     * show all practices
     */
    public function index()
    {
        $practices = Practice::all();
        $fields = Field::all();

        $data = [];

        foreach($practices as $practice)
        {
            //grab assigned fields of practice
            $fields = $practice->fields;
            $assigned_fields = [];
            foreach($fields as $field)
            {
                $assigned_fields[] = Field::find($field->field_of_practice_id);
            }
            $data[] = [
                'id' => $practice->id,
                'name' => $practice->name,
                'email' => $practice->email,
                'website_url' => $practice->website_url,
                'logo' => asset('storage/'.$practice->logo),
                'employees' => $practice->employees,
                'practice_fields' => $assigned_fields,
            ];
        }
        
        return $this->sendResponse($data);
    }
}
