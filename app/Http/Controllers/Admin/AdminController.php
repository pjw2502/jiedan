<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use phpDocumentor\Reflection\Location;

class AdminController extends Controller
{
    //
    protected function curl($url,$data,$cookie,$method,$header){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_SSL_VERIFYHOST=>false
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
    function index(){
        return view('Admin/admin');
    }
    function cook(){
        return view('Admin/success');
    }
    function dianfu(Request $request){
        $res = $request->all();
        $cookie = $res['cookie'];
        $header = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Postman-Token: 9836dd22-55b3-49d2-bfe0-62a788b0b57f",
            "cache-control: no-cache",
            "Host:www.tbquan88.com",
            "Referer: http://www.tbquan88.com/1/main",
            "X-Requested-With:XMLHttpRequest",
            "Cookie:".$cookie
        );
        $url = "http://www.tbquan88.com/1/task/claim_task?task_type=DIANFU";
        $data = '';
        $res = $this->curl($url,$data,$cookie,$method="GET",$header);
        return $res;
//        return view('Admin/success',[
//            'res'=>$res
//        ]);
    }
    function login(){
        $res = json_encode(array('0'=>'成功','msg'=>'成功'));
        return $res;
    }
    protected function tj(Request $request){
        $res = $request->all();
        $task_id = $res['id'];
        $nick_id = $res['nick_id'];
        $tast_info = $res['task_info'];
        $cookie = $res['cookie'];
        $fill = $res['fill'];
            $url = "http://www.tbquan88.com/1/task/accept";
            $data = "task_type=DIANFU&task_id=".$task_id."&nick_id=".$nick_id."&task_info=".json_encode($tast_info);
        $header = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Cookie: ".$cookie,
            "Host: www.tbquan88.com",
            "Origin: http://www.tbquan88.com",
            "Postman-Token: 0c3997f7-f276-4053-a712-cb509975e4e8",
            "Referer: http://www.tbquan88.com/1/main",
            "X-Requested-With: XMLHttpRequest",
            "cache-control: no-cache"
        );
        $erro = array(
            [
            'code'=>1001,
            'msg'=>"没接到一单"
            ],
            [
                'code'=>1002,
                'msg'=>'接单已经超过一单'
            ]
        );
            return $this->curl($url, $data, $cookie, $method = "POST", $header);

    }
}
