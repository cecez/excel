<?php

namespace fastreading\excel\Model;

abstract class File
{
    protected $_arquivo;

    public static $FILE_CLEAN = 130;
    public static $TIPO_NAO_SUPORTADO = 131;
    /*
     * @var FileXls|FileXlsx file que carrega arquivo
     */

    protected $file;

    /**
     * @var array Colunas encontradas no arquivo.
     */
    protected $_colunas;


    /**
     * @var string Enconding/codificação do arquivo.
     */
    protected $_encoding;


    /**
     * @var string Nome do arquivo a ser carregado.
     */
    protected $_nomeArquivo;


    public function getColls(){
        if(empty($this->_colunas))
            foreach ($this->file as $colunas) {
                foreach ($colunas as $coluna){
                    $this->_colunas[] = $coluna;
                }
                return ($this->_colunas);
            }

        else return ($this->_colunas);
    }

    protected abstract function readFile();


    public function getFile($withHeader= false){
        $arquivo = $this->file;

        if(!$withHeader)
        array_splice($arquivo,0,1);

        return ($arquivo);
    }
    protected function retException($array =  null){
        $array = ($array==null ?  $this->file : $array);
        if(!is_array($array))
            throw new \Exception("Tipo de arquivo nao suportado",self::TIPO_NAO_SUPORTADO);

        if(empty($array))
            throw new \Exception("arquivo em branco",self::FILE_CLEAN);

    }
    public function getHeader(){
        if(is_array($this->file) && !empty($this->file)){
            return $this->file[0];
        }
        try {
            $this->retException();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(),$e->getCode());
        }
    }

    public function __construct($pathFile)
    {
        $this->_nomeArquivo = $pathFile;//Nome do arquivo.
        if(empty($this->_nomeArquivo) || empty(file_get_contents ($this->_nomeArquivo))) throw new \Exception("Arquivo nao foi setado");

        $this->readFile();
    }

}
