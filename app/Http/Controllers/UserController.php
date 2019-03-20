<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->isMethod('put') ? User::findOrFail
        ($request->user_id) : new User;

        $user->id = $request->input('user_id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($user->save()){
            return new UserResource($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()){
            return new UserResource($user);
        }
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $returningUser = new UserResource(User::findOrFail($user['id']));
            $token = $user->createToken('Bookin')->accessToken;
            return response()->json(['success' => $returningUser, 'token' => $token], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $success = User::create($input);
        $success->roles()->attach(3);

        $returningUser = new UserResource(User::findOrFail($success['id']));

        $token =  $success->createToken('Bookin')->accessToken;
        return response()->json(['success'=>$returningUser, 'token' => $token], $this->successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    /**
     * Change password
     * "$2y$10$PTlzmF.tmcSPgHJWuUo02.3Wv3Yda2O4fjx4HqV6FZ0JDGn8em6qW"
     * "$2y$10$PTlzmF.tmcSPgHJWuUo02.3Wv3Yda2O4fjx4HqV6FZ0JDGn8em6qW"
     *
     * "$2y$10$zcuCtCyvtLEKbUv2pB9eTeKvvUQOSIF/7s4U546vxEhSXNE2G3iFC"
     * "$2y$10$0sjvcubGFXS/wIF2ynFy0Of4OTPsqOgEAGJiNPCYWuBehOQU9P.yC"
     */
    public function changePassword(Request $request){
        $user = User::findOrFail($request['id']);


        if($user->email === request('email')){
            $user->password = bcrypt(request('new_password'));
            $user->save();
            return response()->json(['success' => 'Password Changed'], $this->successStatus);
        } else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
