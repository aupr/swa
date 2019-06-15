<?php

httpRESTMethod::post(function ($pdt){
    //var_dump($pdt);
    global $db;
    $lastId = 0;
    $result = $db->query("INSERT INTO `app` (appName, url, sessAryName, remark) 
VALUES ('$pdt->appName', '$pdt->url', '$pdt->sessAryName', '$pdt->remark');");

    if ($result){
        $lastId = $db->getLastId();

        foreach ($pdt->accesses as $index=>$access){
            $result = $db->query("INSERT INTO `access` (accessAppId, keyword, definition, val) VALUES ('$lastId', '$access->keyword', '$access->definition', '$access->val');");
        }
    }

    return $result;
});


/*
object(stdClass)#17 (7) {
  ["appId"]=>
  NULL
  ["appName"]=>
  string(24) "Client Management System"
  ["url"]=>
  string(35) "http://aslsdfsdfk.com/asfsdf/sadfds"
  ["sessAryName"]=>
  string(3) "cms"
  ["remark"]=>
  string(26) "lorem imsem dolor sit amet"
  ["disabled"]=>
  string(1) "0"
  ["accesses"]=>
  array(4) {
    [0]=>
    object(stdClass)#18 (4) {
      ["accessId"]=>
      int(3)
      ["keyword"]=>
      string(4) "prm1"
      ["definition"]=>
      string(13) "parameter one"
      ["val"]=>
      int(0)
    }
    [1]=>
    object(stdClass)#19 (4) {
      ["accessId"]=>
      int(4)
      ["keyword"]=>
      string(4) "prm2"
      ["definition"]=>
      string(13) "parameter two"
      ["val"]=>
      int(0)
    }
    [2]=>
    object(stdClass)#20 (4) {
      ["accessId"]=>
      int(5)
      ["keyword"]=>
      string(4) "prm3"
      ["definition"]=>
      string(15) "parameter three"
      ["val"]=>
      int(1)
    }
    [3]=>
    object(stdClass)#21 (4) {
      ["accessId"]=>
      int(6)
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
    "appId": null,
    "appName": "Client Management System3",
    "url": "http://aslsdfsdfk.com/asfsdf/sadfds",
    "sessAryName": "cms3",
    "remark": "lorem imsem dolor sit amet",
    "disabled": "0",
    "accesses": [
        {
            "accessId": 3,
            "keyword": "prm1",
            "definition": "parameter one",
            "val": 0
        },
        {
            "accessId": 4,
            "keyword": "prm2",
            "definition": "parameter two",
            "val": 0
        },
        {
            "accessId": 5,
            "keyword": "prm3",
            "definition": "parameter three",
            "val": 1
        },
        {
            "accessId": 6,
            "keyword": "prm4",
            "definition": "parameter four",
            "val": 1
        }
    ]
}
*/
