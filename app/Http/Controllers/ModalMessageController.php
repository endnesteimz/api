<?php

namespace App\Http\Controllers;

use App\Http\Resources\ModalMessageResource;
use App\Models\ModalMessage;
use Illuminate\Http\Request;

class ModalMessageController extends Controller
{
    public function index()
    {
        return ModalMessageResource::collection(ModalMessage::all()->random(1));
    }
}
