<?php

httpRESTMethod::get(function (){
    global $db;
    $level = $db->query("SELECT levelId, title, description, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"permissionId\":',permissionId,',\"appId\":',appId,',\"appName\":\"',appName,'\"}')),']'),'[]') as appList FROM (SELECT * FROM `level`LEFT JOIN permission ON level.levelId = permission.permissionLevelId) as t1 LEFT JOIN app on t1.permissionAppId=app.appId GROUP BY levelId");

    foreach ($level->rows as $key => $value) {
        $level->rows[$key]["appList"] = JSON_DECODE($level->rows[$key]["appList"]);
    }

    return $level->rows;
});

httpRESTMethod::post(function ($dt){
    $levelId = $dt->levelId;
    global $db;
    $level = $db->query("SELECT levelId, title, description, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"permissionId\":',permissionId,',\"appId\":',appId,',\"appName\":\"',appName,'\"}')),']'),'[]') as appList FROM (SELECT * FROM `level`LEFT JOIN permission ON level.levelId = permission.permissionLevelId) as t1 LEFT JOIN app on t1.permissionAppId=app.appId GROUP BY levelId HAVING levelId=$levelId");

    if ($level->num_rows) {
        $level->row["appList"] = JSON_DECODE($level->row["appList"]);
    }

    return $level->row;
});
