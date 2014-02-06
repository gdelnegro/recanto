<?php

class Admin_Model_DbTable_Categorias extends Zend_Db_Table_Abstract
{

    protected $_name = 'categorias';
    protected $_primary = 'id_categoria';
    
    public function pesquisarCategoria($id = null, $where = null, $order = null, $limit = null){
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
    
    public function incluirCategoria(array $request, $usr){
        
        $dados = array(
            'categoria'            => $request['categoria'],
            'slug_categoria'         =>  $request['slug_categoria'],
        );
        
        return $this->insert($dados);
    }
    
    public function alterarCategoria(array $request){
        
        $dados = array(
            'categoria'            => $request['categoria'],
            'slug_categoria'         =>  $request['slug_categoria'],
        );
        
        $where = $this->getAdapter()->quoteInto("id_categoria = ?", $request['id_categoria']);
        $this->update($dados, $where);
    }
    
    public function getListaCategorias(){
        $select = $this->_db->select()
                ->from($this->_name, array('key'=>'id_categoria','value'=>'categoria'));
        $result = $this->getAdapter()->fetchAll($select);
        
        return $result;
    }


}

