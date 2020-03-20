<?php


namespace App\Interfaces;


interface ServiceInterface
{
    public function store($request);

    public function update($request, $id);

    public function destroy($id);
}
