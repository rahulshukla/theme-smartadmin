<?php

/**
 * Head tags handler for the theme.
 *
 * @category  Theme
 * @package   ClearOS
 * @author    ClearFoundation <developer@clearfoundation.com>
 * @copyright 2014 ClearFoundation
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link      http://www.clearfoundation.com/docs/developer/theming/
 */

//////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
///////////////////////////////////////////////////////////////////////////////

/**
 * Returns additional <head> data required for the theme.
 *
 * @param string $nil not used anymore, ignore
 *
 * @return string HTML output
 */

function theme_page_head($nil)
{
    $theme_url = clearos_theme_url('smartadmin');
	$basepath = preg_replace('/\/core\/.*/', '', realpath(__FILE__));

    // The version is used to avoid upgrade/caching issues.  Bump when required.
    $version = '7.0.0';

    $theme_extras = '';

    // FIXME: review if statements below
	if (file_exists("$basepath/css/theme-extras.css"))
		$theme_extras .= "<link type='text/css' href='$theme_url/css/theme-extras.css?v=$version' rel='stylesheet'>\n";

	if (file_exists("$basepath/css/theme-organization.css"))
		$theme_extras .= "<link type='text/css' href='$theme_url/css/theme-organization.css?v=$version' rel='stylesheet'>\n";

	if (file_exists("$basepath/images/favicon-orange.ico"))
		$color = "orange";
	else
		$color = "green";

    // Note: <meta> tags are in the meta.php file

    return "
<!-- Basic Styles -->
<link rel='stylesheet' type='text/css' media='screen' href='$theme_url/css/bootstrap.min.css'>
<link rel='stylesheet' type='text/css' media='screen' href='$theme_url/css/font-awesome.min.css'>

<!-- SmartAdmin Styles -->
<link rel='stylesheet' type='text/css' media='screen' href='$theme_url/css/smartadmin-production.css'>
<link rel='stylesheet' type='text/css' media='screen' href='$theme_url/css/smartadmin-skins.css'>

<!-- Theme Customizations -->
<link rel='stylesheet' type='text/css' media='screen' href='$theme_url/css/theme.css'>
$theme_extras

<!-- FIXME Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
<link rel='stylesheet' type='text/css' media='screen' href='$theme_url/css/demo.css'>

<!-- FAVICONS -->
<link rel='shortcut icon' href='$theme_url/images/favicon-$color.ico' type='image/x-icon'>
<link rel='icon' href='$theme_url/images/favicon-$color.ico' type='image/x-icon'>

<!-- GOOGLE FONT -->
<!-- FIXME: review    link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700' -->
";
}
