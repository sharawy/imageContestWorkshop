<?php namespace App\Http\Controllers;
use DateTime;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\User;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Jobs\EmailJob;
use DB;
/**
 * Class ProductController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
  public function __construct(){
      $this->middleware('token',['only' => ['update','destroy']]);
      $this->middleware('admin',['only' => ['index','show']]);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Get(
  *    tags={"users"},
  *     path="/users",
  *     description="Returns List of users.",
  *     operationId="index",
  *     produces={"application/json"},
  *     @SWG\Parameter(
  *         name="Token",
  *         in="header",
  *         description="",
  *         required=true,
  *         type="string"
  *     ),
  *     @SWG\Response(
  *         response=200,
  *         description="Users List."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */


  public function index(Request $request){

    $users=User::paginate(10);

    return $this->generic_response($users);
  }
  /**
 * Register User.
 *
 * @return \Illuminate\Http\JsonResponse
 *
 * @SWG\Post(
 *    tags={"users"},
 *     path="/users/register",
 *     description="Registeration.",
 *     operationId="store",
 *     produces={"application/json"},
 *     @SWG\Parameter(
 *         name="full_name",
 *         in="formData",
 *         required=true,
 *         type="string",
 *     ),

 *     @SWG\Parameter(
 *         name="email",
 *         in="formData",
 *         required=true,
 *         type="string",
 *     ),
 *     @SWG\Parameter(
 *         name="mobile_number",
 *         in="formData",
 *         required=true,
 *         type="number",
 *     ),
 *     @SWG\Parameter(
 *         name="password",
 *         in="formData",
 *         required=true,
 *         type="string",
 *     ),
 *     @SWG\Parameter(
 *         name="password_confirmation",
 *         in="formData",
 *         required=true,
 *         type="string",
 *     ),
 *     @SWG\Response(
 *         response=201,
 *         description="created."
 *     ),
 *     @SWG\Response(
 *         response=401,
 *         description="Unauthorized action.",
 *     )
 * )
 */
  public function store(Request $request){

      $this->validate_request($request);
      $data=$request->all();
      $data['token']=Uuid::uuid4();

      //$data['is_staff']=1;
      $data['password'] = password_hash($request->get('password'), PASSWORD_DEFAULT);
      $user = User::create($data);

    return $this->generic_response(["token"=>$user->token,"user_id"=>$user->id],"created",201);
  }
  /**
  * Display User.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Post(
  *    tags={"users"},
  *     path="/users/{user}",
  *     description="get user .",
  *     operationId="show",
  *     produces={"application/json"},
  *     @SWG\Parameter(
  *         name="Token",
  *         in="header",
  *         required=true,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="user",
  *         in="path",
  *         required=true,
  *         type="integer"
  *     ),
  *     @SWG\Response(
  *         response=201,
  *         description="created."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
public function show(Request $request,$id){
    $user = User::find($id);
    if ($user){
      return $this->generic_response($user);
    }
    return $this->error_response("this user id doesn't exist");
  }
  /**
  * Login.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Post(
  *    tags={"users"},
  *     path="/users/login",
  *     description="login.",
  *     operationId="login",
  *     produces={"application/json"},
  *     @SWG\Parameter(
  *         name="email",
  *         in="formData",
  *         required=true,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="password",
  *         in="formData",
  *         required=true,
  *         type="string"
  *     ),
  *     @SWG\Response(
  *         response=201,
  *         description="created."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
  public function login(Request $request){
    $this->validate_login($request);
    $user = User::where('email', $request->get('email'))->first();
    if ($user){
      if(! password_verify($request->get("password"), $user->password))
          return $this->error_response("invalid password");

      $user->save();
      return $this->generic_response($user);
    }
    return $this->error_response("invalid email");
  }

  /**
  * Register User.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Put(
  *    tags={"users"},
  *     path="/users/{user}",
  *     description="Registeration.",
  *     operationId="store",
  *     produces={"application/json"},
  *     @SWG\Parameter(
  *         name="Token",
  *         in="header",
  *         required=true,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="user",
  *         in="path",
  *         required=True,
  *         type="integer"
  *     ),
  *     @SWG\Parameter(
  *         name="full_name",
  *         in="formData",
  *         required=false,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="user_name",
  *         in="formData",
  *         required=false,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="mobile_number",
  *         in="formData",
  *         required=false,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="shipping_address1",
  *         in="formData",
  *         required=false,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="shipping_address2",
  *         in="formData",
  *         required=false,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="shipping_country",
  *         in="formData",
  *         required=false,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="shipping_city",
  *         in="formData",
  *         required=false,
  *         type="string"
  *     ),
  *     @SWG\Response(
  *         response=201,
  *         description="created."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
  public function update(Request $request,$id){
    $user = User::find($id);
    if ($user){
      //return response(var_dump($user->token).var_dump($request->user->token).var_dump($request->user->is_staff));
      if ($user->token != $request->user->token and !$request->user->is_staff)
      {
        return $this->error_response("Unauthorized",401);
      }
      $this->validate_update_request($request);
      $user->full_name            = $request->get("full_name",$user->full_name);
      $user->email     = $request->get("email",$user->email);
      $user->mobile_number           = $request->get("mobile_number",$user->mobile_number);

      if ($request->user->is_staff){
        $user->is_staff           = $request->get("is_staff");

      }
      $user->save();
      return $this->generic_response($user,"updated");
    }
     return $this->error_response("this user id doesn't exist");
  }
  /**
  * Delete a User.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Get(
  *    tags={"users"},
  *     path="/users/{user}",
  *     description="Delete a user.",
  *     operationId="destroy",
  *     produces={"application/json"},
  *     @SWG\Parameter(
  *         name="Token",
  *         in="header",
  *         description="",
  *         required=true,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="user",
  *         in="path",
  *         description="id of the user",
  *         required=true,
  *         type="integer"
  *     ),
  *     @SWG\Response(
  *         response=200,
  *         description="Users List."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
  public function destroy($id){
    $user = user::find($id);
    if ($user){
      $user->delete();
      return $this->generic_response("","deleted");
    }
    return $this->error_response("this user id doesn't exist");
  }

  function validate_request($request){
      $rules=[
        "full_name" => "required|min:3|max:32",
        "email" => "required|email|unique:users",
        "mobile_number" => "required|numeric|unique:users|min:10",

        "password"=> "required|alpha_dash|confirmed|min:6|max:32",
        "password_confirmation" => "required|min:6|max:32",
        "is_staff" => "boolean",
        //"status_id" => "required|numeric"
      ];
      $this->validate($request,$rules);
    }
    function validate_update_request($request){
        $rules=[
          "full_name" => "string|min:3|max:32",
          "is_staff" => "boolean",
          "email" => "email|unique:users",
          "mobile_number" => "numeric|min:10",

        ];
        $this->validate($request,$rules);
      }
    function validate_login($request){
        $rules=[
          "email" => "required|email",
            "password"=> "required|alpha_dash"
        ];
        $this->validate($request,$rules);
      }



}
