<?php

class Csv implements IFile
{
    public function parseFile(string $path): array
    {
        if (!file_exists($path)) {
            throw new RuntimeException("File not found: " . $path);
        }

        $bikers = [];

        $file = new SplFileObject($path);
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD);
        $file->seek(0);

        $chunkSize = 4096;
        $buffer = '';

        try {
            while (!$file->eof()) {
                $buffer .= $file->fread($chunkSize);

                $lines = explode("\n", $buffer);

                foreach ($lines as $iValue) {
                    $line = trim($iValue);

                    if (!empty($line)) {
                        $biker_info = str_getcsv($line);
                        $biker_info = array_map('trim', $biker_info);

                        if ($biker_info) {
                            $bikers[] = [
                                "count" => $biker_info[0],
                                "latitude" => $biker_info[1],
                                "longitude" => $biker_info[2],
                            ];
                        }
                    }
                }

                $buffer = $lines[count($lines) - 1];
            }
        } finally {
            $file = null;
        }

        return $bikers;
    }
}

