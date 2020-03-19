<?php


namespace App\Interfaces;


interface RepositoryInterface
{
    public function store($obj);

    public function update($obj);

    public function destroy($obj);
}
