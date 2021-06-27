<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BaseController extends Controller
{
    protected function respondWithSuccess($message = 'Done!', $code = 200)
    {
        return Response::json([
            'success' => true,
            'message' => $message,
            'code' => $code
        ], $code);
    }

    protected function respondWithError($message = 'Failed!', $code = 500)
    {
        return Response::json([
            'success' => false,
            'message' => $message,
            'code' => $code
        ]/*, $code*/);
    }

    protected function respondWithData($data = [], $message = 'Done!', $code = 200)
    {
        return Response::json([
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function sweetAlert($type = 'Message', $text = null, $title = 'Alert')
    {
        switch ($type) {
            case 'message':
                alert()->message($text, $title)->persistent('Close')->autoclose(3000);
                break;
            case 'basic':
                alert()->basic($text, $title)->persistent('Close')->autoclose(3000);
                break;
            case 'info':
                alert()->info($text, $title)->persistent('Close')->autoclose(3000);
                break;
            case 'success':
                alert()->success($text, $title)->persistent('Close')->autoclose(3000);
                break;
            case 'error':
                alert()->error($text, $title)->persistent('Close');
                break;
            case 'warning':
                alert()->warning($text, $title)->persistent('Close');
                break;
            default:
                break;
        }
    }
}
