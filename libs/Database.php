<?php

class Database extends PDO {

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
        $this->exec("SET CHARACTER SET utf8");
        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Parameters to bind
     * @param constant $fetchMode A PDO Fetch modes
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }

        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    /*
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */

    public function insert($table, $data) {
        ksort($data);

        $fieldNames = implode(',', array_keys($data));
        $fieldValues = implode("', '", array_values($data));

        $sth = $this->prepare("INSERT INTO $table ($fieldNames)
            VALUES ('$fieldValues')");
        return $sth->execute();
    }

    /*
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */

    public function update($table, $data, $where) {
        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        
        foreach ($data as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        return $sth->execute();
    }

    /**
     * delete
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected rows
     */
    public function delete($table, $where, $limit = 1) {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

}