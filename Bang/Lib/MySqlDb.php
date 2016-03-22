<?php

namespace Bang\Lib;

/**
 * @author Bang
 */
class MySqlDb {

    protected $pdo;
    protected $host;
    protected $name;
    protected $username;
    protected $password;

    function __construct($host, $username, $password, $name = null) {

        $this->host = $host;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;

        $pdo = new \PDO("mysql:host={$host};charset=utf8", $username, $password);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8;");
        if (String::IsNotNullOrSpace($name)) {
            $pdo->exec("USE {$name};");
        }

        $this->pdo = $pdo;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return \PDOStatement
     */
    public function Query($sql, $params = array()) {
        $con = $this->pdo;
        $stem = $con->prepare($sql);
        $stem->execute($params);
        return $stem;
    }

    /**
     * 執行Insert Query
     * @param string $sql Prepare SQL語法
     * @param array $params 傳入參數
     * @return string Insert后LastId
     */
    public function Insert($sql, $params = array()) {
        $con = $this->pdo;
        $stem = $con->prepare($sql);
        $stem->execute($params);
        return $con->lastInsertId();
    }

    /**
     * @param string $db_name
     * @return bool
     */
    public function IsDbExist($db_name) {
        $sql = "SHOW DATABASES LIKE '{$db_name}';";
        $stem = $this->Query($sql);
        return $stem->rowCount() == 1;
    }

    /**
     * 判斷資料表是否存在
     * @param string $table_name
     * @return boolean 判斷結果
     */
    public function IsTableExist($table_name) {
        $sql = "show tables like '{$table_name}'";
        $query_result = $this->Query($sql);
        $query_result->fetchAll(\PDO::FETCH_ASSOC);
        $row_count = $query_result->rowCount();
        return $row_count > 0;
    }

    public function BeginTransaction() {
        $result = $this->pdo->beginTransaction();
        if (!$result) {
            throw new \Exception('Begin Transaction Error!', \Models\ErrorCode::DatabaseError);
        }
    }

    public function Commit() {
        $result = $this->pdo->commit();
        if (!$result) {
            throw new \Exception('Commit Transaction Error!', \Models\ErrorCode::DatabaseError);
        }
    }

    public function Rollback() {
        if ($this->pdo->inTransaction()) {
            $result = $this->pdo->rollBack();
            if (!$result) {
                throw new \Exception('Rollback Transaction Error!', \Models\ErrorCode::DatabaseError);
            }
        }
    }

    public function Disconnect() {
        $this->pdo = null;
    }

    /**
     * @param string $tablename
     * @param string $params (参数以where开头将不会被Update,只会带入where语法中)
     * @return string last_insert_id
     */
    public function QuickInsert($tablename, $params) {
        $keys = array();
        foreach ($params as $key => $value) {
            $keys[] = String::Replace($key, ':', '');
        }

        $fields = "";
        $values = "";
        foreach ($keys as $key => $value) {
            if ($key > 0) {
                $fields .= ",";
                $values .= ",";
            }
            $fields .= "`{$value}`";
            $values .= " :{$value}";
        }
        $sql = "INSERT INTO `{$tablename}`($fields) VALUES ($values) ;";
        $result = $this->Insert($sql, $params);
        return $result;
    }

    /**
     * 
     * @param string $tablename
     * @param string $where
     * @param string $params (参数以where开头将不会被Update,只会带入where语法中)
     * @return \PDOStatement
     */
    public function QuickUpdate($tablename, $where, $params) {
        $keys = array();
        foreach ($params as $key => $value) {
            $keys[] = String::Replace($key, ':', '');
        }

        $set_sql = "";
        $count = 0;
        foreach ($keys as $value) {
            if (String::StartsWith($value, 'where')) {
                continue;
            }
            if ($count > 0) {
                $set_sql .= ",";
            }
            $set_sql .= "`{$value}`=:{$value}";
            $count++;
        }

        $sql = "UPDATE `{$tablename}` SET {$set_sql} WHERE ({$where})";
        $result = $this->Query($sql, $params);
        return $result;
    }

}
