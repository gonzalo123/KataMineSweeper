<?php
class Buscaminas 
{
    private $tablero;
    
    public function __construct($inputString)
    {
        $this->tablero = $this->decode($inputString);
    }

    public function getTablero()
    {
        return $this->tablero;
    }

    private function decode($inputString)
    {
        $out = array();
        $inputString = explode("\n", $inputString);
        foreach ($inputString as $inputFila) {
            $fila = array();
            for($i=0; $i<strlen($inputFila); $i++) {
                $fila[] = $inputFila[$i];
            }
            $out[] = $fila;
        }
        return $out;
    }

    public function buscaMinasCercanas($fila, $columna)
    {
        if ($this->tablero[$fila][$columna] == '*') {
            return '*';
        }
        $numeroDeMinas = 0;
        foreach (array(-1, 0, 1) as $x) {
            foreach (array(-1, 0, 1) as $y) {
                if (isset($this->tablero[$fila + $x][$columna + $y])) {
                    $elemento = $this->tablero[$fila + $x][$columna + $y];
                    if ('*' == $elemento) {
                        $numeroDeMinas++;
                    }
                }
            }
        }
        return $numeroDeMinas;
    }

    public function play()
    {
        $resultado = array();
        foreach ($this->tablero as $i => $fila) {
            foreach ($fila as $j => $elemento){
                $resultado[$i][$j] = $this->buscaMinasCercanas($i, $j);
            }
        }
        return $this->encode($resultado);
    }

    private function encode($tableroResultado)
    {
        $resultado = array();
        foreach ($tableroResultado as $fila){
            $resultado[] = implode("", $fila);
        }
        return implode("\n", $resultado);
    }
}
