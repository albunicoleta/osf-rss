<?php

class OSF_Model extends CI_Model {

    
    protected $_tableName = null;
    /**
     *
     * @var int 
     */
    private $_limit;

    /**
     *
     * @var int
     */
    private $_offset = 0;

    /**
     * get table name associated with model
     * 
     * @return string
     * @throws string
     */
    public function getTableName()
    {
        if ($this->_tableName === null){
            throw Exception('Model must have an associated table name');
        }
        
        return $this->_tableName;
    }
    
    /**
     * set table name associated with model
     * 
     * @param string $tableName
     * @return $this
     */
    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
        
        return $this;
    }
    
    /**
     * return $this->_limit
     * @return int
     */
    public function getLimit()
    {
        if ($this->_limit === null) {
            $this->setLimit($this->recordCount());
        }
        return $this->_limit;
    }

    /**
     * return $this->_offset
     * @return int
     */
    public function getOffset()
    {
        return $this->_offset;
    }

    /**
     * set _limit for current instance
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->_limit = $limit;

        return $this;
    }

    /**
     * set _offset for current instance
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->_offset = $offset;

        return $this;
    }
    
    /**
     * Returns an array with all the rows from the table
     * 
     * @return array of stdObj
     */
    public function getAll()
    {
        $query = $this->db->get($this->getTableName(), $this->getLimit(), $this->getOffset());
        $result = array();
        foreach ($query->result() as $row) {
            $result[] = $row;
        }
        
        return $result;
    }
    
    /**
     * Returns numbers of total rows in associated table
     * 
     * @return int
     */
    public function recordCount()
    {
        return $this->db->count_all($this->getTableName());
    }

}
