<?php

/**
 * Header handler for the theme.
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

//////////////////////////////////////////////////////////////////////////////
// P A G E  L A Y O U T
//////////////////////////////////////////////////////////////////////////////

function theme_page($page)
{
    if ($page['type'] == MY_Page::TYPE_CONFIGURATION)
        return _configuration_page($page);
    else if ($page['type'] == MY_Page::TYPE_WIDE_CONFIGURATION)
        return _wide_configuration_page($page);
    else if ($page['type'] == MY_Page::TYPE_REPORTS)
        return _report_page($page);
    else if ($page['type'] == MY_Page::TYPE_REPORT_OVERVIEW)
        return _report_overview_page($page);
    else if ($page['type'] == MY_Page::TYPE_SPOTLIGHT)
        return _spotlight_page($page);
    else if ($page['type'] == MY_Page::TYPE_DASHBOARD)
        return _dashboard_page($page);
    else if (($page['type'] == MY_Page::TYPE_SPLASH) || ($page['type'] == MY_Page::TYPE_SPLASH_ORGANIZATION))
        return _splash_page($page);
    else if ($page['type'] == MY_Page::TYPE_LOGIN)
        return _login_page($page);
    else if ($page['type'] == MY_Page::TYPE_WIZARD)
        return _wizard_page($page);
    else if ($page['type'] == MY_Page::TYPE_CONSOLE)
        return _console_page($page);
}

/**
 * Returns the configuration type page.
 *
 * @param array $page page data
 *
 * @return string HTML output
 */

function _configuration_page($page)
{
    $layout = 
        _get_header($page) .
        _get_left_menu($page) .
        _get_main_content($page)
    ;

    return $layout;
}

/**
 * Returns the wide configuration page.
 *
 * @param array $page page data   
 *
 * @return string HTML output
 */   

function _wide_configuration_page($page)
{
    echo "todo";
}

/**
 * Returns the report page.
 *
 * @param array $page page data   
 *
 * @return string HTML output
 */   

function _report_page($page)
{
    echo "todo";
}

/**
 * Returns the configuration type page.
 *
 * @param array $page page data
 *
 * @return string HTML output
 */

function _report_overview_page($page)
{
    echo "todo";
}

/**
 * Returns the dashboard page.
 *
 * @param array $page page data   
 *
 * @return string HTML output
 */   

function _dashboard_page($page)
{
    echo "todo";
}

/**
 * Returns the spotlight page.
 *
 * @param array $page page data   
 *
 * @return string HTML output
 */   

function _spotlight_page($page)
{
    echo "todo";
}

/**
 * Returns the login type page.
 *
 * @param array $page page data   
 *
 * @return string HTML output
 */   

function _login_page($page)
{
    echo "todo";
}

/**
 * Returns the splash page.
 *
 * @param array $page page data   
 *
 * @return string HTML output
 */   

function _splash_page($page)
{
    echo "todo";
}

/**
 * Returns the wizard page.
 *
 * @param array $page page data   
 *
 * @return string HTML output
 */   

function _wizard_page($page)
{
    echo "todo";
}

/**
 * Returns the console page.
 *
 * @param array $page page data   
 *
 * @return string HTML output
 */   

function _console_page($page)
{
    echo "todo";
}

//////////////////////////////////////////////////////////////////////////////
// L A Y O U T  H E L P E R S
//////////////////////////////////////////////////////////////////////////////

/**
 * Returns main content.
 * 
 * @param array $page page data
 *
 * @return string menu HTML output
 */

function _get_main_content($page)
{
    return "
        <div id='main'>     
            <!-- RIBBON -->
            <div id='ribbon'>
                <ol class='breadcrumb'>
                    <li>Category?</li>
                    <li>" . $page['title'] . "</li>
                </ol>
            </div>
            <div id='content'>
                <div id='theme-help-box-container'>
                    <div class='theme-help-box'>
                    " . $page['page_help'] . "
                    </div>
                </div>
                <div id='theme-sidebar-container'>
                    <div class='theme-sidebar-top'>
                    " . $page['page_summary'] . "
                    </div>
                    $report
                    <div class='theme-sidebar-bottom'></div>
                </div>
                <div id='theme-content-left'>
                    " . $page['app_view'] . "
                </div>
            </div>
        </div>
    ";
}

