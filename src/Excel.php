<?php
/**
 * Created by PhpStorm.
 * User: kaleb
 * Date: 2/9/18
 * Time: 3:42 PM
 */

namespace fastreading\excel;


use fastreading\excel\Extras\SpreadsheetReader;
use fastreading\excel\Model\FileXls;
use fastreading\excel\Model\FileXlsx;
use fastreading\excel\Model\FileCsv;

class Excel
{
    public static function load($pathFile){
        $extensaoArquivo = explode('.', strtolower($pathFile));
        $extensaoArquivo = end($extensaoArquivo);
        $arquivo= null;

        try{
            switch ($extensaoArquivo){
                case  in_array($extensaoArquivo, ['xlsx']):
                    $arquivo  =new  FileXlsx($pathFile);

                    break;
                case in_array($extensaoArquivo, ['xls']):
                    $arquivo  =new  FileXls();
                    $reader = new SpreadsheetReader($pathFile);
                    $arr=[];
                    foreach($reader as $r){
                        $row = [];
                        foreach($r as $a){
                            $row[]=preg_replace('/[\x00-\x1F\x7F]/', '', utf8_encode($a));
                        }
                        $arr[]=$row;
                    }
                    $arquivo->setFile($arr);
                    $arquivo->setFilePath($pathFile);

                    break;
                case in_array($extensaoArquivo, ['csv']):
                    $arquivo= new FileCsv($pathFile);
                    break;
                default:
                    throw new \Exception('arquivo nao suportado ',500);
                    break;
            }
        }catch (\Exception $e){

            throw new \Exception($e->getMessage(),$e->getCode());
        }


        return $arquivo;
    }
}