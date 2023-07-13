<?php
namespace App;

use App\Interfaces\IFile;
use App\Files\Csv;
use App\Files\Xml;
use Exception;

class FileFactory
{
    /**
     * @throws Exception
     */
    public static function getFileParser(string $type): IFile
    {
        return match ($type) {
            "csv" => new Csv(),
            "xml" => new Xml(),
            default => throw new Exception("Unknown Type"),
        };
    }
}