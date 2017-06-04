<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Larissa
 */
class Usuario {
    //put your code here
    public $id_user;
    public $total_followers;
    public $total_retweets;
    public $total_likes;
    public $id_posi;
    public $avaliacao;
    
    public function getIdUser(){
        return $this->id_user;
    }
    
    public function getTotalFollowers(){
        return $this->total_followers;        
    }
    
    public function getTotalRetweets(){
        return $this->total_retweets;        
    }
    
    public function getTotalLikes(){
        return $this->total_likes;        
    }
    
    public function getIdPosi(){
        return $this->total_posi;        
    }
    
    public function setIdUser($idUser){
        $this->id_user = $idUser;
    }
    
    public function setTotalFollowers($totalFollowers){
        $this->total_followers = $totalFollowers;
    }
    
    public function setTotalRetweets($totalRetweets){
        $this->total_retweets = $totalRetweets;
    }
    
    public function setTotalLikes($totalLikes){
        $this->total_likes = $totalLikes;
    }
    
    public function setIdPosi($idPosi){
        $this->id_posi = $idPosi;
    }
    
    public function getAvaliacao(){
        return $this->avaliacao;        
    }
    
    public function setAvaliacao($avaliacao){
        $this->avaliacao = $avaliacao;
    }

    public function avaliarTweetUsuario(){
        
        // Usuário com mais seguidores = 0.6
        // Tweets com mais retweets = 0.3
        // Tweets com mais like =  0.1
        
        $pond_user = 0.6 * $this->getTotalFollowers();
        $pond_retweets = 0.3 * $this->getTotalRetweets();
        $pond_likes = 0.1 * $this->getTotalLikes();
        
        $valor_avaliacao= $pond_user + $pond_retweets + $pond_likes;
        
        $this->setAvaliacao($valor_avaliacao);
        
    }
}

?>
