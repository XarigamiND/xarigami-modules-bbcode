<?php
/**
 * Xaraya BBCode
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
 * delete
 * @param $args['id'] ID of the bbcode
 * @returns bool
 * @return true on success, false on failure
 */
function bbcode_adminapi_delete($args)
{
    // Get arguments from argument array
    extract($args);
    // Argument check
    if (!isset($id)) {
        $msg = xarML('Invalid Parameter Count');
         throw new BadParameterException(null,$msg);
    }
    // The user API function is called
    $smiley = xarModAPIFunc('bbcode', 'user', 'get',
                          array('id' => $id));
    if (empty($smiley)) {
        $msg = xarML('No code present');
        throw new DataNotFoundException(null,$msg);
    }
    // Security Check
    if(!xarSecurityCheck('EditBBCode')) return;
    // Get datbase setup
    $dbconn = xarDBGetConn();
    $xartable = xarDBGetTables();
    $table = $xartable['bbcode'];
    // Delete the item
    $query = "DELETE FROM $table
            WHERE xar_id = ?";
    $bindvars = array($id);
    $result = $dbconn->Execute($query,$bindvars);
    if (!$result) return;
    // Let any hooks know that we have deleted a link
    xarModCallHooks('item', 'delete', $id, '');
    // Let the calling process know that we have finished successfully
    return true;
}
?>