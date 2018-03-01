<?php
/**
 * Created by PhpStorm.
 * User: kaleb
 * Date: 2/9/18
 * Time: 3:47 PM
 */

namespace fastreading\excel\Model;


class FileCsv extends File
{
	private $_separadores = [',',';',"  "];
    protected function readFile()
    {
         $row = 0;
//        dd($this->getFileDelimiter($this ->_nomeArquivo));
		if (($handle = fopen($this ->_nomeArquivo, "r")) !== FALSE) {
//        dd($handle );
		    while (($data = fgetcsv($handle,',')) !== FALSE) {

		      	$data=  str_replace($this->_separadores, ',', $data);

		      	if(isset($data[0]) and !is_array($data[0]) and count($data) <= 1   ){

		      	    $data = explode(',',$data[0]);
                }
		        $this->file[$row]= str_replace('"','',$data);
		        $row++;
		    }
		    fclose($handle);
		}
    }
}