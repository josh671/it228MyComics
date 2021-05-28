<?php include('./includes/config.php'); 
      include('./includes/header.php'); 
      include('./includes/nav.php'); ?>
<div class="contaier">
<div id="news_container">
<div id="new_nav">
      <ul>
            <li>Manga News</li>
            <li>Industry News</li>
            <li>Comics News</li>
      </ul>
</div>
<div class="news_feed one news_feed_active">
      <h1 class="news_title">Manga News</h1>
      <p id="news_feed_source">Provided by "kodansha"</p>
      <?php 
      $request="https://kodansha.us/feed/";
      $response = file_get_contents($request); 
      $xml = simplexml_load_string($response); 

      foreach($xml->channel->item as $story){ 
          echo '<a id="newLink" class="news_link" href="'.$story->link.'">New Story: '.$story->title.'</a><br \ >'; 
          echo '<p class="news_description">'.$story->description.'</p>'; 
      }
      ?>
</div>
<div class="news_feed two">
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
<div class="news_feed one news_feed_active">
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
<div class="news_feed two">
      <h1 class="news_title">Comics Forum</h1>
      <p id="news_feed_source">Provided by "Times Union"</p>
      <?php 
      $request="https://comicbookrealm.com/rss/forums";
      $response = file_get_contents($request); 
      $xml = simplexml_load_string($response); 

      foreach($xml->channel->item as $story){ 
          echo '<a class="news_link" href="'.$story->link.'">New Story: '.$story->title.'</a>'; 
          echo '<p class="news_description">'.$story->description.'</p>'; 
      }
      ?>
</div>
<div class="news_feed one news_feed_active">
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

</body>
</html> 

