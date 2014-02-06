<?php

class Admin_Model_DbTable_ModoPreparo extends Zend_Db_Table_Abstract
{

    protected $_name = 'modopreparo';
    protected $_primary = 'id';
    
    public function pesquisarModoPreparo($id = null, $where = null, $order = null, $limit = null){
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
    
    public function incluirModoPreparo(array $request, $usr){
        
        $dados = array(
            'modo_preparo'            => $request['modo_preparo'],
            'imagem_modo_preparo'         =>  $request['imagem_modo_preparo'],
        );
        
        return $this->insert($dados);
    }
    
    public function alterarModoPreparo(array $request){
        
        $dados = array(
            'modo_preparo'            => $request['modo_preparo'],
            'imagem_modo_preparo'         =>  $request['imagem_modo_preparo'],
        );
        
        $where = $this->getAdapter()->quoteInto("id = ?", $request['id']);
        $this->update($dados, $where);
    }
    
    public function getListaModosPreparo(){
        $select = $this->_db->select()
                ->from($this->_name, array('key'=>'id','value'=>'modo_preparo'));
        $result = $this->getAdapter()->fetchAll($select);
        
        return $result;
    }


}

