<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonResourceCollection;
use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    /**
     * @parm Person $parson
     * @return PersonResource
     * 
     */
    public function show(Person $person) : PersonResource
    {
        return  new PersonResource($person);
    }


    /**
     * 
     * @return PersonResourceCollection
     * 
     * 
     */

    public function index() : PersonResourceCollection
    {
        return new PersonResourceCollection(Person::paginate());
    }

    public function store(Request $request)
    {

        // dd($request->all());
        // create that person 
        $data = [];
        $data['first_name'] = $request->input('first_name');
       $data['last_name']  = $request->input('last_name ');
        $data['phone'] = $request->input('phone');
        $data['email'] = $request->input('email');
        $data['city'] = $request->input('city');
        
        $request->validate([

            'first_name' => 'requierd',
            'last_name'  => 'requierd',
            'phone'      => 'requierd',
            'email'      => 'requierd',
            'city'       => 'requierd', 

        ]);

        $person = Person::create($data);

        return new PersonResource($person);
    }


    public function update(Person $person, Request $request): PersonResource
    {
      


        $person->update($request->all());
        return new PersonResource($person);
    }
}
