<?php
require '../Buscaminas.php';

class BuscaminasTest extends PHPUnit_Framework_TestCase
{
    public function testDecodeInput()
    {
        $buscaMinas = new Buscaminas(".");
        $this->assertEquals(array(array('.')), $buscaMinas->getTablero());

        $buscaMinas = new Buscaminas(".*");
        $this->assertEquals(array(array('.', '*')), $buscaMinas->getTablero());

        $buscaMinas = new Buscaminas(".*\n.*");
        $this->assertEquals(array(array('.', '*'), array('.', '*')), $buscaMinas->getTablero());
    }

    public function testBuscaMinasCercanas()
    {
        $buscaMinas = new Buscaminas(".*\n.*");
        $this->assertEquals(2, $buscaMinas->buscaMinasCercanas(0, 0));
        $this->assertEquals("*", $buscaMinas->buscaMinasCercanas(0, 1));
        $this->assertEquals(2, $buscaMinas->buscaMinasCercanas(1, 0));
    }

    public function testBuscaMinasCercanasConOtroTablero()
    {
        $buscaMinas = new Buscaminas("*.\n.*");
        $this->assertEquals(2, $buscaMinas->buscaMinasCercanas(0, 1));
    }

    public function testResuelve()
    {
        $buscaMinas = new Buscaminas("*.\n.*");
        //$this->assertEquals(array(array('*', 2), array(2, '*')), $buscaMinas->play());
        $this->assertEquals("*2\n2*", $buscaMinas->play());
    }
}
