<?php

httpRESTMethod::get(function (){
    return logout();
});

httpRESTMethod::post(function ($dt){
    return logout();
});
