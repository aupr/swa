<?php

httpRESTMethod::post(function ($pdt){
    //var_dump($pdt);
    global $db;
    $delete = $pdt->delete;
    $update = $pdt->update;

    $result = $db->query("
UPDATE `app` SET 
`appName` = '$update->appName', 
`url` = '$update->url', 
`sessAryName` = '$update->sessAryName', 
`remark` = '$update->remark', 
`disabled` = '$update->disabled' 
WHERE `app`.`appId` = $update->appId;
");

    foreach ($update->accesses as $index=>$access){
        if ($access->accessId != null){
            $result = $db->query("UPDATE `access` SET `keyword` = '$access->keyword', `definition` = '$access->definition', `val` = '$access->val' WHERE `access`.`accessId` = $access->accessId;");
        } else {
            $result = $db->query("INSERT INTO `access` (accessAppId, keyword, definition, val) VALUES ('$update->appId', '$access->keyword', '$access->definition', '$access->val');");
        }
    }

    // To delete the data
    foreach ($delete->accesses as $index=>$access){
        $result = $db->query("DELETE FROM `access` WHERE `access`.`accessId` = $access->accessId;");
    }

    return $result;
});


/*
object(stdClass)#17 (2) {
["delete"]=>
  object(stdClass)#18 (1) {
  ["accesses"]=>
    array(0) {
}
  }
  ["update"]=>
  object(stdClass)#19 (7) {
  ["appId"]=>
    string(1) "1"
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
      object(stdClass)#20 (4) {
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
      object(stdClass)#21 (4) {
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
      object(stdClass)#22 (4) {
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
      object(stdClass)#23 (4) {
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
}*/

/*
{
    "delete":{
    "accesses":[
			{"accessId":3}
		]
	},
	"update":{
    "appId": "1",
	    "appName": "Client Management Systemxxx",
	    "url": "xxxhttp://aslsdfsdfk.com/asfsdf/sadfds",
	    "sessAryName": "cms",
	    "remark": "xxxlorem imsem dolor sit amet",
	    "disabled": "0",
	    "accesses": [

	        {
                "accessId": 4,
	            "keyword": "pprm2",
	            "definition": "parameter two",
	            "val": 0
	        },
	        {
                "accessId": 5,
	            "keyword": "pprm3",
	            "definition": "parameter three",
	            "val": 1
	        },
	        {
                "accessId": 6,
	            "keyword": "pprm4",
	            "definition": "parameter four",
	            "val": 1
	        }
	    ]
	}
}
*/
