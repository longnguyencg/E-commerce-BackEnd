<?php


namespace App\Interfaces;


interface ControllerInterface
{
    public function index();

    public function add($request);

    public function update($request, $id=null);

    public function destroy($id);
}
