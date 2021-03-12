<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Resources\ModalMessageResource;
use App\Models\ModalMessage;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class ModalMessageController extends Controller
{
    public function index()
    {
        $message = ModalMessage::all()->random(1);
        return ResponseFormatter::success(
            $message
        );
    }
}
