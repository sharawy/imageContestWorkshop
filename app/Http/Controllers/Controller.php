<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="localhost",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="This Api for Photocontest App",
 *         description="Provide all the service for the Photocontest app",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="abdalrahman.alsharawy@gmail.com"
 *         )
 *     ),
 *     @SWG\ExternalDocumentation(
 *         description="json docs",
 *         url="/docs"
 *     )
 * )
 */

class Controller extends BaseController
{
    public function generic_response($data,$msg="success",$code=200){
      return response()->json(['result'=>$data,'msg'=>$msg],$code);
    }

    public function error_response($msg="failed",$code=404){
      return response()->json(['msg'=>$msg],$code);
    }
    public function is_staff_or_owner($obj,$user){
        if( $user->is_staff || $obj->user_id == $user->id )
            return true;
        return false;
    }
}
