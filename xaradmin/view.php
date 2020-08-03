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
function bbcode_admin_view()
{
    // Security Check
    if(!xarSecurityCheck('EditBBCode')) return;
    if(!xarVarFetch('startnum', 'isset',    $startnum, 1,     XARVAR_NOT_REQUIRED)) {return;}
    $data['items'] = array();
    $data['menulinks'] = xarModAPIFunc('bbcode','admin','getmenulinks');
    // Specify some labels for display
    $data['authid'] = xarSecGenAuthKey();

    // The user API function is called
    $links = xarModAPIFunc('bbcode','user','getall',
                           array('startnum' => $startnum,
                                 'numitems' => xarModGetVar('bbcode',
                                                            'itemsperpage')));

    if (empty($links)) {
        $msg = xarML('There are no custom bbcode added.');
       throw new DataNotFoundException(null,$msg);
    }

    for ($i = 0; $i < count($links); $i++) {
        $link = $links[$i];

        $links[$i]['editurl'] = xarModURL('bbcode','admin', 'modify', array('id' => $link['id']));

        $links[$i]['deleteurl'] = xarModURL('bbcode',
                                              'admin',
                                              'delete',
                                              array('id' => $link['id'],
                                                    'confirmation' => 1,
                                                    'authid' => $data['authid']));

        $links[$i]['javascript'] = "return confirmLink(this, '" . xarML('Delete BBCode') . " $link[name] ?')";

    }

    // Add the array of items to the template variables
    $data['items'] = $links;
    // Return the template variables defined in this function
    return $data;
}
?>