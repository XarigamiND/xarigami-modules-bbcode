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

/**
 * Overview displays standard Overview page
 *
 * Only used if you actually supply an overview link in your adminapi menulink function
 * and used to call the template that provides display of the overview
 *
 * @return array xarTplModule with $data containing template data
 * @since 2 Oct 2005
 */
function bbcode_admin_overview()
{
   /* Security Check */
    if (!xarSecurityCheck('EditBBCode')) return;

    $data=array();
    $data['menulinks'] = xarModAPIFunc('bbcode','admin','getmenulinks');
    /* if there is a separate overview function return data to it
     * else just call the main function that usually displays the overview
     */

    return xarTplModule('bbcode', 'admin', 'main', $data, 'main');
}

?>