<?php

namespace App\Http\Controllers;
use App\RegUser;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Blog;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller
{
    /**
   * Display all registered user
   */
    public function index(){
      return RegUser::orderBy('id', 'asc')->get();
    }
    /**
   * Delete the selected user
   * @param  Request  $request
   */
    public function deleteItem(Request $request)
    {
      $user = RegUser::find($request->input('id'));
      $user->delete();
    }

    /**
   * Update the selected user
   *
   * @param  Request  $request
   * @return Response JSON
   */
    public function updateItem(Request $request) {

        $user = RegUser::find($request->input('id'));
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->age =$request->input('age');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->username = $request->input('username');
        $user->save();

        return Response::json($user);
    }
    /**
   * Add user
   *
   * @param  Request  $request
   * @return Response JSON
   */
    public function addItem(Request $request) {

      $user = new RegUser();
      $user->firstname = $request->input('firstname');
      $user->lastname = $request->input('lastname');
      $user->age =$request->input('age');
      $user->email = $request->input('email');
      $user->password = $request->input('password');
      $user->username = $request->input('username');
      $user->save();

      return Response::json($user);
    }

   }
