<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $url = "https://www.rid-smartdata.com/api/getdata";
        $data = ["token" => "d6923ea922e073f68010157d"];
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        
        $result = curl_exec($ch);
        echo $result;exit;
        
        // $url = "https://www.rid-smartdata.com/api/getdata";
        // $data = ["token" => "d6923ea922e073f68010157d"];

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $result = curl_exec($ch);
        // // echo $result;
        // return view('home',$result);
        // // return  $this->response->setJSON($result);
    }
}
