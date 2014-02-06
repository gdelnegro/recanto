<?php

class Application_Model_DbTable_Acougue extends Zend_Db_Table_Abstract
{

    protected $_name = 'acougue';
    protected $_primary = 'id';
    
    public function pesquisarCarne($id = null, $where = null, $order = null, $limit = null){
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
    
    public function incluirCarne(array $request, $usr){
        
        $dados = array(
            /*
             * formato:
             * 'nome_campo => valor,
             */
            'titulo'            => $request['titulo'],
            'descricao'         =>  $request['descricao'],
            'observacao'        =>  $request['observacao'],
            'preco'             =>  $request['preco'],
            'imagem_carne'      =>  $request['imagem_carne'],
            'corte'             =>  $request['corte'],
            'imagem_corte'      =>  $request['imagem_corte'],
            'promocao'          =>  $request['promocao'],
            'apresentacao'      =>  $request['apresentacao'],
        );
        
        return $this->insert($dados);
    }
    
    public function alterarCarne(array $request){
        
        $dados = array(
            /*
             * formato:
             * 'nome_campo => valor,
             */
            'titulo'            => $request['titulo'],
            'descricao'         =>  $request['descricao'],
            'observacao'        =>  $request['observacao'],
            'preco'             =>  $request['preco'],
            'imagem_carne'      =>  $request['imagem_carne'],
            'corte'             =>  $request['corte'],
            'imagem_corte'      =>  $request['imagem_corte'],
            'promocao'          =>  $request['promocao'],
            'apresentacao'      =>  $request['apresentacao'],
        );
        
        $where = $this->getAdapter()->quoteInto("id = ?", $request['id']);
        $this->update($dados, $where);
    }
    
    public function getListaCarnes(){
        $select = $this->_db->select()
                ->from($this->_name, array('key'=>'id','value'=>'titulo'));
        $result = $this->getAdapter()->fetchAll($select);
        
        return $result;
    }


}

