<?php

httpRESTMethod::get(function (){
    global $db;
    $app = $db->query("SELECT app.appId, app.appName, app.url, app.sessAryName, app.remark, app.disabled, COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"accessId\":',access.accessId,',\"keyword\":\"',access.keyword,'\",\"definition\":\"',access.definition,'\",\"value\":',access.val,'}')),']'),'[]') as accesses FROM app LEFT JOIN access ON app.appId=access.accessAppId GROUP BY app.appId");

    foreach ($app->rows as $key => $value) {
        $app->rows[$key]["accesses"] = JSON_DECODE($app->rows[$key]["accesses"]);
    }

    return $app->rows;
});

httpRESTMethod::post(function ($dt){
    $appId = $dt->appId;
    global $db;
    $app = $db->query("SELECT app.appId, app.appName, app.url, app.sessAryName, app.remark, app.disabled COALESCE(CONCAT('[',GROUP_CONCAT(CONCAT('{\"accessId\":',access.accessId,',\"keyword\":\"',access.keyword,'\",\"definition\":\"',access.definition,'\",\"value\":',access.val,'}')),']'),'[]') as accesses FROM app LEFT JOIN access ON app.appId=access.accessAppId GROUP BY app.appId HAVING app.appId=$appId");

    if ($app->num_rows) {
        $app->row["accesses"] = JSON_DECODE($app->row["accesses"]);
    }

    return $app->row;
});
