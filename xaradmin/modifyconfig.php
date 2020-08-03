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
 * modify configuration
 */
function bbcode_admin_modifyconfig()
{
    // Security Check
    if (!xarSecurityCheck('EditBBCode')) return;
    if (!xarVarFetch('phase', 'str:1:100', $phase, 'modify', XARVAR_NOT_REQUIRED)) return;

    //Set Data Array
    $data                   = array();
    $data['menulinks'] = xarModAPIFunc('bbcode','admin','getmenulinks');
    switch (strtolower($phase)) {
        case 'modify':
        default:

            $data['authid']         = xarSecGenAuthKey();
            $data['submitlabel']    = xarML('Submit');
            $data['dolinebreak']    = xarModGetVar('bbcode', 'dolinebreak');
            $data['transformtype']  = xarModGetVar('bbcode', 'transformtype');
            $data['magiclink']      = xarModGetVar('bbcode', 'magiclink');
            // Call Modify Config Hooks
            $hooks = xarModCallHooks('module',
                                     'modifyconfig',
                                     'bbcode',
                                     array('module'     => 'bbcode',
                                           'itemtype'   => 0));

            if (empty($hooks)) {
                $hooks = array();
            }

            $data['hooks'] = $hooks;
            break;

        case 'update':
            if (!xarVarFetch('dolinebreak', 'checkbox', $dolinebreak, false)) return;
            if (!xarVarFetch('magiclink', 'checkbox', $magiclink, true)) return;
            if (!xarVarFetch('transformtype', 'checkbox', $transformtype, true)) return;
            if (!xarVarFetch('advancedbbcode', 'checkbox', $advancedbbcode, false, XARVAR_NOT_REQUIRED)) return;
            // Confirm authorisation code
            if (!xarSecConfirmAuthKey()) return;
            // Update module variables

            xarModSetVar('bbcode', 'transformtype', $transformtype);
            xarModSetVar('bbcode', 'dolinebreak', $dolinebreak);
            xarModSetVar('bbcode', 'useadvanced', $advancedbbcode);
            xarModSetVar('bbcode', 'magiclink', $magiclink);
            // Call Update Config Hooks
            xarModCallHooks('module',
                            'updateconfig',
                            'bbcode',
                            array('module'      => 'bbcode',
                                  'itemtype'    => 0));
            $msg = xarML('Configuration settings updated.');
            xarTplSetMessage($msg,'status');
            xarResponseRedirect(xarModURL('bbcode', 'admin', 'modifyconfig'));
            // Return
            return true;
            break;
    }
    return $data;
}
?>