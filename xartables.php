<?php
/**
 * Xaraya BBCode
 *
 * @package modules
 * @copyright (C) 2002-2005 The Digital Development Foundation
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 * @copyright (C) 2007,2008,2009 2skies.com
 * @subpackage Xarigami BBCode
 * @link http://xarigami.com/project/
*/

function bbcode_xartables()
{
    // Initialise table array
    $xartable = array();
    $prefix = xarDBGetSiteTablePrefix();
    // Get the name for the autolinks item table
    $bbcode = $prefix . '_bbcode';
    // Set the table name
    $xartable['bbcode'] = $bbcode;
    // Return the table information
    return $xartable;
}
?>