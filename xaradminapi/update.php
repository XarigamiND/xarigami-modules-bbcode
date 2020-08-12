<?php
/**
 *  BBCode
 *
 * Based on pnBBCode Hook from larsneo
 * http://www.pncommunity.de
 *
 * @package modules
 * @copyright (C) 2002-2005 The Digital Development Foundation
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 * @copyright (C) 2007-2011 2skies.com
 * @subpackage Xarigami BBCode
 * @link http://xarigami.com/project/
*/
/**
 * update
 * @param $args['id'] the ID of the code
 * @param $args['code'] the new code of the code
 * @param $args['name'] long name of the code
 * @param $args['description'] description
 * @param $args['transform'] transform
 */
function bbcode_adminapi_update($args)
{
    // Get arguments from argument array
    extract($args);
    // Argument check
    if ((!isset($id)) ||
        (!isset($tag)) ||
        (!isset($name))) {
        $msg = xarML('Invalid Parameter Count');
         throw new BadParameterException(null,$msg);
    }

    // The user API function is called
    $link = xarModAPIFunc('bbcode',
                          'user',
                          'get',
                          array('id' => $id));

    if ($link == false) {
        $msg = xarML('No Such :) Present');
         throw new DataNotFoundException(null,$msg);
    }

    // Security Check
    if(!xarSecurityCheck('EditBBCode')) return;

    // Get datbase setup
    $dbconn = xarDBGetConn();
    $xartable = xarDBGetTables();
    $table = $xartable['bbcode'];

    // Update the link
    $query = "UPDATE $table
            SET xar_tag    = ?,
                xar_name    = ?,
                xar_description = ?,
                xar_transformed = ?
            WHERE xar_id = ?";
    $bindvars = array($tag, $name, $description, $transform, $id);
    $result = $dbconn->Execute($query,$bindvars);
    if (!$result) return;

    xarModCallHooks('item', 'update', $id,
        array('itemtype' => '0', 'module' => 'bbcode'));

    // Let the calling process know that we have finished successfully
    return true;
}
?>
