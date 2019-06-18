<?php

httpRESTMethod::post(function ($pdt){
    global $db;

    $result = $db->query("UPDATE `level` SET `title` = '$pdt->title', `description` = '$pdt->description' WHERE `level`.`levelId` = $pdt->levelId;");

    return $result;
});


/*
object(stdClass)#17 (3) {
["levelId"]=>
  string(1) "1"
["title"]=>
  string(9) "developer"
["description"]=>
  string(67) "developer can do anything with super access to all over the system."
}
*/



/*
{
    "levelId": "1",
    "title": "developer",
    "description": "developer can do anything with super access to all over the system."
}
*/
