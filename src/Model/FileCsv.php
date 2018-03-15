<?php
/**
 * Created by PhpStorm.
 * User: kaleb
 * Date: 2/9/18
 * Time: 3:47 PM
 */

namespace fastreading\excel\Model;

use \ForceUTF8\Encoding;
class FileCsv extends File
{
        private $encoding = "";
	private $_separadores = [',',';',"  "];
	private $file2;
    protected function readFile()
    {
	$row = 0;
        $this->file2 = file_get_contents($this ->_nomeArquivo);
        if(mb_detect_encoding( $this->file2) != "UTF-8"){
            $this->file2 = Encoding::toUTF8($this->file2);
        }

        $data = explode("\n",$this->file2);
        foreach($data as $linha){
            if(empty($linha)) continue;

            $linha=  str_replace($this->_separadores, ',', $linha);
            $linha = explode(',',$linha);
            $this->file[$row]= str_replace('"','',$linha);
            $row++;
        }
    }
}
