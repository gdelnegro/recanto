<?php

class Application_Model_DbTable_Frios extends Zend_Db_Table_Abstract
{

    protected $_name = 'frios';
    protected $_primary = 'id';
    
    public function pesquisarFrios($id = null, $where = null, $order = null, $limit = null){
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
    
    public function incluirFrios(array $request, $usr){
        
        $dados = array(
            /*
             * formato:
             * 'nome_campo => valor,
             */
            'titulo'            => $request['titulo'],
            'preco'             =>  $request['preco'],
            'imagem_produto'      =>  $request['imagem_produto'],
            'imagem_marca'      =>  $request['imagem_marca'],
            'marca'          =>  $request['marca'],
            'apresentacao'      =>  $request['apresentacao'],
        );
        
        return $this->insert($dados);
    }
    
    public function alterarFrios(array $request){
        
        $dados = array(
            /*
             * formato:
             * 'nome_campo => valor,
             */
            'titulo'            => $request['titulo'],
            'preco'             =>  $request['preco'],
            'imagem_produto'      =>  $request['imagem_produto'],
            'imagem_marca'      =>  $request['imagem_marca'],
            'marca'          =>  $request['marca'],
            'apresentacao'      =>  $request['apresentacao'],
        );
        
        $where = $this->getAdapter()->quoteInto("id = ?", $request['id']);
        $this->update($dados, $where);
    }
    
    public function getListaFrios(){
        $select = $this->_db->select()
                ->from($this->_name, array('key'=>'id','value'=>'titulo'));
        $result = $this->getAdapter()->fetchAll($select);
        
        return $result;
    }


}

