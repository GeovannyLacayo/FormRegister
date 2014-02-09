<?php

/**
 * Description of Usuarios
 *
 * @author kosios029
 */
class Usuarios {
    
    private $_iduser;
    private $_fullname;
    private $_email;
    private $_password;
    private $_password2;
    
    public function getIduser() {
        return $this->_iduser;
    }

    public function setIduser($iduser) {
        $this->_iduser = $iduser;
    }

    public function getFullname() {
        return $this->_fullname;
    }

    public function setFullname($fullname) {
        $this->_fullname = $fullname;
    }
    
     public function getEmail() {
        return $this->_email;
    }

    public function setEmail($email) {
        $this->_email = $email;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function getPassword2() {
        return $this->_password2;
    }

    public function setPassword2($password2) {
        $this->_password2 = $password2;
    }


}


