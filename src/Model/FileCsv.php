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
	private $_separadores = [',',';','\t'];
    protected function readFile()
    {
        $this ->_nomeArquivo;
        $row = 0;
		if (($handle = fopen($this ->_nomeArquivo, "r")) !== FALSE) {

		    while (($data = fgetcsv($handle, ",")) !== FALSE) {
		        
		      	$data=  str_replace($this->_separadores, ',', $data);
		        $this->file[$row]= $data;
		        $row++;
		    }
		   
		    fclose($handle);
		}
    }
}