<?php
namespace fastreading\excel\Model;
use fastreading\excel\Extras\SimpleXLSX;


/**
 * Created by PhpStorm.
 * User: willian
 * Date: 31/01/18
 * Time: 18:05
 */

class FileXlsx extends File
{
    protected  function readFile()
    {
        if(empty($this->file))
            $this->file = SimpleXLSX::parse($this->_nomeArquivo);

        return $this->file;

    }
}