<?php

httpRESTMethod::get(function (){
    global $db;
    $rd = $db->query("SELECT * FROM level");
    return $rd->rows;
});

httpRESTMethod::post(function ($dt){
    $levelId = $dt->levelId;
    global $db;
    $rd = $db->query("SELECT * FROM level WHERE levelId = $levelId");
    return $rd->row;
});
