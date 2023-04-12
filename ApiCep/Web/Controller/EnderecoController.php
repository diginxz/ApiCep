<?php

namespace ApiCep\Controller;

use App\DAO\EnderecoDAO;
use App\Model\{ EnderecoModel, CidadeModel };
use Exception;
use JetBrains\PhpStorm\ExpectedValues;

class EnderecoController extends Controller 
{
    public static function getCepByLogradouro() : void
    {
        try 
        {
            $logradouro = $_GET["logradouro"]

            $model = new EnderecoModel();
            $model->getCepByLogradouro($logradouro);

            parent::getResponseAsJSON($model->rows);
        }
        catch (Exception $e)
        {
            parent::getExceptionAsJSON($e);
        }
    }

    public static function getLogradouroByBairroAndCidade() : void
    {
        try
        {
            $bairro = parent::getStringFromUrl(isset($_GET['bairro']) ? $_GET['bairro'] : null, 'bairro');

            $id_cidade = parent::getStringFromUrl(isset($_GET['id_cidade']) ? $_GET['id_cidade'] : null, 'cep');

            $model = new EnderecoModel();

            $model->getLogradouroByBairroAndCidade($bairro, $id_cidade);

            parent::getResponseAsJson($model->rows);
        }
        catch(Exception $e)
        {
            parent::getExceptionAsJSON($e);
        }
    }

    public static function getBairrosByIdCidade()
    {
        try
        {
            $id_cidade = parent::getIntFromUrl(isset($_GET['id_cidade']) ? $_GET['id_cidade'] : null);

            $model = new EnderecoModel();
            $model->getBairrosByIdCidade($id_cidade);

            parent::getResponseAsJson($model->rows);

        }
        catch(Exception $e)
        {
            parent::getExceptionAsJSON($e);
        }
    }

    public static function GetCidadesByUF()
    {
        try
        {
            $uf = $_GET['uf'];

            $model = new CidadeModel();
            $model->GetCidadesByUF($uf);

            parent::getResponseAsJSON($model->rows);
        }
        catch(Exception $e)
        {
            parent::getExceptionAsJSON($e);
        }
    }

}