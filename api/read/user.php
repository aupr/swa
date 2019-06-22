<?php
authGuard("primeAccess", "manageUser");

httpRESTMethod::get(function (){
    global $db;
    $user = $db->query("SELECT userId, name, dob, username, gender, religion, bloodgroup, address, jointime, userLevelId, blocked, phones, emails, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"dgnId\":',dgn.dgnId,',\"fromTime\":\"',dgn.fromTime,'\",\"toTime\":\"',dgn.toTime,'\",\"title\":\"',dgn.title,'\"}')),']'),'[]') as designations FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"emailId\":',email.emailId,',\"emailType\":\"',email.emailType,'\",\"email\":\"',email.email,'\"}')),']'),'[]') as emails FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"phoneId\":',phone.phoneId,',\"phoneType\":\"',phone.phoneType,'\",\"number\":\"',phone.number,'\"}')),']'),'[]') as phones FROM user LEFT JOIN phone ON user.userId = phone.phoneUserId GROUP BY user.userId) as t1 LEFT JOIN email ON t1.userId=email.emailUserId GROUP BY t1.userId) as t2 LEFT JOIN dgn ON t2.userId=dgn.dgnUserId GROUP BY t2.userId");

    foreach ($user->rows as $key => $value) {
        $user->rows[$key]["phones"] = JSON_DECODE($user->rows[$key]["phones"]);
        $user->rows[$key]["emails"] = JSON_DECODE($user->rows[$key]["emails"]);
        $user->rows[$key]["designations"] = JSON_DECODE($user->rows[$key]["designations"]);
    }
    return $user->rows;
});

httpRESTMethod::post(function ($dt){
    $userId = $dt->userId;
    global $db;
    $user = $db->query("SELECT userId, name, dob, username, gender, religion, bloodgroup, address, jointime, userLevelId, blocked, phones, emails, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"dgnId\":',dgn.dgnId,',\"fromTime\":\"',dgn.fromTime,'\",\"toTime\":\"',dgn.toTime,'\",\"title\":\"',dgn.title,'\"}')),']'),'[]') as designations FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"emailId\":',email.emailId,',\"emailType\":\"',email.emailType,'\",\"email\":\"',email.email,'\"}')),']'),'[]') as emails FROM (SELECT *, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"phoneId\":',phone.phoneId,',\"phoneType\":\"',phone.phoneType,'\",\"number\":\"',phone.number,'\"}')),']'),'[]') as phones FROM user LEFT JOIN phone ON user.userId = phone.phoneUserId GROUP BY user.userId) as t1 LEFT JOIN email ON t1.userId=email.emailUserId GROUP BY t1.userId) as t2 LEFT JOIN dgn ON t2.userId=dgn.dgnUserId GROUP BY t2.userId HAVING t2.userId=$userId");

    if($user->num_rows > 0) {
        $user->row["phones"] = JSON_DECODE($user->row["phones"]);
        $user->row["emails"] = JSON_DECODE($user->row["emails"]);
        $user->row["designations"] = JSON_DECODE($user->row["designations"]);
    }
    return $user->row;
});
