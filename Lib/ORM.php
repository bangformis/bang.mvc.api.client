<?php

/**
 * ORM常用功能
 * @author Bang
 */
class ORM {

    public static function SetObjectValueFromArray($obj , $array){
        $reflect = new ReflectionClass($objOrClassName);
        $obj = $objOrClassName;
        if (!is_a($obj, $reflect->getName())) {
            $obj = $reflect->newInstanceArgs();
        }

        $properties = $reflect->getProperties();
        foreach ($properties as $property) {
            $name = $property->name;
            if (isset($array[$name])) {
                $property->setValue($obj, $array[$name]);
            }
        }
        return $obj;
    }
    
    /**
     * 將物件轉換為陣列
     * @param mixed $obj
     * @return array 結果陣列
     */
    public static function ObjectToArray($obj) {
        return get_object_vars($obj);
    }

    /**
     * 將Array(字串索引)轉換為物建
     * @param array $array 字串索引的陣列
     * @param string $objOrClassName 物件或物件類別名稱
     * @return mixed 轉換結果
     */
    public static function ArrayToObject($array, $objOrClassName) {
        $reflect = new ReflectionClass($objOrClassName);
        $obj = $objOrClassName;
        if (!is_a($obj, $reflect->getName())) {
            $obj = $reflect->newInstanceArgs();
        }

        $properties = $reflect->getProperties();
        foreach ($properties as $property) {
            $name = $property->name;
            if (isset($array[$name])) {
                $property->setValue($obj, $array[$name]);
            }
        }
        return $obj;
    }

    /**
     * 將2維 陣列(第二維必須維字串索引)  轉換為物件陣列 並對應Key名稱
     * @param array $array 2維陣列 字串索引的陣列
     * @param string $className 物建類別名稱
     * @return array 轉換結果陣列
     */
    public static function TwoDArrayToObjectsKeyArray($twoD_Array, $className, $key_name) {
        $reflect = new ReflectionClass($className);
        $result = array();

        foreach ($twoD_Array as $row) {
            $item = $reflect->newInstanceArgs();
            //設定所有屬性
            $properties = $reflect->getProperties();
            foreach ($properties as $property) {
                $name = $property->name;
                if (isset($row[$name])) {
                    $property->setValue($item, $row[$name]);
                }
            }
            $key = $row[$key_name];
            $result[$key] = $item;
        }
        return $result;
    }

    /**
     * 將2維 陣列(第二維必須維字串索引)  轉換為物件陣列
     * @param array $array 2維陣列 字串索引的陣列
     * @param string $className 物建類別名稱
     * @return array 轉換結果陣列
     */
    public static function TwoDArrayToObjects($twoD_Array, $className) {
        $reflect = new ReflectionClass($className);
        $result = array();

        foreach ($twoD_Array as $row) {
            $item = $reflect->newInstanceArgs();

            //設定所有屬性
            $properties = $reflect->getProperties();
            foreach ($properties as $property) {
                $name = $property->name;
                if (isset($row[$name])) {
                    $property->setValue($item, $row[$name]);
                }
            }
            $result[] = $item;
        }
        return $result;
    }

}
