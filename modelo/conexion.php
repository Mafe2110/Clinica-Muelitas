<?php

class Conexion
{
    private $mysqli;
    private $sql;
    private $result;
    private $filasAfectadas;
    private $citaId;

    public function abrir()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'clinica_muelitas');

        if ($this->mysqli->connect_errno) {
            return 0;
        }

        $this->mysqli->set_charset('utf8');
        return 1;
    }

    public function cerrar()
    {
        if ($this->mysqli instanceof mysqli) {
            $this->mysqli->close();
        }
    }

    public function consulta($sql)
    {
        $this->sql = $sql;
        $this->result = $this->mysqli->query($this->sql);
        $this->filasAfectadas = $this->mysqli->affected_rows;
        $this->citaId = $this->mysqli->insert_id;
    }

    public function obtenerResult()
    {
        return $this->result;
    }

    public function obtenerFilasAfectadas()
    {
        return $this->filasAfectadas;
    }

    public function obtenerCitaId()
    {
        return $this->citaId;
    }

    public function obtenerMysqli()
    {
        return $this->mysqli;
    }
}