<?php


httpRESTMethod::post(function ($pdt){
    //var_dump($pdt);
    global $db;
    $result = $db->query("DELETE FROM `permission` WHERE `permission`.`permissionId` = '$pdt->permissionId';");

    return $result;
});



/*
object(stdClass)#17 (1) {
["permissionId"]=>
  int(7)
}
*/



/*
{
    "permissionId":7
}
*/