/**
 * Returns the header.
 *
 * @param array $page page data
 *
 * @return string banner HTML
 */

function _get_header($page, $menus = array())
{
    $theme_url = clearos_theme_url('smartadmin');

    return "
<!-- HEADER -->
<header id='header'>
    <!-- Logo -->
    <span id='logo'> <img src='$theme_url/img/logo.png' alt=''></span>


</header>
";
}


/**
 * Returns left panel menu
 * 
 * @param array $page page data
 *
 * @return string menu HTML output
 */

function _get_left_menu($page)
{
    $menu_data = $page['menus'];
    $spotlights = '';

    foreach ($menu_data as $url => $page) {

        // Spotlight pages (read: Dashboard and Marketplace)
        //--------------------------------------------------

        if ($page['category'] === lang('base_category_spotlight')) {
            $spotlights .= "\t\t\t<li class='active'>\n";
            $spotlights .= "\t\t\t\t<a href='" . $url . "' title='" . $page['title'] . "'><i class='fa fa-lg fa-fw fa-home'></i> <span class='menu-item-parent'>" . $page['title'] . "</span></a>\n";
            $spotlights .= "\t\t\t</li>\n";
            continue;
        }

        // Close out menus on transitions
        //-------------------------------

        $new_category = ($page['category'] == $current_category) ? FALSE : TRUE;
        $new_subcategory = ($page['subcategory'] == $current_subcategory) ? FALSE : TRUE;

        if (empty($main_apps)) {
            // do nothing
        } else if ($new_category && $new_subcategory) {
            // Cluse out subcategory and category
            $main_apps .= "\t\t\t\t\t\t</ul>\n";
            $main_apps .= "\t\t\t\t\t</li>\n";
            $main_apps .= "\t\t\t\t</ul>\n";
            $main_apps .= "\t\t\t</li>\n";
        } else if ($new_subcategory) {
            $main_apps .= "\t\t\t\t\t\t</ul>\n";
            $main_apps .= "\t\t\t\t\t</li>\n";
        }

        if ($page['category'] != $current_category) {
            $current_category = $page['category'];

            $main_apps .= "\t\t\t<li>\n";
            $main_apps .= "\t\t\t\t<a href='#'><i class='fa fa-lg fa-fw fa-folder-open'></i> <span class='menu-item-parent'>" . $page['category'] . "</span></a>\n";
            $main_apps .= "\t\t\t\t<ul>\n";
        }
        
        // Subcategory transition
        //-----------------------

        if ($current_subcategory != $page['subcategory']) {
            $current_subcategory = $page['subcategory'];

            $main_apps .= "\t\t\t\t\t<li>\n";
            $main_apps .= "\t\t\t\t\t\t<a href='#'><i class='fa fa-fw fa-folder-open'></i>" . $page['subcategory'] . "</a>\n";
            $main_apps .= "\t\t\t\t\t\t<ul>\n";
        }

        // App page
        //---------

        $main_apps .= "\t\t\t\t\t\t\t<li><a href='" . $url . "'>" . $page['title'] . "</a></li>\n";
    }

    // Close out open HTML tags
    //-------------------------

    $main_apps .= "\t\t\t\t\t\t</ul>\n";
    $main_apps .= "\t\t\t\t\t</li>\n";
    $main_apps .= "\t\t\t\t</ul>\n";
    $main_apps .= "\t\t\t</li>\n";

    return "
<!-- Navigation -->
<aside id='left-panel'>
    <nav>
        <ul>
$spotlights
$main_apps
        </ul>
    </nav>
</aside>
";
}
