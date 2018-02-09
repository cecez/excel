<?php
/**
 * Created by PhpStorm.
 * User: kaleb
 * Date: 2/8/18
 * Time: 3:11 PM
 */

namespace fastreading\excel\Model;

use fastreading\excel\Extras\CompoundDocument;
use fastreading\excel\Extras\BiffWorkbook;
class FileXls extends File
{
    protected function readFile(){
        if(!empty($this->file)) return $this->file;

        $doc = new CompoundDocument ('utf-8');
        $doc->parse (file_get_contents ($this->_nomeArquivo));
        $wb = new BiffWorkbook($doc);
        $wb->parse ();

        foreach ($wb->sheets as $sheetName => $sheet)
        {
          $this->file = $sheet->cells;
            return;
        }
    }
}