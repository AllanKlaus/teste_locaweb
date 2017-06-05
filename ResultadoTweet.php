<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResultadoTweet
 *
 * @author Larissa
 */
class ResultadoTweet {
    public $screen_name;//
    public $link_perfil;
    public $followers_count; //
    public $retweet_count; //
    public $favourites_count; //
    public $text; //
    public $created_at; //
    public $link_tweet;
    
    public function ResultadoTweet(){
        
    }
    
    public function getFollowers_count() {
        return $this->followers_count;
    }

    public function setFollowers_count($followers_count) {
        $this->followers_count = $followers_count;
    }

    public function getRetweet_count() {
        return $this->retweet_count;
    }

    public function setRetweet_count($retweet_count) {
        $this->retweet_count = $retweet_count;
    }

    public function getFavourites_count() {
        return $this->favourites_count;
    }

    public function setFavourites_count($favourites_count) {
        $this->favourites_count = $favourites_count;
    }

    public function getScreen_name() {
        return $this->screen_name;
    }

    public function setScreen_name($screen_name) {
        $this->screen_name = $screen_name;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getLink_perfil() {
        return $this->link_perfil;
    }

    public function setLink_perfil($link_perfil) {
        $this->link_perfil = $link_perfil;
    }

    public function getLink_tweet() {
        return $this->link_tweet;
    }

    public function setLink_tweet($link_tweet) {
        $this->link_tweet = $link_tweet;
    }
    
}

?>
