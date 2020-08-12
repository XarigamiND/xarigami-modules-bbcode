<?php

/**
 * Get all BBCodes
 *
 * @return array of bbcodes, or false on failure
 */
function bbcode_userapi_getall($args)
{
    extract($args);

    // Optional arguments
    if (!isset($startnum)) {
        $startnum = 1;
    }
    if (!isset($numitems)) {
        $numitems = (-1);
    }

    // Security Check
    if(!xarSecurityCheck('OverviewBBCode')) {return;}

    $dbconn = xarDBGetConn();
    $xartable = xarDBGetTables();

    $bbcodestable = $xartable['bbcode'];

    // Extra where-clause conditions.
    $where = array();
    $bind = array();

    if (isset($id) && is_numeric($id))
    {
        $where[] = '(xar_id = ?)';
        $bind[] = $id;
    }

    if (isset($name))
    {
        $where[] = '(xar_name = ?)';
        $bind[] = (string)$name;
    }

    $where = implode(' AND ', $where);

    // Initialise.
    $codes = array();

    // Get BBCodes
    $query = 'SELECT xar_id, xar_tag, xar_name, xar_description, xar_transformed'
        . ' FROM ' . $bbcodestable
        . (!empty($where) ? ' where ' . $where : '')
        . ' ORDER BY xar_name';

    $result = $dbconn->SelectLimit($query, $numitems, $startnum-1, $bind);
    if (!$result) {return;}

    for (; !$result->EOF; $result->MoveNext()) {
        list(
            $id, $tag, $name, $desc, $transformed
        ) = $result->fields;
        if (xarSecurityCheck('OverviewBBCode', 0, 'All', $name.':'.$id)) {
            $codes[] = array(
                'id' => $id,
                'tag' => $tag,
                'name' => $name,
                'desc' => $desc,
                'transformed' => $transformed
            );
        }
    }

    $result->Close();

    return $codes;
}

?>
