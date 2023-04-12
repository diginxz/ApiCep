<?php

namespace App\DAO;

use App\DAO\EnderecoModel;

class EnderecoDAO extends DAO
{
    public function __construct()
{
        parent::__construct();
}

    public function selectByCep(int $cep)
{
    $sql = "SELECT * FROM logradouro WHERE cep = ?";
    $stmt = $this->conexao->prepare($sql);
    $stmt->bindValue(1, $cep);
    $stmt->execute();

    $endereco_obj = $stmt->fetchObject("App\Model\EnderecoModel");

    $endereco_obj->arr_cidades = $this->selectCidadesByUf($endereco_obj->UF);

    return $endereco_obj;
    
}
    public function selectLogradouroByBairroAndCidade(string $bairro, int $id_cidade)
{
        $sql = "SELECT * FROM logradouro WHERE
        descricao_bairro = ? AND id_cidade = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $bairro);
        $stmt->bindValue(2, $id_cidade);
        $stmt->execute();
        
        return $stmt->fetchAll(DAO::FETCH_CLASS);
}
    public function selectCidadesByUF($uf)
    {
        $sql = "SELECT * FROM cidade WHERE uf = ? ORDER BY descricao";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $uf);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS);
    }

}