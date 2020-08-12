<?php

/**
 * Get one BBCode
 *
 * @return One BBCode's data, or false on failure
 */
function bbcode_userapi_get($args)
{
    extract($args);
    if(empty($id)) {
        throw new EmptyParameterException('$id');
    }
    $codes = xarModAPIFunc('bbcode',
        'user',
        'getall',
        array('id' => $id));

    if(is_array($codes) && count($codes) > 0) {
        return $codes[0];
    }
    return false;
}
?>
