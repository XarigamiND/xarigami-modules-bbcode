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
/**
 * Add a standard screen upon entry to the module.
 *
 * @access public
 * @author John Cox
 * @return bool
 */
function bbcode_admin_main()
{
    // Security Check
    if(!xarSecurityCheck('EditBBCode')) return;
    xarResponseRedirect(xarModURL('bbcode', 'admin', 'modifyconfig'));
    // success
    return true;
}
?>