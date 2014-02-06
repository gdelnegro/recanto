<?php

class Admin_Model_DbTable_Cortes extends Zend_Db_Table_Abstract
{

    protected $_name = 'cortes';
    protected $_primary = 'id';
    
    public function pesquisarCorte($id = null, $where = null, $order = null, $limit = null){
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
    
    public function incluirCorte(array $request, $usr){
        
        $dados = array(
            'titulo'            => $request['titulo'],
            'imagem_corte'         =>  $request['imagem_corte'],
        );
        
        return $this->insert($dados);
    }
    
    public function alterarCorte(array $request){
        
        $dados = array(
            'titulo'            => $request['titulo'],
            'imagem_corte'         =>  $request['imagem_corte'],
        );
        
        $where = $this->getAdapter()->quoteInto("id = ?", $request['id']);
        $this->update($dados, $where);
    }
    
    public function getListaCortes(){
        $select = $this->_db->select()
                ->from($this->_name, array('key'=>'id','value'=>'corte'));
        $result = $this->getAdapter()->fetchAll($select);
        
        return $result;
    }


}

