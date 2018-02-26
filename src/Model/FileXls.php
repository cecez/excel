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

        if(empty($this->_nomeArquivo))return null;
        $doc = new CompoundDocument ('utf-8');
        try{
            $doc->parse (file_get_contents ($this->_nomeArquivo));

            $wb = new BiffWorkbook($doc);
            $wb->parse();

            foreach ($wb->sheets as $sheetName => $sheet)
            {
                $this->file = $sheet->cells;
                return;
            }
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());

        }

    }
    public function setFilePath($filePath){
        $this->_nomeArquivo = $filePath;
    }
    public function setFile(array $arquivo){
        $this->file = $arquivo;
    }
}