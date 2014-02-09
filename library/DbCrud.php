<?php

/* @Descripcion:Libreria CRUD para Manejar las rutinas contra la Base datos (insertar, leer, Actualizar, eliminar)
 * @Author: Jeison Varilla
 * @Version: 0.1 Beta
 * @Licencia: Libre uso GNU-GPL 
 * @Email:keypherc@gamil.com 
 * @Website:www.keyphercom.com
 */

require_once 'DbPdo.php';

class DbCrud {

    protected function _getDbh() {
        return DbPdo::getInstance()->getConn();
    }

    public function save($table, $datas, $where) {

        if ($where == null) {
            $sql = "INSERT INTO `$table` values (null,";

            foreach ($datas as $value) {

                $sql .= " '$value',";
            }

            $sql = substr($sql, 0, -1); // Elimina la ultima coma
            $sql .= ")";
        } else {

            $sql = "UPDATE `$table` SET";

            foreach ($datas as $key => $value) {

                $sql .= " `$key` = '$value',";
            }

            $sql = substr($sql, 0, -1); // Elimina la ultima coma
            $where = trim($where);
            $sql .= " WHERE $where";
        }
        //echo $sql;
        return $this->_getDbh()->query($sql);
    }

    public function delete($table, $where) {

        $sql = "DELETE from `$table` WHERE $where";
        return $this->_getDbh()->query($sql);
    }

    public function countAll($table, $where) {

        if ($where == null) {
            $sql = "SELECT * from `$table`";
        } else {
            $sql = "SELECT * from `$table`
                      WHERE $where";
        }
        $nRows = $this->_getDbh()->query($sql)->fetchAll();
        return count($nRows);
    }

    public function select($table, $datas, $order, $where) {

        $found = new ArrayObject();

        if ($datas == null) {

            $sql = "SELECT * from `$table`";
        } else {
            $sql = "SELECT";

            foreach ($datas as $value) {

                $sql .= " $value,";
            }

            $sql = substr($sql, 0, -1); // Elimina la ultima coma

            if ($where == null && $order != null) {
                $sql .= " from `$table` ORDER BY $order";
            } elseif ($where != null && $order == null) {

                $sql .= " from `$table` WHERE $where ";
            } elseif ($where != null && $order != null) {
                $sql .= " from `$table`     
                          WHERE $where ORDER BY $order";
            }



            //echo $sql;
        }

        /* Recorremos y almacenamos los datos en un arrayObjetc */
        $stm = $this->_getDbh()->query($sql);

        while ($rows = $stm->fetch(PDO::FETCH_ASSOC)) {

            $found->append($rows);
        }

        return $found;
    }

}
