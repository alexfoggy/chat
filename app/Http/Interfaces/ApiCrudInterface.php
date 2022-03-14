<?php


namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface ApiCrudInterface
{
    public function getItems();

    public function getItem($token);

    public function updateItem(Request $request, $token = null);

    public function deleteItem($token);
}
