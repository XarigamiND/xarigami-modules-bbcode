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
function bbcode_admin_new()
{   
    if(!xarSecurityCheck('EditBBCode')) return;
    if (!xarVarFetch('phase', 'str:1:100', $phase, 'form', XARVAR_NOT_REQUIRED, XARVAR_PREP_FOR_DISPLAY)) return;
    switch(strtolower($phase)) {
        case 'form':
        default:
            $data['menulinks'] = xarModAPIFunc('bbcode','admin','getmenulinks');        
            $data['authid']         = xarSecGenAuthKey();
            $data['submitlabel']    = xarML('Submit');
            $item = array();
            $item['module'] = 'bbcode';
            $item['itemtype'] = NULL; // forum
            $hooks = xarModCallHooks('item','new','',$item);
            if (empty($hooks)) {
                $data['hooks'] = '';
            } elseif (is_array($hooks)) {
                $data['hooks'] = join('',$hooks);
            } else {
                $data['hooks'] = $hooks;
            }
            break;
        case 'update':
            if (!xarVarFetch('code', 'str:1:100', $code)) return;
            if (!xarVarFetch('name', 'str:1:100', $name)) return;
            if (!xarVarFetch('description', 'str', $description, '', XARVAR_NOT_REQUIRED)) return;
            if (!xarVarFetch('transform', 'str', $transform, '', XARVAR_NOT_REQUIRED)) return;
            // Confirm authorisation code
            if (!xarSecConfirmAuthKey()) return;
            // The API function is called
            if (!xarModAPIFunc('bbcode',
                               'admin',
                               'create',
                               array('tag'     => $code,
                                     'name'     => $name,
                                     'description'  => $description,
                                     'transform'    => $transform))) return;
            xarResponseRedirect(xarModURL('bbcode', 'admin', 'view'));
            break;
    }
    // Return the output
    return $data;
}
?>