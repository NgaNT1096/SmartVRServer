<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Package\Content;
use App\SecretOtp;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
class ContentController extends Controller
{
    public function api_download($id){
        $content = Content::find($id);
        $file = public_path()."/" . $content->link ;

        return response()->download($file);
    }
    public function api_content($otp){
        if( SecretOtp::where('code',$otp)->first() !== null){
            
            $contents = Content::all();
            foreach($contents as $content){
                $content->url_download =  URL::to('/') .$content->link;
            }
            return response()->json($contents, 200);
        }else{
            return response()->json("not found data", 404);
        }
}
    public function check(Request $request,$otp){
        //thiet bi truy cap vao link route
        $secret = $request->header('secret'); // string
        if($secret === "123321"){
            //kiem tra otp co ton tai khong
            SecretOtp::checkTimeOut($otp);
            if( SecretOtp::where('code',$otp)->first() !== null){      
                $codeOtp =  SecretOtp::where('code',$otp)->first();
                // tang so num_request len
                $codeOtp->num_request += 1;
                $codeOtp->save();
                
                if( $codeOtp->num_request <= $codeOtp->max_device ){
                    // $this->logout($otp);
                    //2.neu con thi duoc truy cap
                    $contents = Content::all();
                    foreach($contents as $content){
                        $content->url_download =  URL::to('/') .$content->link;
                        $content->devices =  $codeOtp->num_request;
                    }
                    return response()->json($contents, 200);
                }else{
                    //khi so truy cap vuot qua gioi han thi k tra ve du lieu nua
                    return response()->json("The device exceeds the access limit") ;
                }
                
            }else{
                return response()->json("not found data, Login to receive access code", 404);
            }
            
        }else{
            return response()->json("The device is not authorized to access") ;
        }
    }
}
