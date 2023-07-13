<?php
namespace App\Interfaces;

interface IFile
{
    public function parseFile(string $path): array;
}