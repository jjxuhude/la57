<?php
function adminUrl($path = null, $parameters = [], $secure = null){
    $path = config('app.backend_prefix').'/'.$path;
    return url($path,$parameters,$secure);
}
