<?php

namespace App\Services;

class InvoiceResult
{
    protected $path;
    protected $filename;

    public function __construct($path, $filename)
    {
        $this->path = $path;
        $this->filename = $filename;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getFilename()
    {
        return $this->filename;
    }
}
