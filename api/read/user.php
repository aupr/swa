<?php


httpRESTMethod::get(function (){
    authGuard("primeAccess", "manageUser");
    global $db;
    $user = $db->query("SELECT userId, name, dob, username, gender, religion, bloodgroup, address, jointime, blocked, phones, emails, designations, CONCAT('{\"levelId\":',level.levelId,',\"title\":\"',level.title,'\",\"description\":\"',level.description,'\"}') as userLevel FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"dgnId\":',dgn.dgnId,',\"fromTime\":\"',dgn.fromTime,'\",\"toTime\":\"',dgn.toTime,'\",\"title\":\"',dgn.title,'\"}')),']'),'[]') as designations FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"emailId\":',email.emailId,',\"emailType\":\"',email.emailType,'\",\"email\":\"',email.email,'\"}')),']'),'[]') as emails FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"phoneId\":',phone.phoneId,',\"phoneType\":\"',phone.phoneType,'\",\"number\":\"',phone.number,'\"}')),']'),'[]') as phones FROM user LEFT JOIN phone ON user.userId = phone.phoneUserId GROUP BY user.userId) as t1 LEFT JOIN email ON t1.userId=email.emailUserId GROUP BY t1.userId) as t2 LEFT JOIN dgn ON t2.userId=dgn.dgnUserId GROUP BY t2.userId) as t3 join level on level.levelId = t3.userLevelId");

    foreach ($user->rows as $key => $value) {
        $user->rows[$key]["phones"] = JSON_DECODE($user->rows[$key]["phones"]);
        $user->rows[$key]["emails"] = JSON_DECODE($user->rows[$key]["emails"]);
        $user->rows[$key]["designations"] = JSON_DECODE($user->rows[$key]["designations"]);
        $user->rows[$key]["userLevel"] = JSON_DECODE($user->rows[$key]["userLevel"]);
    }
    return $user->rows;
});

httpRESTMethod::post(function ($dt){
    authGuard("primeAccess", "manageUser");
    $userId = $dt->userId;
    global $db;
    $user = $db->query("SELECT userId, name, dob, username, gender, religion, bloodgroup, address, jointime, blocked, phones, emails, designations, CONCAT('{\"levelId\":',level.levelId,',\"title\":\"',level.title,'\",\"description\":\"',level.description,'\"}') as userLevel FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"dgnId\":',dgn.dgnId,',\"fromTime\":\"',dgn.fromTime,'\",\"toTime\":\"',dgn.toTime,'\",\"title\":\"',dgn.title,'\"}')),']'),'[]') as designations FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"emailId\":',email.emailId,',\"emailType\":\"',email.emailType,'\",\"email\":\"',email.email,'\"}')),']'),'[]') as emails FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"phoneId\":',phone.phoneId,',\"phoneType\":\"',phone.phoneType,'\",\"number\":\"',phone.number,'\"}')),']'),'[]') as phones FROM user LEFT JOIN phone ON user.userId = phone.phoneUserId GROUP BY user.userId) as t1 LEFT JOIN email ON t1.userId=email.emailUserId GROUP BY t1.userId) as t2 LEFT JOIN dgn ON t2.userId=dgn.dgnUserId GROUP BY t2.userId) as t3 join level on level.levelId = t3.userLevelId HAVING t3.userId=$userId");

    if($user->num_rows > 0) {
        $user->row["phones"] = JSON_DECODE($user->row["phones"]);
        $user->row["emails"] = JSON_DECODE($user->row["emails"]);
        $user->row["designations"] = JSON_DECODE($user->row["designations"]);
        $user->row["userLevel"] = JSON_DECODE($user->row["userLevel"]);
    }
    return $user->row;
});
