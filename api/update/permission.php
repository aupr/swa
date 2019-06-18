<?php


httpRESTMethod::post(function ($pdt){
    var_dump($pdt);
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
  string(11) "developerxx"
["description"]=>
  string(70) "developer can do anything with super access to all over the system.xxx"
["appName"]=>
  string(27) "Client Management Systemxxx"
["url"]=>
  string(38) "xxxhttp://aslsdfsdfk.com/asfsdf/sadfds"
["sessAryName"]=>
  string(3) "cms"
["remark"]=>
  string(29) "xxxlorem imsem dolor sit amet"
["accessList"]=>
  array(3) {
    [0]=>
    object(stdClass)#18 (3) {
    ["keyword"]=>
      string(5) "pprm2"
    ["definition"]=>
      string(13) "parameter two"
    ["val"]=>
      int(0)
    }
    [1]=>
    object(stdClass)#19 (3) {
    ["keyword"]=>
      string(5) "pprm3"
["definition"]=>
      string(15) "parameter three"
["val"]=>
      int(1)
    }
    [2]=>
    object(stdClass)#20 (3) {
    ["keyword"]=>
      string(5) "pprm4"
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
    "title": "developerxx",
    "description": "developer can do anything with super access to all over the system.xxx",
    "appName": "Client Management Systemxxx",
    "url": "xxxhttp://aslsdfsdfk.com/asfsdf/sadfds",
    "sessAryName": "cms",
    "remark": "xxxlorem imsem dolor sit amet",
    "accessList": [
        {
            "keyword": "pprm2",
            "definition": "parameter two",
            "val": 0
        },
        {
            "keyword": "pprm3",
            "definition": "parameter three",
            "val": 1
        },
        {
            "keyword": "pprm4",
            "definition": "parameter four",
            "val": 1
        }
    ]
}
*/




