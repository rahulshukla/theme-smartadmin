<?php

/**
 * Default scripts for the theme.
 *
 * These scripts are added just before the closing </body> tag.
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
 * @return string HTML output
 */

function theme_page_javascript()
{
    $theme_url = clearos_theme_url('smartadmin');

    // The version is used to avoid upgrade/caching issues.  Bump when required.
    $version = '7.0.0';

    // FIXME: review all of these
    return "

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ \"restartOnRequestAfter\": true }' src='$theme_url/js/plugin/pace/pace.min.js'></script>

<script type='text/javascript' src='$theme_url/js/libs/jquery-2.0.2.min.js'></script>
<script type='text/javascript' src='$theme_url/js/libs/jquery-ui-1.10.3.min.js'></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
<script src='$theme_url/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js'></script> -->

<!-- BOOTSTRAP JS -->
<script src='$theme_url/js/bootstrap/bootstrap.min.js'></script>

<!-- CUSTOM NOTIFICATION -->
<script src='$theme_url/js/notification/SmartNotification.min.js'></script>

<!-- JARVIS WIDGETS -->
<script src='$theme_url/js/smartwidgets/jarvis.widget.min.js'></script>

<!-- EASY PIE CHARTS -->
<script src='$theme_url/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js'></script>

<!-- SPARKLINES -->
<script src='$theme_url/js/plugin/sparkline/jquery.sparkline.min.js'></script>

<!-- JQUERY VALIDATE -->
<script src='$theme_url/js/plugin/jquery-validate/jquery.validate.min.js'></script>

<!-- JQUERY MASKED INPUT -->
<script src='$theme_url/js/plugin/masked-input/jquery.maskedinput.min.js'></script>

<!-- JQUERY SELECT2 INPUT -->
<script src='$theme_url/js/plugin/select2/select2.min.js'></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src='$theme_url/js/plugin/bootstrap-slider/bootstrap-slider.min.js'></script>

<!-- browser msie issue fix -->
<script src='$theme_url/js/plugin/msie-fix/jquery.mb.browser.min.js'></script>

<!-- FastClick: For mobile devices -->
<script src='$theme_url/js/plugin/fastclick/fastclick.js'></script>

<!--[if IE 7]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- Demo purpose only -->
<script src='$theme_url/js/demo.js'></script>

<!-- MAIN APP JS FILE -->
<script src='$theme_url/js/app.js'></script>

<!-- Custom Javascript -->
<script type='text/javascript' src='$theme_url/js/theme.js?v=$version'></script>
";
}
