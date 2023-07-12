<?php

interface IFile
{
    public function parseFile(string $path): array;
}