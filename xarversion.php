<?php
/**
 * Xaraya BBCode
 *
 * @package modules
 * @copyright (C) 2002-2008 The Digital Development Foundation
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 * @copyright (C) 2007-2012 2skies.com
 * @subpackage Xarigami BBCode
 * @link http://xarigami.com/project/
*/

$modversion['name']             = 'bbcode';
$modversion['directory']        = 'bbcode';
$modversion['id']               = '778';
$modversion['version']          = '2.1.0';
$modversion['displayname']      = 'BBCode';
$modversion['description']      = 'BBCode Hook';
$modversion['credits']          = 'xardocs/credits.txt';
$modversion['help']             = 'xardocs/help.txt';
$modversion['changelog']        = 'xardocs/changelog.txt';
$modversion['license']          = 'xardocs/license.txt';
$modversion['coding']           = 'xardocs/coding.txt';
$modversion['homepage']         = 'http://xarigami.com/project/bbcode';
$modversion['official']         = 1;
$modversion['author']           = 'John Cox';
$modversion['contact']          = 'admin@wyome.com';
$modversion['admin']            = 1;
$modversion['user']             = 0;
$modversion['class']            = 'Utility';
$modversion['category']         = 'Utilities';
$modversion['dependencyinfo']   = array(
                                    0 => array(
                                            'name' => 'core',
                                            'version_ge' => '1.4.0'
                                         ),
                                );

if (false) { //Load and translate once
    xarML('BBcode');
    xarML('BBCode Hook');
}
?>
