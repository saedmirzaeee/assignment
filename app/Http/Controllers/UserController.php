<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    static $validationArray = [
        'name' => 'required',
        'age' => 'integer',
        'points' => 'integer|gt:-1',
        'address' => 'string'
    ];

    static $validationMessages = [
        'name'  => 'name is required',
        'age'   => 'age should be a number',
        'points' => 'points should be a number',
        'address'   => 'address should be string'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['data' => User::all()->sortByDesc('points')->values(), 'error' => ''];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),
            self::$validationArray,
            self::$validationMessages
        );

        if ($validator->fails()) {
            return response(['data' => '', 'error' => $validator->messages()], 422);
        }

        $user = User::create($request->all());

        return ['data' => $user->refresh(), 'error' => ''];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {
        //
        $user = User::where('id', $id)->first();

        if($user){
            return [
                'data' => $user,
                'error' => ''
            ];
        }else{
            return response()->json(['error' => 'resource not found' , 'data' => ''],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if(!$user){
            return response()->json(['error' => 'resource not found' , 'data' => ''],404);
        }

        $validator = Validator::make($request->all(),
            self::$validationArray,
            self::$validationMessages
        );

        if ($validator->fails()) {
            return response(['data' => '', 'error' => $validator->messages()], 422);
        }

        if($request->get('points') !== null && !($user->points - 1 <= $request->get('points')
            && $request->get('points')  <= $user->points + 1)){
            return response()->json(['error' => 'you can either increase or decrease user point by 1' , 'data' => ''],404);
        }

        $user->update($request->all());

        return ['data' => $user->refresh(), 'error' => ''];    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::where('id', $id)->first();

        if($user){
            User::destroy($id);
            return ['data' => 'resource deleted successfully', 'error' => ''];
        } else{
            return response()->json(['error' => 'resource not found' , 'data' => ''],404);
        }
    }
}
