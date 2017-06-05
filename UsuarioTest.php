<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TweetTest
 *
 * @author Larissa
 */

require_once "Usuario.php";

class UsuarioTest extends PHPUnit_Framework_TestCase{
    
    public function tests(){
        $usuario = new Usuario();
        
        $usuario->setIdUser("");
        $usuario->setTotalFollowers("");
        $usuario->setTotalRetweets(30);
        $usuario->setTotalLikes(14);
        $usuario->setIdPosi("");
        
        
        $this->assertEquals("", $usuario->getIdUser());
        $this->assertEquals("", $usuario->getTotalFollowers());
        $this->assertEquals(30, $usuario->getTotalRetweets());
        $this->assertEquals(14, $usuario->getTotalLikes());
        $this->assertEquals("", $usuario->getIdPosi());
        
        $this->assertEquals("", $usuario->avaliarTweetUsuario());
        
                
    }
    
    
        
}

?>
