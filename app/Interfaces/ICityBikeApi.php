<?php
namespace App\Interfaces;

interface ICityBikeApi
{
    public function getFile(string $apiUrl): array;
}