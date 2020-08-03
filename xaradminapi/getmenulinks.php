<?php
/**
 * Xaraya BBCode
 *
 * Based on pnBBCode Hook from larsneo
 * http://www.pncommunity.de
 * Converted to Xaraya by John Cox
 *
 * @copyright (C) 2007,2008,2009 2skies.com
 * @subpackage Xarigami BBCode
 * @link http://xarigami.com/project/
*/
/**
 * utility function pass individual menu items to the admin panels
 *
 * @author the BBCode module development team
 * @return array containing the menulinks for the main menu items.
 */
function bbcode_adminapi_getmenulinks()
{
    // Security Check
    $menulinks = array();
    
    if (xarSecurityCheck('EditBBCode', 0)) {

        $menulinks[] = Array('url' => xarModURL('bbcode',
                'admin',
                'modifyconfig'),
            'title' => xarML('Modify the configuration for the bbcode module'),
            'label' => xarML('Modify Config'),
            'active' => array('modifyconfig'));
    }

    return $menulinks;
}
?>
