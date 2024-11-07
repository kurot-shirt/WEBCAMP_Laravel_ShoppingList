<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\controllers\AuthController;

class AuthController extends Controller
{
    public function index()
    {
    	return view('index');
    }
}
