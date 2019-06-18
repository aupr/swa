<?php

httpRESTMethod::post(function ($pdt){
    //var_dump($pdt);
    global $db;

    $result = $db->query("INSERT INTO `level` (title, description) VALUES ('$pdt->title', '$pdt->description');");

    return $result;
});



/*
object(stdClass)#17 (3) {
  ["levelId"]=>
  NULL
  ["title"]=>
  string(9) "developer"
  ["description"]=>
  string(67) "developer can do anything with super access to all over the system."
}
*/



/*
{
    "levelId": null,
    "title": "developer",
    "description": "developer can do anything with super access to all over the system."
}
*/

