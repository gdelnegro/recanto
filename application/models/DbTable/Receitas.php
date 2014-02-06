<?php

class Application_Model_DbTable_Receitas extends Zend_Db_Table_Abstract
{

    protected $_name = 'receitas';
    protected $_primary = 'id';
    
    public function pesquisarReceitas($id = null, $where = null, $order = null, $limit = null){
        if( !is_null($id) ){
            $arr = $this->find($id)->toArray();
            return $arr[0];
        }else{
            $select = $this->select()->from($this)->order($order)->limit($limit);
            if(!is_null($where)){
                $select->where($where);
            }
            return $this->fetchAll($select)->toArray();
        }
    }
    
    public function incluirReceita(array $request, $usr){
        $date = Zend_Date::now()->toString('yyyy-MM-dd');
        
        $dados = array(
            /*
             * formato:
             * 'nome_campo => valor,
             */
            'titulo'            => $request['titulo'],
            'slug_receita'             =>  $request['slug_receita'],
            'ingredientes1'      =>  $request['ingredientes1'],
            'ingredientes2'      =>  $request['ingredientes2'],
            'ingredientes3'      =>  $request['ingredientes3'],
            'modo_preparo'      =>  $request['modo_preparo'],
            'categoria'      =>  $request['categoria'],
            'imagem_receita'      =>  $request['imagem_receita'],
            'adicionada_quando'          =>  $date,
            'apresentacao'      =>  $request['apresentacao'],
        );
        
        return $this->insert($dados);
    }
    
    public function alterarReceita(array $request){
        
        $dados = array(
            /*
             * formato:
             * 'nome_campo => valor,
             */
            'titulo'            => $request['titulo'],
            'slug_receita'             =>  $request['slug_receita'],
            'ingredientes1'      =>  $request['ingredientes1'],
            'ingredientes2'      =>  $request['ingredientes2'],
            'ingredientes3'      =>  $request['ingredientes3'],
            'modo_preparo'      =>  $request['modo_preparo'],
            'categoria'      =>  $request['categoria'],
            'imagem_receita'      =>  $request['imagem_receita'],
            'apresentacao'      =>  $request['apresentacao'],
        );
        
        $where = $this->getAdapter()->quoteInto("id = ?", $request['id']);
        $this->update($dados, $where);
    }


}

