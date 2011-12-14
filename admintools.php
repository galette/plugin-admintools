<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Administration tools
 *
 * This page can be loaded directly, or via ajax.
 * Via ajax, we do not have a full html page, but only
 * that will be displayed using javascript on another page
 *
 * PHP version 5
 *
 * Copyright © 2011 The Galette Team
 *
 * This file is part of Galette (http://galette.tuxfamily.org).
 *
 * Galette is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Galette is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Galette. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  Plugins
 * @package   GalettePaypal
 * @author    Johan Cwiklinski <johan@x-tnd.be>
 * @copyright 2011 The Galette Team
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL License 3.0 or (at your option) any later version
 * @version   SVN: $Id: owners.php 556 2009-03-13 06:48:49Z trashy $
 * @link      http://galette.tuxfamily.org
 * @since     Available since 0.7dev - 2011-11-21
 */

$base_path = '../../';
require_once $base_path . 'includes/galette.inc.php';

//Constants and classes from plugin
require_once '_config.inc.php';

//restricted to superadmin only
if ( !$login->isSuperAdmin() ) {
    header('location: ' . $base_path . 'index.php');
    die();
}

$success = false;
if ( isset($_POST['convert_encoding']) ) {
    //proeceed data encoding conversion
    $zdb->convertToUTF(PREFIX_DB, true);
    $success = _T("Database should have been successfully converted to UTF-8!");
}

if ( isset($_POST['inittexts']) ) {
    //proceed mails texts reinitialization
    require_once $base_path . 'classes/texts.class.php';
    $texts = new Texts();
    $res = $texts->installInit(false);
    if ( $texts === true ) {
        $success_detected[] = _T("Texts has been successfully reinitialized.")
    }
}

//Set the path to the current plugin's templates,
//but backup main Galette's template path before
$orig_template_path = $tpl->template_dir;
$tpl->template_dir = 'templates/' . $preferences->pref_theme;
$tpl->compile_id = ADMINTOOLS_SMARTY_PREFIX;
//set util paths
$plugin_dir = basename(dirname($_SERVER['SCRIPT_NAME']));
$tpl->assign(
    'galette_url',
    'http://' . $_SERVER['HTTP_HOST'] .
    preg_replace(
        "/\/plugins\/" . $plugin_dir . '/',
        "/",
        dirname($_SERVER['SCRIPT_NAME'])
    )
);
$tpl->assign(
    'plugin_url',
    'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/'
);
$tpl->assign('page_title', _T("Administration tools"));
if ( $success !== false ) {
    $tpl->assign('success', $success);
}
$content = $tpl->fetch('admintools.tpl', ADMINTOOLS_SMARTY_PREFIX);
$tpl->assign('content', $content);
//Set path back to main Galette's template
$tpl->template_dir = $orig_template_path;
$tpl->display('page.tpl', ADMINTOOLS_SMARTY_PREFIX);
?>