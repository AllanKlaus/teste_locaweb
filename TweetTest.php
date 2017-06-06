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

require_once "Tweet.php";

class TweetTest extends PHPUnit_Framework_TestCase{
    
    public function tests(){
        $tweet = new Tweet("","","","","","","","","","","");
        
        $tweet->setCreated_at("Mon Sep 24 03:35:21 +0000 2012");
        $tweet->setFavorites_count(30);
        $tweet->setFollowers_count(14);
        $tweet->setId_in_reply_to_user_id_str("");
        $tweet->setId_str_mentions("42");
        $tweet->setId_str_user("15");
        $tweet->setRetweet_count(54);
        $tweet->setScreen_name("Larissa_Camila");
        $tweet->setText("Texto Tweet");
        
        $this->assertEquals("Texto Tweet", $tweet->getText());
        $this->assertEquals("Mon Sep 24 03:35:21 +0000 2012", $tweet->getCreatAt());
        $this->assertEquals(30, $tweet->getFavoritesCount());
        $this->assertEquals(14, $tweet->getFollowersCount());
        $this->assertEquals("", $tweet->getId_in_reply_to_user_id_str());
        $this->assertEquals("42", $tweet->getId_str_mentions());
        $this->assertEquals("15", $tweet->getId_str_user());
        $this->assertEquals(54, $tweet->getRetweetCount());
        $this->assertEquals("Larissa_Camila", $tweet->getScreenName());
        
        $this->assertEquals(22.74, $tweet->avaliarTweet());
        
                
    }
    
    
        
}

?>
