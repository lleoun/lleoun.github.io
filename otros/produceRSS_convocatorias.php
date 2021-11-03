<?php
include("FeedWriter.php");
include('simple_html_dom.php');

$html = file_get_html('http://www.aracelidominguez.com');

//Creating an instance of FeedWriter class. 
$TestFeed = new FeedWriter(RSS2);
$TestFeed->setTitle('Testing & Checking the RSS writer class');
$TestFeed->setLink('http://www.ajaxray.com/projects/rss');
$TestFeed->setDescription(
  'This is test of creating a RSS 2.0 feed Universal Feed Writer');

$TestFeed->setImage('Testing the RSS writer class',
                    'http://www.ajaxray.com/projects/rss',
                    'http://www.rightbrainsolution.com/images/logo.gif');

//parse through the HTML and build up the RSS feed as we go along
foreach($html->find('td[width="380"] p table') as $article) {
  //Create an empty FeedItem
  $newItem = $TestFeed->createNewItem();

  //Look up and add elements to the feed item   
  $newItem->setTitle($article->find('span.title', 0)->innertext);
  $newItem->setDescription($article->find('.ingress', 0)->innertext);
  $newItem->setLink($article->find('.lesMer', 0)->href);     
  $newItem->setDate($article->find('span.presseDato', 0)->plaintext);     

  //Now add the feed item
  $TestFeed->addItem($newItem);
}

$TestFeed->genarateFeed();
?>