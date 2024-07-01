<?php

namespace App\Application\Command;

class ListBooksCommand
{
    private $parameter;

    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    public function getParameter()
    {
        return $this->parameter;
    }
}
