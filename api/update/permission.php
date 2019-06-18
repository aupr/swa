<?php


httpRESTMethod::post(function ($pdt){
    //var_dump($pdt);
    global $db;

    $appDfltAccesses = $db->query("SELECT * FROM `access` WHERE `access`.`accessAppId` = '$pdt->appId';");

    //mapping app default accesses
    $dfltAccessMap = array();
    foreach ($appDfltAccesses->rows as $index=>$appDfltAccess){
        $dfltAccessMap[$appDfltAccess["keyword"]] = $appDfltAccess["val"];
    }


    // making default access modifier
    $modifiedAccesses = array();
    foreach ($pdt->accessList as $index=>$access){
        //var_dump($access);
        if (isset($dfltAccessMap[$access->keyword])){
            if ($dfltAccessMap[$access->keyword] == $access->val){
                //echo "equal\n";
            } else {
                //echo "unequal\n";
                array_push($modifiedAccesses, array("keyword"=>$access->keyword, "val"=>$access->val));
            }
        }
    }

    $modifiedPermissionJSON = JSON_encode($modifiedAccesses);
    $result = $db->query("UPDATE `permission` SET `access` = '$modifiedPermissionJSON' WHERE `permission`.`permissionId` = '$pdt->permissionId';");

    return $result;
});


/*
object(stdClass)#17 (10) {
  ["permissionId"]=>
  string(1) "1"
  ["appId"]=>
  string(1) "1"
  ["levelId"]=>
  string(1) "1"
  ["title"]=>
  string(9) "developer"
  ["description"]=>
  string(67) "developer can do anything with super access to all over the system."
  ["appName"]=>
  string(24) "Client Management System"
  ["url"]=>
  string(35) "http://aslsdfsdfk.com/asfsdf/sadfds"
  ["sessAryName"]=>
  string(3) "cms"
  ["remark"]=>
  string(26) "lorem imsem dolor sit amet"
  ["accessList"]=>
  array(4) {
    [0]=>
    object(stdClass)#18 (3) {
      ["keyword"]=>
      string(4) "prm1"
      ["definition"]=>
      string(13) "parameter one"
      ["val"]=>
      int(0)
    }
    [1]=>
    object(stdClass)#19 (3) {
      ["keyword"]=>
      string(4) "prm2"
      ["definition"]=>
      string(13) "parameter two"
      ["val"]=>
      int(1)
    }
    [2]=>
    object(stdClass)#20 (3) {
      ["keyword"]=>
      string(4) "prm3"
      ["definition"]=>
      string(15) "parameter three"
      ["val"]=>
      int(0)
    }
    [3]=>
    object(stdClass)#21 (3) {
      ["keyword"]=>
      string(4) "prm4"
      ["definition"]=>
      string(14) "parameter four"
      ["val"]=>
      int(1)
    }
  }
}
*/




/*
{
    "permissionId": "1",
    "appId": "1",
    "levelId": "1",
    "title": "developer",
    "description": "developer can do anything with super access to all over the system.",
    "appName": "Client Management System",
    "url": "http://aslsdfsdfk.com/asfsdf/sadfds",
    "sessAryName": "cms",
    "remark": "lorem imsem dolor sit amet",
    "accessList": [
        {
            "keyword": "prm1",
            "definition": "parameter one",
            "val": 0
        },
        {
            "keyword": "prm2",
            "definition": "parameter two",
            "val": 1
        },
        {
            "keyword": "prm3",
            "definition": "parameter three",
            "val": 0
        },
        {
            "keyword": "prm4",
            "definition": "parameter four",
            "val": 1
        }
    ]
}
*/




