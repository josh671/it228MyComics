<?php include('./includes/config.php'); 
      include('./includes/header.php'); 
      include('./includes/nav.php'); ?>
<div class="contaier">
<div id="news_container">
<div id="news_instructions">
    <div id="news_instructions_nav">
        <ul> 
            <li class="instructions_nav_active" id="reg">Register</li> 
            <li id="upl">Upload</li> 
            <li id="warn">Warnings</li> 
        </ul>
    </div>
    <div id="one" class="column instructions_active">
      <h1 class="news_title">Industry News</h1>
      <p id="news_feed_source">Provided by "Times Union"</p>
      <?php 
      $request="http://blog.timesunion.com/comicbooks/feed";
      $response = file_get_contents($request); 
      $xml = simplexml_load_string($response); 

      foreach($xml->channel->item as $story){ 
          echo '<a class="news_link" href="'.$story->link.'">New Story: '.$story->title.'</a><br \ >'; 
          echo '<p class="news_description">'.$story->description.'</p>'; 
      }
      ?>

</div>
<div id="two" class="column">
<h1 class="news_title">DC/Marvel News</h1>
      <p id="news_feed_source">Provided by "The beat"</p>
      <?php 
      $request="https://www.comicsbeat.com/feed/";
      $response = file_get_contents($request); 
      $xml = simplexml_load_string($response); 

      foreach($xml->channel->item as $story){ 

          echo '<a class="news_link" href="'.$story->link.'">New Story: '.$story->title.'</a>'; 
          echo '<p class="news_description">'.$story->description.'</p>'; 
      }
      ?>
</div>
<div id="three" class="column">
<h1 class="news_title">MCU/DCU News</h1>
      <p id="news_feed_source">Provided by "Comicverse"</p>
      <?php 
      $request="https://comicsverse.com/feed";
      $response = file_get_contents($request); 
      $xml = simplexml_load_string($response); 

      foreach($xml->channel->item as $story){ 

          echo '<a class="news_link" href="'.$story->link.'">New Story: '.$story->title.'</a>'; 
          echo '<p class="news_description">'.$story->description.'</p>'; 
      }
      ?>
</div>
</div><!-- END NEWS CONTAINER -->
</div><!-- END CONTAINER -->

<div id="home_wrapper"> 
      <div class="home_image_container">
          <img src="images/comic1.jpg" alt="comic1">
      </div>

      <div class="home_image_container">
         <img src="images/comic1.jpg" alt="comic1">
      </div>

      <div class="home_image_container">
         <img src="images/comic1.jpg" alt="comic1">
      </div>
</div>

</body>
</html> 

