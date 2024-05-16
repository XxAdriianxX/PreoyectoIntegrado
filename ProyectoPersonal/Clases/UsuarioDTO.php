<?php

class UsuarioDTO {
    private $id;
    private $username;
    private $password;
    private $securePassword;
    private $mail;
    private $ubicacion;
    private $puntos;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getUbicacion() {
        return $this->ubicacion;
    }

    public function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    public function getPuntos() {
        return $this->puntos;
    }

    public function setPuntos($puntos) {
        $this->puntos = $puntos;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getSecurePassword()
    {
        return $this->securePassword;
    }

    public function setSecurePassword($securePassword)
    {
        $this->securePassword = $securePassword;

        return $this;
    }
}