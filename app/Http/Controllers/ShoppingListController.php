<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function list()
    {
    	return view('shopping_list.list');
    }
   
}
