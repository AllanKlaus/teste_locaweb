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
        
        $tweet->setAvaliacao("");
        $tweet->setCreated_at("");
        $tweet->setFavorites_count(30);
        $tweet->setFollowers_count(14);
        $tweet->setId_in_reply_to_user_id_str("");
        $tweet->setId_str_mentions("");
        $tweet->setId_str_user("");
        $tweet->setRetweet_count(54);
        $tweet->setScreen_name("");
        $tweet->setText("");
        
        $this->assertEquals("", $tweet->getText());
        $this->assertEquals("", $tweet->getCreatAt());
        $this->assertEquals(30, $tweet->getFavoritesCount());
        $this->assertEquals(14, $tweet->getFollowersCount());
        $this->assertEquals("", $tweet->getId_in_reply_to_user_id_str());
        $this->assertEquals("", $tweet->getId_str_mentions());
        $this->assertEquals(54, $tweet->getRetweetCount());
        $this->assertEquals("", $tweet->getScreenName());
        
        $this->assertEquals(26, $tweet->setAvaliacao());
        
                
    }
    
    
        
}

?>
