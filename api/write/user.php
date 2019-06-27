<?php

httpRESTMethod::post(function ($pdt){
    global $db;
    $lastId=0;
    $password = md5($pdt->password);
    $result = $db->query("
INSERT INTO user 
(name, dob, username, password, gender, religion, bloodGroup, address, joinTime, userLevelId, primeAccessMod)
 VALUES 
 ('$pdt->name', '$pdt->dob', '$pdt->username', '$password', '$pdt->gender', '$pdt->religion', '$pdt->bloodGroup', '$pdt->address', '$pdt->joinTime', '$pdt->userLevelId', '[]')
 ");

    if ($result){
        $lastId = $db->getLastId();
        $sqlMultiQuery = "";
        foreach ($pdt->phones as $index=>$phone) {
            $sqlMultiQuery = "INSERT INTO `phone` (`phoneUserId`, `phoneType`, `number`) VALUES ('$lastId', '$phone->phoneType', '$phone->number'); ";
            $db->query($sqlMultiQuery);
        }

        foreach ($pdt->emails as $index=>$email) {
            $sqlMultiQuery = "INSERT INTO `email` (`emailUserId`, `emailType`, `email`) VALUES ('$lastId', '$email->emailType', '$email->email');";
            $db->query($sqlMultiQuery);
        }

        foreach ($pdt->designations as $index=>$designation){
            $sqlMultiQuery = "INSERT INTO `dgn` (`dgnUserId`, `fromTime`, `toTime`, `title`) VALUES ('$lastId', '$designation->fromTime', '$designation->toTime', '$designation->title');";
            $db->query($sqlMultiQuery);
        }
    }
    return $result;
});

/*object(stdClass)#17 (14) {
["userId"]=>
  NULL
  ["name"]=>
  string(5) "Admin"
["dob"]=>
  string(8) "76898786"
["username"]=>
  string(5) "admin"
["gender"]=>
  string(4) "Male"
["religion"]=>
  string(5) "Islam"
["bloodgroup"]=>
  string(2) "B+"
["address"]=>
  string(17) "Dhaka, Bangladesh"
["jointime"]=>
  string(7) "5454343"
["userLevelId"]=>
  string(1) "2"
["blocked"]=>
  string(1) "0"
["phones"]=>
  array(2) {
    [0]=>
    object(stdClass)#18 (3) {
    ["phoneId"]=>
      int(1)
      ["phoneType"]=>
      string(1) "h"
    ["number"]=>
      string(10) "0987654321"
    }
    [1]=>
    object(stdClass)#19 (3) {
    ["phoneId"]=>
      int(2)
      ["phoneType"]=>
      string(1) "p"
["number"]=>
      string(11) "34560345678"
    }
  }
  ["emails"]=>
  array(2) {
    [0]=>
    object(stdClass)#20 (3) {
    ["emailId"]=>
      int(1)
      ["emailType"]=>
      string(1) "h"
    ["email"]=>
      string(10) "haha@hjdsj"
    }
    [1]=>
    object(stdClass)#21 (3) {
    ["emailId"]=>
      int(2)
      ["emailType"]=>
      string(2) "yd"
["email"]=>
      string(12) "gjfgd@kjhkjf"
    }
  }
  ["designations"]=>
  array(2) {
    [0]=>
    object(stdClass)#22 (4) {
    ["dgnId"]=>
      int(1)
      ["fromTime"]=>
      string(8) "45643643"
    ["toTime"]=>
      string(8) "43446545"
    ["title"]=>
      string(8) "trdrertw"
    }
    [1]=>
    object(stdClass)#23 (4) {
    ["dgnId"]=>
      int(2)
      ["fromTime"]=>
      string(7) "3453254"
["toTime"]=>
      string(6) "345345"
["title"]=>
      string(9) "dfgsgfdfg"
    }
  }
}
null*/


///////////////////////////////////////////////////////////
/*
    {
        "userId": null,
        "name": "Aman Ullah",
        "dob": "76898786",
        "username": "aman",
        "password": "81dc9bdb52d04dc20036dbd8313ed055",
        "gender": "Male",
        "religion": "Islam",
        "bloodGroup": "B+",
        "address": "Dhaka, Bangladesh",
        "joinTime": "5454343",
        "userLevelId": "2",
        "blocked": "0",
        "phones": [
            {
                "phoneId": 1,
                "phoneType": "h",
                "number": "0987654321"
            },
            {
                "phoneId": 2,
                "phoneType": "p",
                "number": "34560345678"
            }
        ],
        "emails": [
            {
                "emailId": 1,
                "emailType": "h",
                "email": "haha@hjdsj"
            },
            {
                "emailId": 2,
                "emailType": "yd",
                "email": "gjfgd@kjhkjf"
            }
        ],
        "designations": [
            {
                "dgnId": 1,
                "fromTime": "45643643",
                "toTime": "43446545",
                "title": "trdrertw"
            },
            {
                "dgnId": 2,
                "fromTime": "3453254",
                "toTime": "345345",
                "title": "dfgsgfdfg"
            }
        ]
    }
 * */
