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
        
        $usuario->setIdUser(15);
        $usuario->setTotalFollowers(21);
        $usuario->setTotalRetweets(30);
        $usuario->setTotalLikes(14);
        $usuario->setTotalMentions(15);
        $usuario->setIdPosi(3);
        
        
        $this->assertEquals(15, $usuario->getIdUser());
        $this->assertEquals(21, $usuario->getTotalFollowers());
        $this->assertEquals(30, $usuario->getTotalRetweets());
        $this->assertEquals(14, $usuario->getTotalLikes());
        $this->assertEquals(3, $usuario->getIdPosi());
        
        $this->assertEquals(30021.74, $usuario->avaliarTweetUsuario());
                
    }
    
    
        
}

?>
