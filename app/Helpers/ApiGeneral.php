<?php


function apiResponse($msg,$status,$data=null)
    {
        $response = 
        [
            'msg'       => $msg,
            'status'    => $status,
            'data'      => $data,
            
        ];

        return \response()->json($response);
    }