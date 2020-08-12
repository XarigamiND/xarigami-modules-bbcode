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
 * create new
 * @param $args['code'] code of the item
 * @param $args['description'] used for the description of the bbcode
 * @param $args['transform'] used to test the item.
 * @returns int
 * @return ID on success, false on failure
 */
function bbcode_adminapi_create($args)
{
    // Get arguments from argument array
    extract($args);

    // Argument check - make sure that all required arguments are present,
    // if not then set an appropriate error message and return
    if ((!isset($tag)) ||
        (!isset($name))) {
        $msg = xarML('Invalid Parameter Count Create');
         throw new BadParameterException(null,$msg);
    }
    // Security Check
    if(!xarSecurityCheck('EditBBCode')) return;

    // Get datbase setup
    $dbconn = xarDBGetConn();
    $xartable = xarDBGetTables();
    $table = $xartable['bbcode'];
    // Get next ID in table
    $nextId = $dbconn->GenId($table);
    // Add item
    $query = "INSERT INTO $table (
              xar_id,
              xar_tag,
              xar_name,
              xar_description,
              xar_transformed)
            VALUES (
                  ?,
                  ?,
                  ?,
                  ?,
                  ?)";
    $bindvars = array($nextId, $tag, $name, $description, $transform);
    $result = $dbconn->Execute($query,$bindvars);
    if (!$result) return;
    // Get the ID of the item that we inserted
    $id = $dbconn->PO_Insert_ID($table, 'xar_id');
    // Let any hooks know that we have created a new link
    xarModCallHooks('item', 'create', $id,
        array('module' => 'bbcode', 'itemtype'   => 0));
    // Return the id of the newly created link to the calling process
    return $id;
}
?>
