<?php


httpRESTMethod::post(function ($pdt){
    global $db;
    $delete = $pdt->delete;
    $update = $pdt->update;

    // To update the main data
    $result = $db->query("
UPDATE `user` SET 
`name` = '$update->name', 
`dob` = '$update->dob', 
`gender` = '$update->gender', 
`religion` = '$update->religion', 
`bloodgroup` = '$update->bloodgroup', 
`address` = '$update->address', 
`jointime` = '$update->jointime', 
`userLevelId` = '$update->userLevelId', 
`blocked` = '$update->blocked' 
WHERE `user`.`userId` = $update->userId;
");

    // To update the array data
    foreach ($update->phones as $index=>$phone){
        if ($phone->phoneId != null){
            $result = $db->query("UPDATE `phone` SET `phoneType` = '$phone->phoneType', `number` = '$phone->number' WHERE `phone`.`phoneId` = $phone->phoneId;");
        } else {
            $result = $db->query("INSERT INTO `phone` (phoneUserId, phoneType, number) VALUES ('$update->userId', '$phone->phoneType', '$phone->number');");
        }
    }

    foreach ($update->emails as $index=>$email){
        if ($email->emailId != null){
            $result = $db->query("UPDATE `email` SET `emailType` = '$email->emailType', `email` = '$email->email' WHERE `email`.`emailId` = $email->emailId;");
        } else {
            $result = $db->query("INSERT INTO `email` (emailUserId, emailType, email) VALUES ('$update->userId', '$email->emailType', '$email->email');");
        }
    }

    foreach ($update->designations as $index=>$designation){
        if($designation->dgnId != null){
            $result = $db->query("UPDATE `dgn` SET `fromTime` = '$designation->fromTime', `toTime` = '$designation->toTime', `title` = '$designation->title' WHERE `dgn`.`dgnId`=$designation->dgnId;");
        } else {
            $result = $db->query("INSERT INTO `dgn` (dgnUserId, fromTime, toTime, title) VALUES ('$update->userId', '$designation->fromTime', '$designation->toTime', '$designation->title');");
        }
    }

    // To delete the data
    foreach ($delete->phones as $index=>$phone){
        $result = $db->query("DELETE FROM `phone` WHERE `phone`.`phoneId` = $phone->phoneId;");
    }
    foreach ($delete->emails as $index=>$email){
        $result = $db->query("DELETE FROM `email` WHERE `email`.`emailId` = $email->emailId;");
    }
    foreach ($delete->designations as $index=>$designation){
        $result = $db->query("DELETE FROM `dgn` WHERE `dgn`.`dgnId` = $designation->dgnId;");
    }

    return $result;
});

/*
object(stdClass)#17 (2) {
  ["delete"]=>
  object(stdClass)#18 (3) {
    ["phones"]=>
    array(0) {
    }
    ["emails"]=>
    array(0) {
    }
    ["designations"]=>
    array(0) {
    }
  }
  ["update"]=>
  object(stdClass)#19 (14) {
    ["userId"]=>
    string(1) "1"
    ["name"]=>
    string(9) "Developer"
    ["dob"]=>
    string(8) "56786456"
    ["username"]=>
    string(9) "developer"
    ["gender"]=>
    string(4) "Male"
    ["religion"]=>
    string(5) "Islam"
    ["bloodgroup"]=>
    string(2) "B+"
    ["address"]=>
    string(17) "Dhaka, Bangladesh"
    ["jointime"]=>
    string(7) "6568765"
    ["userLevelId"]=>
    string(1) "1"
    ["blocked"]=>
    string(1) "0"
    ["phones"]=>
    array(2) {
      [0]=>
      object(stdClass)#20 (3) {
        ["phoneId"]=>
        int(3)
        ["phoneType"]=>
        string(2) "uu"
        ["number"]=>
        string(8) "12345678"
      }
      [1]=>
      object(stdClass)#21 (3) {
        ["phoneId"]=>
        int(4)
        ["phoneType"]=>
        string(1) "p"
        ["number"]=>
        string(11) "45689034567"
      }
    }
    ["emails"]=>
    array(1) {
      [0]=>
      object(stdClass)#22 (3) {
        ["emailId"]=>
        int(3)
        ["emailType"]=>
        string(8) "Personal"
        ["email"]=>
        string(16) "als;kfjsd@sdfasd"
      }
    }
    ["designations"]=>
    array(1) {
      [0]=>
      object(stdClass)#23 (4) {
        ["dgnId"]=>
        int(3)
        ["fromTime"]=>
        string(7) "5653453"
        ["toTime"]=>
        string(6) "345345"
        ["title"]=>
        string(8) "engineer"
      }
    }
  }
}
 * */




/*
{
    "delete":{
    "phones":[],
		"emails":[],
		"designations":[
			{
                "dgnId":8
			}
			]
	},
	"update":{
    "userId": "1",
	    "name": "Mr. Developer",
	    "dob": "56786456",
	    "username": "developer",
	    "gender": "Malexxx",
	    "religion": "Islam xxx",
	    "bloodgroup": "B+ xx",
	    "address": "Dhaka, Bangladesh xx",
	    "jointime": "5555555",
	    "userLevelId": "1",
	    "blocked": "0",
	    "phones": [
	        {
                "phoneId": 3,
	            "phoneType": "new",
	            "number": "1111111111111"
	        },
	        {
                "phoneId": 4,
	            "phoneType": "new2",
	            "number": "2222222222"
	        }
	    ],
	    "emails": [
	        {
                "emailId": 3,
	            "emailType": "new",
	            "email": "aaaaaaaa@sdfasd"
	        }
	    ],
	    "designations": [
	        {
                "dgnId": 3,
	            "fromTime": "11111",
	            "toTime": "222222",
	            "title": "manager xxx"
	        }
	    ]
	}
}*/
