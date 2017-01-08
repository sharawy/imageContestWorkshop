<?php namespace App\Http\Controllers;
use App\Item;
use App\Vote;
use App\User;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\Jobs\EmailJob;

class ItemController extends Controller
{

  public function __construct(){
      $this->middleware('token',['except' => ['index','adminitems','show','search','votes']]);
      $this->middleware('admin',['only' => ['adminitems','approve','disapprove']]);

  }
  /**
  * Approve an item.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Post(
  *    tags={"items"},
  *     path="/items/approve",
  *     description="Approve an item.",
  *     operationId="approve",
  *     produces={"application/json"},
  *     @SWG\Parameter(
  *         name="Token",
  *         in="header",
  *         description="Admin token",
  *         required=true,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="item_id",
  *         in="formData",
  *         description="",
  *         required=true,
  *         type="integer"
  *     ),
  *     @SWG\Response(
  *         response=200,
  *         description="items List."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
  public function approve(Request $request){
    $item=Item::find($request->get('item_id'));
    if($item){
      $item->approve=True;
      $item->save();
      return $this->generic_response($item);
    }

    return $this->error_response("item not found");
  }
  /**
  * Disapprove an item.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Post(
  *    tags={"items"},
  *     path="/items/disapprove",
  *     description="disapprove an item.",
  *     operationId="disapprove",
  *     produces={"application/json"},
  *     @SWG\Parameter(
  *         name="Token",
  *         in="header",
  *         description="Admin token",
  *         required=true,
  *         type="string"
  *     ),
  *     @SWG\Parameter(
  *         name="item_id",
  *         in="formData",
  *         description="",
  *         required=true,
  *         type="integer"
  *     ),
  *     @SWG\Response(
  *         response=200,
  *         description="item."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
  public function disapprove(Request $request){
    $item=Item::find($request->get('item_id'));
    if($item){
      $item->approve=false;
      $item->save();
      return $this->generic_response($item);
    }
    return $this->error_response("item not found");
  }
  /**
  * Display a listing of logged in user items.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Get(
  *    tags={"users"},
  *     path="/user/items",
  *     description="Returns List of user's items.",
  *     operationId="user_items",
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
  *         description="items List."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
  public function user_items(Request $request){
    $items=Item::where("user_id",$request->user->id)->paginate(10);
    return $this->generic_response($items);
  }
       /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\JsonResponse
       *
       * @SWG\Get(
       *    tags={"items"},
       *     path="/items",
       *     description="Returns List of items.",
       *     operationId="index",
       *     produces={"application/json"},
       *     @SWG\Response(
       *         response=200,
       *         description="items List."
       *     ),
       *     @SWG\Response(
       *         response=401,
       *         description="Unauthorized action.",
       *     )
       * )
       */
public function index(Request $request){

    $items=Item::where("approve",1)->orWhere("approve",null)
    ->orderBy('created_at', 'desc')->paginate(10);
    if(count($items)>0){
    for ($i=0;$i<10;$i++){
    //    return Response(var_dump($items[$i]->id));
      $items[$i]->likes=$items[$i]->votes()->where("value",1 )->count();
    }
  }
    return $this->generic_response($items);
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Get(
  *    tags={"votes"},
  *     path="/votes",
  *     description="Returns List of votes.",
  *     operationId="votes",
  *     produces={"application/json"},
  *     @SWG\Response(
  *         response=200,
  *         description="votes List."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
public function votes(Request $request){

//$votes=Vote::with('user')->groupBy("user_id")->paginate(10);
$votes =DB::table('votes')
  ->selectRaw('item_id, COUNT(*) as count')->where('value',1)
  ->groupBy('item_id')
  ->orderBy('count', 'desc')
  ->paginate(10);
  for($i=0;$i<count($votes);$i++) {
    //return Response(var_dump($votes[$i]->item_id));
    $item=Item::find($votes[$i]->item_id);
    $votes[$i]->user=User::find($item->user_id);
    $votes[$i]->item = $item;
  }

return $this->generic_response($votes);
}
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Get(
  *    tags={"admin"},
  *     path="/admin/items",
  *     description="Returns List of items for admin pannel.",
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
  *         description="items List."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
public function adminitems(Request $request){

$items=Item::orderBy('created_at', 'desc')->paginate(10);
if(count($items)>0){
for ($i=0;$i<10;$i++){
 $items[$i]->likes=$items[$i]->votes()->where("value",true )->count();
 $items[$i]->dislikes=$items[$i]->votes()->where("value",false )->count();
}
}
return $this->generic_response($items);
}
        /**
       * Creating item.
       *
       * @return \Illuminate\Http\JsonResponse
       *
       * @SWG\Post(
       *    tags={"items"},
       *     path="/items",
       *     description="create item.",
       *     operationId="store",
       *     produces={"application/json"},
       *     @SWG\Parameter(
       *         name="Token",
       *         in="header",
       *         description="",
       *         required=true,
       *         type="string"
       *     ),
       *     @SWG\Parameter(
       *         name="name",
       *         in="formData",
       *         required=true,
       *         type="string",
       *     ),
       *     @SWG\Parameter(
       *         name="description",
       *         in="formData",
       *         required=true,
       *         type="string",
       *     ),
       *     @SWG\Parameter(
       *         name="price",
       *         in="formData",
       *         required=true,
       *         type="integer",
       *     ),
       *     @SWG\Parameter(
       *         name="available_stock",
       *         in="formData",
       *         required=true,
       *         type="integer",
       *     ),
       *     @SWG\Parameter(
       *         name="image_url",
       *         in="formData",
       *         required=true,
       *         description="Base64 String",
       *         type="string",
       *     ),
       *     @SWG\Parameter(
       *         name="category_id",
       *         in="formData",
       *         required=false,
       *         type="integer",
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
       function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen(base_path()."/images/".$output_file, "wb");

    $data = explode(',', $base64_string);
    //return response($data);
    fwrite($ifp, base64_decode($data[1]));
    fclose($ifp);

    return $output_file;
}
public function store(Request $request){
    $this->validate_request($request);
    $data=$request->all();
    $form_file=$request->get("image_url");
    $data['image_url']=url()."/images/".$this->base64_to_jpeg($form_file,str_replace("-","",Uuid::uuid4()).".jpeg");
    $data['user_id'] = $request->user->id;
    $item = Item::create($data);
    $item->likes=$item->votes()->where("value",true )->count();
    $item->dislikes=$item->votes()->where("value",false )->count();
  return $this->generic_response($item,"created",201);
  }
  /**
  * Display a item.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Get(
  *    tags={"items"},
  *     path="/items/{item}",
  *     description="Returns item.",
  *     operationId="show",
  *     produces={"application/json"},
  *     @SWG\Parameter(
  *         description="ID of item",
  *         format="int64",
  *         in="path",
  *         name="item",
  *         required=true,
  *         type="integer"
  *     ),
  *     @SWG\Response(
  *         response=200,
  *         description="item object."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
public function show(Request $request,$id){
    $item = Item::find($id);
    if ($item){
      $item->votes=$item->votes();
      return $this->generic_response($item);
    }
    return $this->error_response("this item id doesn't exist");
  }
  /**
  * like  item.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Post(
  *    tags={"items"},
  *     path="/items/vote",
  *     description="Returns total likes.",
  *     operationId="like",
  *     produces={"application/json"},
  *     @SWG\Parameter(
  *         description="ID of item",
  *         format="int64",
  *         in="formData",
  *         name="item_id",
  *         required=true,
  *         type="integer"
  *     ),
  *     @SWG\Parameter(
  *         name="value",
  *         in="formData",
  *         description="user's vote",
  *         required=true,
  *         type="boolean"
  *     ),
  *     @SWG\Parameter(
  *         name="Token",
  *         in="header",
  *         description="user's token",
  *         required=true,
  *         type="string"
  *     ),
  *     @SWG\Response(
  *         response=200,
  *         description="total likes."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
public function vote(Request $request){
    $item = Item::find($request->get('item_id'));
    $item_id=$item->id;
    $user_id=$request->get('user_id');
    $value=$request->get('value');

    if ($item){
      $vote=Vote::where("user_id",$user_id)
      ->where("item_id",$item_id)->first();
      if ($vote){
        return $this->generic_response("","Already voted");
      }

      $vote=Vote::create($request->all());

      $result["total"]=Vote::where("item_id",$item->id)->where("value",$request->get("value"))
      ->count();
      return $this->generic_response($result);
    }
    return $this->error_response("this item id doesn't exist");
  }
  /**
 * Editing item.
 *
 * @return \Illuminate\Http\JsonResponse
 *
 * @SWG\Put(
 *    tags={"items"},
 *     path="/items/{item}",
 *     description="create item.",
 *     operationId="update",
 *     produces={"application/json"},
 *     @SWG\Parameter(
 *         name="Token",
 *         in="header",
 *         description="",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Parameter(
 *         description="ID of item",
 *         format="int64",
 *         in="path",
 *         name="item",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="name",
 *         in="formData",
 *         required=false,
 *         type="string",
 *     ),
 *     @SWG\Parameter(
 *         name="description",
 *         in="formData",
 *         required=false,
 *         type="string",
 *     ),
 *     @SWG\Parameter(
 *         name="price",
 *         in="formData",
 *         required=false,
 *         type="integer",
 *     ),
 *     @SWG\Parameter(
 *         name="available_stock",
 *         in="formData",
 *         required=false,
 *         type="integer",
 *     ),
 *     @SWG\Parameter(
 *         name="image_url",
 *         in="formData",
 *         required=false,
 *         description="Base64 string",
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
public function update(Request $request,$id){
    $item = Item::find($id);
    if ($item){
      if ($this->is_staff_or_owner($item, $request->user))
      {
      $this->validate_update_request($request);
      $item->name            = $request->get("name",$item->name);
      $item->description     = $request->get("description",$item->description);
      $item->price           = $request->get("price",$item->description);
      $item->available_stock = $request->get("available_stock",$item->description);
      $image_url       = $request->get("image_url",$item->image_url);
      //return response(var_dump(filter_var($request->get("image_url"), FILTER_VALIDATE_URL)));
      if (filter_var($image_url, FILTER_VALIDATE_URL) === false ) {

        $item->image_url=url()."/images/".$this->base64_to_jpeg(
        $request->get("image_url"),str_replace("-","",Uuid::uuid4()).".jpeg");
      }
      $item->save();
      return $this->generic_response($item,"updated");
    }else {
      return $this->error_response("Unauthorized",401);
    }
    }
     return $this->error_response("this item id doesn't exist");
  }
  /**
  * Delete a item.
  *
  * @return \Illuminate\Http\JsonResponse
  *
  * @SWG\Delete(
  *    tags={"items"},
  *     path="/items/{item}",
  *     description="Delete item.",
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
  *         description="ID of item",
  *         format="int64",
  *         in="path",
  *         name="item",
  *         required=true,
  *         type="integer"
  *     ),
  *     @SWG\Response(
  *         response=200,
  *         description="item object."
  *     ),
  *     @SWG\Response(
  *         response=401,
  *         description="Unauthorized action.",
  *     )
  * )
  */
public function destroy(Request $request,$id){
  $item = Item::find($id);
  if ($item){
    if ($this->is_staff_or_owner($item, $request->user))
    {
    $item->delete();
    return $this->generic_response("","deleted");
  }
  else{
    return $this->error_response("Unauthorized",401);
  }
  }
  return $this->error_response("this item id doesn't exist");
  }


function validate_request($request){
    $rules=[
      "name" => "required|min:3|max:32",
      "description" => "required|min:3",
      "image_url" => "required|string",
    ];
    $this->validate($request,$rules);
  }
  function validate_update_request($request){
      $rules=[
        "name" => "string|min:3|max:32",
        "description" => "string|min:3",

      ];
      $this->validate($request,$rules);
    }
  function upload_file($file){
    $form_file=$file;

    $file_extenstion=$form_file->getClientOriginalExtension();
    $file_name=uniqid( $form_file->getClientOriginalName()).".".$file_extenstion;
    $form_file->move(base_path()."/images",$file_name) ;
    return url()."/images/".$file_name;
  }

}
