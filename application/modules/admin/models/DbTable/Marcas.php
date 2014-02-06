<?php

class Admin_Model_DbTable_Marcas extends Zend_Db_Table_Abstract
{

    protected $_name = 'marcas';
    protected $_primary = 'id';
    
    
    public function pesquisarMarcas($id = null, $where = null, $order = null, $limit = null){
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
    
    public function incluirMarca(array $request, $usr){
        
        $dados = array(
            'titulo'            => $request['titulo'],
            'slug'             =>  $request['slug'],
            'imagem_marca'      =>  $request['imagem_marca'],
        );
        
        return $this->insert($dados);
    }
    
    public function alterarMarcas(array $request){
        
        $dados = array(
            'titulo'            => $request['titulo'],
            'slug'             =>  $request['slug'],
            'imagem_marca'      =>  $request['imagem_marca'],
        );
        
        $where = $this->getAdapter()->quoteInto("id = ?", $request['id']);
        $this->update($dados, $where);
    }
    
    public function getListaMarcas(){
        $select = $this->_db->select()
                ->from($this->_name, array('key'=>'id','value'=>'titulo'));
        $result = $this->getAdapter()->fetchAll($select);
        
        return $result;
    }


}

