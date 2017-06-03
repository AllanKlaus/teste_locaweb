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

class TweetTest extends PHPUnit_Framework_TestCase {

    public function tests() {
        $tweet = new Tweet("", "", "", "", "", "", "", "", "", "", "");

        $tweet->setAvaliacao("");
        $tweet->setCreated_at("");
        $tweet->setFavorites_count("");
        $tweet->setFollowers_count("");
        $tweet->setId_in_reply_to_user_id_str("");
        $tweet->setId_str_mentions("");
        $tweet->setId_str_user("");
        $tweet->setPositionJson("");
        $tweet->setRetweet_count("");
        $tweet->setScreen_name("");
        $tweet->setText("Texto");

        $this->assertEquals("Texto", $tweet->getText());
        //$this->assertEquals("Texto", $tweet->getAvaliacao());
    }

}

?>
