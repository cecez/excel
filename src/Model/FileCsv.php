<?php
/**
 * Created by PhpStorm.
 * User: kaleb
 * Date: 2/9/18
 * Time: 3:47 PM
 */

namespace fastreading\excel\Model;


use fastreading\excel\Extras\Encoding;

class FileCsv extends File
{
    private $encoding = "";
	private $_separadores = [',',';','\t'];
	private $file2;
    protected function readFile()
    {
	    $row = 0;
        $this->file2 = file_get_contents($this ->_nomeArquivo);
        $this->encoding= mb_detect_encoding( $this->file2,
            ['pass', 'auto', 'UTF-16','UTF-16BE','UTF-16LE','UTF-8','ISO-8859-1'],true
        );

        if($this->encoding != "UTF-8")
            $this->file2 = Encoding::toUTF8($this->file2);

        if(mb_detect_encoding($this->file2,
                ['pass', 'auto', 'UTF-16','UTF-16BE','UTF-16LE','UTF-8','ISO-8859-1'],true
            ) != "UTF-8")
            $this->file2 = utf8_encode($this->file2);


        $data = explode("\n",$this->file2);
        foreach($data as $linha){
            if(empty($linha)) continue;



            $linha= str_replace("\r",'',$linha);

            $linha=  str_replace($this->_separadores, ',', $linha);
            $linha = explode(',',$linha);
            $this->file[$row]= str_replace('"','',$linha);
            $row++;
        }
    }
}

