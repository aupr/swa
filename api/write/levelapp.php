<?php


httpRESTMethod::post(function ($pdt){
    //var_dump($pdt);
    global $db;
    $result = $db->query("INSERT INTO `permission` (permissionLevelId, permissionAppId, access) VALUES ('$pdt->permissionLevelId', '$pdt->permissionAppId', '[]');");

    return $result;
});

/*
object(stdClass)#17 (2) {
["permissionLevelId"]=>
  int(1)
  ["permissionAppId"]=>
  int(1)
}
*/

/*
{
    "permissionLevelId": 1,
    "permissionAppId": 1
}
*/

