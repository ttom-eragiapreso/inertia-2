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

