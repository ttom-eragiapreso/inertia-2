<?php

function get_ctx(){
    $opts = array(
        'http'=>array(
            'method'=>"GET",
            'header'=>"Accept-language: */*",
            'user_agent' => 'My Library test app - localhost'
            )
        );
        // Options encapsulation in a context
        $context = stream_context_create($opts);

    return $context;
}

function getAuthor($album){

    if(str_contains($album['title'],' - ')){
      return trim(explode('-', $album['title'])[0]);
    }else {
      return $album['title'];
    }
  }

  function getTitle($album){

    if(str_contains($album['title'],' - ')){
      return trim(explode('-', $album['title'])[1]);
    }else {
      return $album['title'];
    }
  }

