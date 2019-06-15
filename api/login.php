<?php

httpRESTMethod::post(function ($pdt) {
    return login($pdt->username, $pdt->password);
});
