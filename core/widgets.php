<?php

/**
 * Widgets handler for the ClearOS theme.
 *
 * @category  Theme
 * @package   ClearOS
 * @author    ClearFoundation <developer@clearfoundation.com>
 * @copyright 2011-2012 ClearFoundation
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

///////////////////////////////////////////////////////////////////////////////
// A N C H O R S
///////////////////////////////////////////////////////////////////////////////

/**
 * Anchor widget.
 *
 * Supported options:
 * - id 
 *
 * Classes:
 * - theme-anchor-add
 * - theme-anchor-cancel
 * - theme-anchor-delete
 * - theme-anchor-edit
 * - theme-anchor-next
 * - theme-anchor-ok
 * - theme-anchor-previous
 * - theme-anchor-view
 * - theme-anchor-custom (button with custom text)
 * - theme-anchor-dialog (button that pops up a javascript dialog box)
 * - theme-anchor-javascript (button that does some other javascript action)
 *
 * Options:
 * - state: enabled/disabled
 * - target: href target (when enabled only)
 * - tabindex: tabindex for the anchor
 * 
 * @param string $url        URL
 * @param string $text       anchor text
 * @param string $importance importance of the button ('high' or 'low')
 * @param string $class      CSS class
 * @param array  $options    options
 *
 * @return HTML for anchor
 */

function theme_anchor($url, $text, $importance, $class, $options)
{
    $importance_class = ($importance === 'high') ? 'theme-anchor-important' : 'theme-anchor-unimportant';

    $id = isset($options['id']) ? ' id=' . $options['id'] : '';
    if (!isset($options['no_escape_html']) || $options['no_escape_html'] == FALSE)
        $text = htmlspecialchars($text, ENT_QUOTES);
    $target = isset($options['target']) ? " target='" . $options['target'] . "'" : ''; 
    $tabindex = isset($options['tabindex']) ? " tabindex='" . $options['tabindex'] . "'" : '';

    // TODO: Aaron, I added the option of having a "disabled" anchor... hack is below.
    if (isset($options['state']) && ($options['state'] === FALSE))
        return  "<input disabled type='submit' name='' $id value='$text' class='ui-corner-all $class $importance_class' $tabindex />\n";
    else
        return "<a href='$url'$id class='theme-anchor $class $importance_class'$target$tabindex>$text</a>";
}

function theme_anchor_dialog($url, $text, $importance, $class, $options)
{
    $importance_class = ($importance === 'high') ? 'theme-anchor-important' : 'theme-anchor-unimportant';

    $id = isset($options['id']) ? ' id=' . $options['id'] : '';
    $text = htmlspecialchars($text, ENT_QUOTES);

    return "<a href='$url'$id class='theme-anchor $class $importance_class'>$text</a>
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#" . $options['id'] . "_message').dialog({
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    closeOnEscape: true,
                    width: 400,
                    open: function(event, ui) {
                    },
                    close: function(event, ui) {
                    }
                });
            });
            $('a#" . $options['id'] . "').click(function (e) {
                e.preventDefault();
                $('#" . $options['id'] . "_message').dialog('open');
            });
        </script>
";
}

///////////////////////////////////////////////////////////////////////////////
// B U T T O N S
///////////////////////////////////////////////////////////////////////////////

/**
 * Button widget.
 *
 * Supported options:
 * - id 
 *
 * Classes:
 * - theme-form-add
 * - theme-form-delete
 * - theme-form-disable
 * - theme-form-next
 * - theme-form-ok
 * - theme-form-previous
 * - theme-form-update
 * - theme-form-custom (button with custom text)
 *
 * Options:
 * - state: enabled/disabled
 * - tabindex: tabindex for the button
 *
 * @param string $name       button name,
 * @param string $text       text to be shown on the anchor
 * @param string $importance prominence of the button
 * @param string $class      CSS class
 * @param array  $options    options
 *
 * @return HTML for button
 */

function theme_form_submit($name, $text, $importance, $class, $options)
{
    $importance_class = ($importance === 'high') ? 'theme-form-important' : 'theme-form-unimportant';

    $id = isset($options['id']) ? ' id=' . $options['id'] : '';
    $text = htmlspecialchars($text, ENT_QUOTES);
    $tabindex = isset($options['tabindex']) ? " tabindex='" . $options['tabindex'] . "'" : '';

    return "<input type='submit' name='$name'$id value='$text' class='ui-corner-all $class $importance_class$tabindex' />\n";
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D S E T S
///////////////////////////////////////////////////////////////////////////////

/**
 * Field set header.
 *
 * @param string $title   title
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_fieldset_header($title, $options)
{
    $id = isset($options['id']) ? ' id=' . $options['id'] : '';
    return "<tr$id><td class='theme-fieldset-header' colspan='2'>$title</td></tr>";
}

/**
 * Field set footer.
 *
 * @return string HTML
 */

function theme_fieldset_footer()
{
    return "";
}

///////////////////////////////////////////////////////////////////////////////
// A N C H O R  A N D  B U T T O N  S E T S
///////////////////////////////////////////////////////////////////////////////

/**
 * Button set.
 *
 * Supported options:
 * - id 
 *
 * @param array  $buttons list of buttons in HTML format
 * @param array  $options options
 * @param string $type    button set type
 *
 * @return string HTML for button set
 */

function theme_button_set($buttons, $options = array())
{
    return _theme_button_set($buttons, $options, 'normal');
}

/**
 * Field button set.
 *
 * This is the same as a button set, but used in a form with fields.
 *
 * Supported options:
 * - id 
 *
 * @param array  $buttons list of buttons in HTML format
 * @param array  $options options
 *
 * @return string HTML for field button set
 */

function theme_field_button_set($buttons, $options = array())
{
    return _theme_button_set($buttons, $options, 'field');
}

/**
 * Internal button set handler.
 *
 * Supported options:
 * - id 
 *
 * @param array  $buttons list of buttons in HTML format
 * @param array  $options options
 * @param string $type    button set type
 *
 * @access private
 * @return string HTML for button set
 */

function _theme_button_set($buttons, $options, $type)
{
    $id = isset($options['id']) ? ' id=' . $options['id'] : '';

    $button_html = '';

    $button_total = count($buttons);
    $count = 0;

    foreach ($buttons as $button) {
        $implant_first = '';
        $implant_middle = '';
        $implant_last = '';
        $count++;

        if ($count === 1)
            $implant_first = 'theme-button-set-first ';

        if ($count === $button_total)
            $implant_last = 'theme-button-set-last ';

        if (($count !== 1) && ($count !== $button_total))
            $implant_middle = 'theme-button-set-middle ';

        // KLUDGE: implant button set order
        $button = preg_replace("/class='/", "class='$implant_first$implant_middle$implant_last", $button);
        $button_html .= "\n" . trim($button);
    }

    if ($type === 'field') {
        return "
            <tr><td colspan='2'>
                <div class='theme-button-set'$id>$button_html</div>
            </td></tr>
        ";
    } else {
        return "
            <div class='theme-button-set'$id>$button_html</div>
        ";
    }
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D  V I E W
///////////////////////////////////////////////////////////////////////////////

/**
 * Text input field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 *
 * @param string $label    label for text input field
 * @param string $text     text shown
 * @param string $name     name of text input element
 * @param string $value    value of text input 
 * @param string $input_id input ID
 * @param array  $options  options
 *
 * @return string HTML for field view
 */

function theme_field_view($label, $text, $name = NULL, $value = NULL, $input_id = NULL, $options = NULL)
{
    if (is_null($input_id))
        $input_id = 'clearos_' . mt_rand();

    if (is_null($name))
        $name = 'clearos_' . mt_rand();

    if (is_null($value))
        $value = '';

    if (is_bool($text)) {
        if ($text)
            $text = "<div class='theme-field-checkbox-enabled'></div>";
        else
            $text = '-';
    }
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $input_id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $input_id . '_label';
    $text_id_html = (isset($options['text_id'])) ? $options['text_id'] : $input_id . '_text';
    $hide_field = (isset($options['hide_field'])) ? ' theme-hidden' : '';

    $input_html = "<input type='hidden' name='$name' value='$value' id='$input_id'>";

    return "
        <tr id='$field_id_html' class='theme-fieldview" . $hide_field . "'>
            <td class='theme-field-left'><label for='$input_id' id='$label_id_html'>$label</label></td>
            <td class='theme-field-right'><span id='$text_id_html'>$text</span>$input_html</td>
        </tr>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D  I N P U T
///////////////////////////////////////////////////////////////////////////////

/**
 * Text input field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 * - error_id 
 *
 * @param string $name     name of text input element
 * @param string $value    value of text input 
 * @param string $label    label for text input field
 * @param string $error    validation error message
 * @param string $input_id input ID
 * @param array  $options  options
 *
 * @return string HTML
 */

function theme_field_input($name, $value, $label, $error, $input_id, $options = NULL)
{
    return _theme_field_input_password($name, $value, $label, $error, $input_id, $options, 'text');
}

/**
 * Common text/password input field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 * - error_id 
 *
 * @access private
 * @param string $name     name of text input element
 * @param string $value    value of text input 
 * @param string $label    label for text input field
 * @param string $error    validation error message
 * @param string $input_id input ID
 * @param array  $options  options
 *
 * @return string HTML
 */

function _theme_field_input_password($name, $value, $label, $error, $input_id, $options = NULL, $type)
{
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $input_id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $input_id . '_label';
    $error_id_html = (isset($options['error_id'])) ? $options['error_id'] : $input_id . '_error';
    $hide_field = (isset($options['hide_field'])) ? ' theme-hidden' : '';
    $style = '';
    if (isset($options['width']))
        $style .= 'width: ' . $options['width'] . '; ';

    $error_html = (empty($error)) ? "" : "<br/><span class='theme-validation-error' id='$error_id_html'>$error</span>";

    return "
        <tr id='$field_id_html' class='theme-field-$type" . $hide_field . "'>
            <td class='theme-field-left'><label for='$input_id' id='$label_id_html'>$label</label></td>
            <td class='theme-field-right'> <input type='$type' name='$name' value='$value' id='$input_id' style='$style'> $error_html</td>
        </tr>
    ";
}

/**
 * File upload input field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 * - error_id 
 *
 * @param string $name     name of text input element
 * @param string $value    value of text input 
 * @param string $label    label for text input field
 * @param string $error    validation error message
 * @param string $input_id input ID
 * @param array  $options  options
 *
 * @return string HTML
 */

function theme_field_file($name, $value, $label, $error, $input_id, $options = NULL)
{
    return _theme_field_input_password($name, $value, $label, $error, $input_id, $options, 'file');
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D  P A S S W O R D
///////////////////////////////////////////////////////////////////////////////

/**
 * Password input field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 * - error_id 
 *
 * @param string $name     name of pasword input element
 * @param string $value    value of pasword input 
 * @param string $label    label for pasword input field
 * @param string $error    validation error message
 * @param string $input_id input ID
 * @param array  $options  options
 *
 * @return string HTML
 */

function theme_field_password($name, $value, $label, $error, $input_id, $options = NULL)
{
    return _theme_field_input_password($name, $value, $label, $error, $input_id, $options, 'password');
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D  D R O P D O W N
///////////////////////////////////////////////////////////////////////////////

/**
 * Dropdown field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 * - error_id 
 *
 * @param string $name     name of dropdown element
 * @param string $value    value of dropdown 
 * @param string $label    label for dropdown field
 * @param string $error    validation error message
 * @param array  $values    hash list of values for dropdown
 * @param string $input_id input ID
 * @param array  $options  options
 *
 * @return string HTML
 */

function theme_field_dropdown($name, $value, $label, $error, $values, $input_id, $options)
{
    $input_id_html = " id='" . $input_id . "'";
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $input_id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $input_id . '_label';
    $error_id_html = (isset($options['error_id'])) ? $options['error_id'] : $input_id . '_error';

    $error_html = (empty($error)) ? "" : "<br><span class='theme-validation-error' id='$error_id_html'>$error</span>";

    return "
        <tr id='$field_id_html' class='theme-field-dropdown'>
            <td class='theme-field-left'><label for='$input_id' id='$label_id_html'>$label</label></td>
            <td class='theme-field-right'>" . form_dropdown($name, $values, $value, $input_id_html) . " $error_html</td>
        </tr>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D  M U L T I S E L E C T  D R O P D O W N
///////////////////////////////////////////////////////////////////////////////

/**
 * Dropdown field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 * - error_id 
 *
 * @param string  $name     name of dropdown element
 * @param string  $value    value of dropdown 
 * @param string  $label    label for dropdown field
 * @param string  $error    validation error message
 * @param array   $values   hash list of values for dropdown
 * @param string  $input_id input ID
 * @param array   $options  options
 *
 * @return string HTML
 */

function theme_field_multiselect_dropdown($name, $value, $label, $error, $values, $input_id, $options)
{
    $input_id_html = " id='" . $input_id . "'";
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $input_id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $input_id . '_label';
    $error_id_html = (isset($options['error_id'])) ? $options['error_id'] : $input_id . '_error';

    $error_html = (empty($error)) ? "" : "<span class='theme-validation-error' id='$error_id_html'>$error</span>";

    return "
        <tr id='$field_id_html' class='theme-multiselect-dropdown'>
            <td class='theme-field-left'><label for='$input_id' id='$label_id_html'>$label</label></td>
            <td class='theme-field-right'>" . form_multiselect($name, $values, $value, $input_id_html) . " $error_html</td>
        </tr>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D  T O G G L E
///////////////////////////////////////////////////////////////////////////////

/**
 * Enable/disable toggle field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 * - error_id 
 *
 * @param string $name     name of toggle input element
 * @param string $value    value of toggle input 
 * @param string $label    label for toggle input field
 * @param string $error    validation error message
 * @param array  $values    hash list of values for dropdown
 * @param string $input_id input ID
 * @param array  $options  options
 *
 * @return string HTML
 */

function theme_field_toggle_enable_disable($name, $selected, $label, $error, $values, $input_id, $options)
{
    $input_id_html = " id='" . $input_id . "'";
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $input_id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $input_id . '_label';
    $error_id_html = (isset($options['error_id'])) ? $options['error_id'] : $input_id . '_error';

    $error_html = (empty($error)) ? "" : "<span class='theme-validation-error' id='$error_id_html'>$error</span>";

    return "
        <tr id='$field_id_html' class='theme-field-toggle'>
            <td class='theme-field-left'><label for='$input_id' id='$label_id_html'>$label</label></td>
            <td class='theme-field-right'>" . form_dropdown($name, $values, $selected, $input_id_html) . " $error_html </td>
        </tr>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D  C H E C K B O X E S 
///////////////////////////////////////////////////////////////////////////////

/**
 * Checkbox field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 * - error_id 
 *
 * @param string $name     name of checkbox element
 * @param string $value    value of checkbox 
 * @param string $label    label for checkbox field
 * @param string $error    validation error message
 * @param string $input_id input ID
 * @param array  $options  options
 *
 * @return string HTML
 */

function theme_field_checkbox($name, $value, $label, $error, $input_id, $options)
{
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $input_id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $input_id . '_label';

    $select_html = ($value) ? ' checked' : '';

    return "
        <tr id='$field_id_html' class='theme-field-checkboxes'>
            <td class='theme-field-left'><label for='$input_id' id='$label_id_html'>$label</label></td>
          <td class='theme-field-right check'>  <input type='checkbox' name='$name' id='$input_id' $select_html></td>
        </tr>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D  T E X T A R E A
///////////////////////////////////////////////////////////////////////////////

/**
 * Text area field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 * - error_id 
 *
 * @param string $name     name of text area element
 * @param string $value    value of text area
 * @param string $label    label for text area field
 * @param string $error    validation error message
 * @param string $input_id input ID
 * @param array  $options  options
 *
 * @return string HTML
 */

function theme_field_textarea($name, $value, $label, $error, $input_id, $options = NULL)
{
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $input_id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $input_id . '_label';
    $hide_field = (isset($options['hide_field'])) ? ' theme-hidden' : '';

    $error_html = (empty($error)) ? "" : "<br/><span class='theme-validation-error' id='$error_id_html'>$error</span>";

    return "
        <tr id='$field_id_html' class='theme-field-textarea" . $hide_field . "'>
            <td class='theme-field-left'><label for='$input_id' id='$label_id_html'>$label</label></td>
            <td class='theme-field-right theme-field-textarea-box'> <textarea name='$name' id='$input_id'>$value</textarea>$error_html</td>
        </tr>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// F I E L D  R A D I O  S E T S
///////////////////////////////////////////////////////////////////////////////

/**
 * Display radio sets.
 *
 * Supported options:
 * - id 
 *
 * @param array  $radios  list of radios in HTML format
 * @param array  $options options
 *
 * @return string HTML for field radio set
 */

function theme_field_radio_set($title, $radios, $options = array())
{
    $output = '';
    $count = 0;

    if ($options['orientation'] == 'horizontal') 
        $output .= "<tr><td colspan='2'><table border='0' cellpadding='0' cellspacing='0' style='width: 75%' align='center'><tr>";

    foreach ($radios as $radio) {
        $output .= $radio;
        $count++;

        if (($options['orientation'] == 'horizontal') && ($count < count($radios)))
            $output .= "<td width='100'>&nbsp;</td>";
    }

    if ($options['orientation'] == 'horizontal') 
        $output .= '</tr></table><td></tr>';

    return $output;
}

/**
 * Return radio set items.
 *
 * @param string $name      name of text input element
 * @param string $group     button group
 * @param string $label     label for text input field
 * @param string $checked   checked flag
 * @param string $read_only read only flag
 * @param array  $options   options
 *
 */

function theme_field_radio_set_item($name, $group, $label, $checked, $error, $input_id, $options)
{
    // TODO: this is only used in the install wizard right now and is incomplete
    $input_id_html = " id='" . $input_id . "'";
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $input_id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $input_id . '_label';
    $error_id_html = (isset($options['error_id'])) ? $options['error_id'] : $input_id . '_error';
    $select_html = ($checked) ? ' checked' : '';

    $error_html = (empty($error)) ? "" : "<span class='theme-validation-error' id='$error_id_html'>$error</span>";

    $image = ($options['image']) ? "<img src='" . $options['image'] . "' alt='' style='margin: 5px'><br>" : '';
    $label_help = ($options['label_help']) ? $options['label_help'] : '';
    $orientation = (isset($options['orientation'])) ? $options['orientation'] : 'vertical';

    $disabled = (isset($options['disabled']) && $options['disabled']) ? " disabled='disabled'" : "";
    $input = "<input tabindex='50' type='radio' name='$group' id='$input_id' value='$name' $select_html $disabled>";

    if ($orientation == 'horizontal') {
        return "
            <td nowrap align='right'>$image<label for='$input_id' id='$label_id_html'>$label</label></td>
            <td>$input</td>
        ";
    } else {
        return "
            <tr id='$field_id_html'>
                <td>$input<label for='$input_id' id='$label_id_html'>$label</label>$label_help</td>
                <td>$image</td>
            </tr>
        ";
    }
}

///////////////////////////////////////////////////////////////////////////////
// P R O G R E S S  B A R S
///////////////////////////////////////////////////////////////////////////////

/**
 * Display a progress bar as part of a form field.
 *
 * Supported options:
 * - field_id 
 * - label_id 
 *
 * @param string $label   form field label
 * @param string $id      HTML ID
 * @param array  $options options
 *
 * @return string HTML for text input field
 */

function theme_field_progress_bar($label, $id, $options = array())
{
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $id . '_label';
    $value = (isset($options['value'])) ? $options['value'] : 0;

    return "
        <tr id='$field_id_html' class='theme-field-progress-bar'>
            <td class='theme-field-left'>
                <label for='$id' id='$label_id_html'>$label</label>
            </td>
            <td class='theme-field-right'>
                <div id='$id' class='theme-progress-bar'> </div>
                <script type='text/javascript'>
                    $('#$id').progressbar({
                      value: $value
                    });
                </script>
            </td>
        </tr>
    ";
}

/**
 * Display a progress bar as standalone entity.
 *
 * @param string $id      HTML ID
 * @param array  $options options
 *
 * @return string HTML output
 */

function theme_progress_bar($id, $options)
{
    $value = (isset($options['value'])) ? $options['value'] : 0;
    return "<div id='$id' class='theme-progress-bar'> </div>
            <script type='text/javascript'>
                $('#$id').progressbar({
                  value: $value
                });
            </script>
    ";
} 

/**
 * Display an info line in a form.
 *
 * @param string $id      HTML ID
 * @param string $label   label
 * @param string $text    text
 * @param array  $options options
 *
 * @return string HTML output
 */

function theme_field_info($id, $label, $text, $options = NULL)
{
    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $id . '_label';
    $hide_field = (isset($options['hide_field'])) ? ' theme-hidden' : '';

    // Width hack below...CSS wrt forms is crazy.
    return "
        <tr id='$field_id_html' class='theme-field-info" . $hide_field . "'>
            <td class='theme-field-left'><div id='$label_id_html'>$label</div></td>
            <td class='theme-field-right info' width='280'>$text</td>
        </tr>
    ";
} 

///////////////////////////////////////////////////////////////////////////////
// F O R M  H E A D E R / F O O T E R
///////////////////////////////////////////////////////////////////////////////

/**
 * Form header.
 *
 * Supported options:
 * - id 
 *
 * @param string $title form title
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_form_header($title, $options)
{
    $id_html = (isset($options['id'])) ? " id='" . $options['id'] . "'" : '';
    $status_id_html = (isset($options['id'])) ? " id='status_" . $options['id'] . "'" : '';

    if (isset($options['id'])) {
        return "<table border='0' cellpadding='0' cellspacing='0' class='theme-form-wrapper'$id_html>
            <tr class='theme-form-header'>
                <td><span class='theme-form-header-heading'>$title</span></td>
                <td align='right'><span class='theme-form-header-status' $status_id_html>&nbsp;</span></td>
            </tr>
        ";
    } else {
        return "<table border='0' cellpadding='0' cellspacing='0' class='theme-form-wrapper'$id_html>
            <tr class='theme-form-header'>
                <td colspan='2'><span class='theme-form-header-heading'>$title</span></td>
            </tr>
        ";
    }
}

/**
 * Form banner.
 *
 * Supported options:
 * - id 
 *
 * @param string $html    html payload
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_form_banner($html, $options)
{
    $id_html = (isset($options['id'])) ? " id='" . $options['id'] . "'" : '';
 
    return "
        <tr class='theme-form-header'$id_html>
            <td colspan='2' class='theme-form-banner'>$html</td>
        </tr>
    ";
}

/**
 * Form footer.
 *
 * Supported options:
 * - id 
 *
 * @param array $options options
 *
 * @return string HTML
 */

function theme_form_footer($options)
{
    $id_html = (isset($options['id'])) ? " id='" . $options['id'] . "'" : '';

    return "</table>";
}

///////////////////////////////////////////////////////////////////////////////
// S I D B A R  W I D G E T
///////////////////////////////////////////////////////////////////////////////

/**
 * Sidebar header.
 *
 * Supported options:
 * - id 
 *
 * @param string $title form title
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_sidebar_header($title, $options)
{
    $id_html = (isset($options['id'])) ? " id='" . $options['id'] . "'" : '';
    $status_id_html = (isset($options['id'])) ? " id='status_" . $options['id'] . "'" : '';

    if (isset($options['id'])) {
        return "<table border='0' cellpadding='0' cellspacing='0' class='theme-form-wrapper'$id_html>
            <tr class='theme-form-header'>
                <td><span class='theme-form-header-heading'>$title</span></td>
                <td align='right'><span class='theme-form-header-status' $status_id_html>&nbsp;</span></td>
            </tr>
        ";
    } else {
        return "<table border='0' cellpadding='0' cellspacing='0' class='theme-form-wrapper'$id_html>
            <tr class='theme-form-header'>
                <td colspan='2'><span class='theme-form-header-heading'>$title</span></td>
            </tr>
        ";
    }
}

/**
 * Sidebar banner.
 *
 * Supported options:
 * - id 
 *
 * @param string $html    html payload
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_sidebar_banner($html, $options)
{
    $id_html = (isset($options['id'])) ? " id='" . $options['id'] . "'" : '';
 
    return "
        <tr class='theme-form-header'$id_html>
            <td colspan='2' class='theme-form-banner'>$html</td>
        </tr>
    ";
}

/**
 * Sidebar key value.
 *
 * Supported options:
 * - id 
 * - value_id
 *
 * @param string $value   value
 * @param string $label   label
 * @param string $base_id base ID
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_sidebar_value($value, $label, $base_id, $options)
{
    if (empty($base_id))
        $base_id = 'clearos_sidebar_' . mt_rand();

    $field_id_html = (isset($options['field_id'])) ? $options['field_id'] : $base_id . '_field';
    $label_id_html = (isset($options['label_id'])) ? $options['label_id'] : $base_id . '_label';
    $text_id_html = (isset($options['text_id'])) ? $options['text_id'] : $base_id . '_text';
    $hide_field = (isset($options['hide_field'])) ? ' theme-hidden' : '';
    $input_html = "<input type='hidden' name='$base_id' value='$value' id='$base_id'>";
 
    return "
        <tr id='$field_id_html' class='theme-fieldview" . $hide_field . "'>
            <td class='theme-field-left'><label for='$base_id' id='$label_id_html'>$label</label></td>
            <td class='theme-field-right'><span id='$text_id_html'>$value</span>$input_html</td>
        </tr>
    ";
}

/**
 * Sidebar text.
 *
 * Supported options:
 * - id 
 *
 * @param string $html    html payload
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_sidebar_text($html, $options)
{
    $id_html = (isset($options['id'])) ? " id='" . $options['id'] . "'" : '';
    $align = (isset($options['align'])) ? " align='" . $options['align'] . "'" : '';
 
    return "
        <tr$id_html>
            <td colspan='2'$align>$html</td>
        </tr>
    ";
}

/**
 * Sidebar footer.
 *
 * @return string HTML
 */

function theme_sidebar_footer()
{
    return "</table>";
}

///////////////////////////////////////////////////////////////////////////////
// C H A R T  W I D G E T
///////////////////////////////////////////////////////////////////////////////

/**
 * Chart widget.
 *
 * Supported options:
 * - id 
 *
 * @param string $title   form title
 * @param string $payload payload
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_chart_widget($title, $payload, $options)
{
    $id_html = (isset($options['id'])) ? " id='" . $options['id'] . "'" : '';

    $action = ($options['action']) ? $options['action'] : '';

    return "
        <table border='0' cellpadding='0' cellspacing='0' class='theme-chart-wrapper'$id_html>
            <tr class='theme-chart-header'>
                <td><span class='theme-form-header-heading'>$title</span></td>
                <td align='right'>" . $action . "</td>
            </tr>
            <tr>
                <td colspan='2' class='theme-chart-payload'>$payload</td>
            </tr>
        </table>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// T A B  V I E W
///////////////////////////////////////////////////////////////////////////////

/**
 * Tabular content.
 *
 * @param array $tabs tabs
 *
 * @return string HTML
 */

function theme_tab($tabs)
{
    $html = "<div id='tabs' class='ui-tabs ui-widget ui-widget-content ui-corner-all'>\n
<div>\n
<ul class='ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all'>\n
    ";

    $tab_content = "";
    foreach ($tabs as $key => $tab) {
        $html .= "<li class='ui-state-default ui-corner-top'>
<a href='#tabs-" . $key . "'>" . $tab['title'] . "</a></li>\n";
        $tab_content .= "<div id='tabs-" . $key .
"' class='clearos_tabs ui-tabs ui-widget ui-widget-content ui-corner-all'>" . $tab['content'] . "</div>";
    }
    $html .= "</ul>\n";
    $html .= $tab_content;
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "<script type='text/javascript'>
$(function(){
$('#tabs').tabs({
selected: 0
});
});
</script>";

    return $html;
}

///////////////////////////////////////////////////////////////////////////////
// L O A D I N G  I C O N
///////////////////////////////////////////////////////////////////////////////

/**
 * Loading/wait state in progress.
 *
 * @param string $size    size (small, normal)
 * @param string $text    text to display
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_loading($size, $text = '', $options = NULL)
{
    $id = '';

    if (isset($options['id']))
        $id = "id='" . $options['id'] . "'"; 

    if (isset($options['icon-below']))
        return "<div style='padding-bottom: 5;'>$text</div><div $id class='theme-loading-$size'></div>\n";
    else
        return "<div $id class='theme-loading-$size'>$text</div>\n";
}

///////////////////////////////////////////////////////////////////////////////
// A C T I O N  T A B L E
///////////////////////////////////////////////////////////////////////////////

/**
 * Action table.
 *
 * @param string $title   table title
 * @param array  $items   items
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_action_table($title, $anchors, $items, $options = NULL)
{
        $action_col = FALSE;
    
    // Anchors
    //--------

    $add_html = (empty($anchors)) ? '&nbsp; ' : button_set($anchors);

    // Table ID
    //---------

    if (isset($options['id']))
        $dom_id = $options['id'];
    else
        $dom_id = 'tbl_id_' . rand(0, 1000);

    // Item parsing
    //-------------

    $item_html = '';

    foreach ($items as $item) {
        $item_html .= "\t<tr>\n";
        $item_html .= "\t\t<td>" . $item['title'] . "</td>\n";
        $item_html .= "\t\t<td class='table-buttonset-column'>" . button_set($item['anchors']) . "</td>\n";
        $item_html .= "\t</tr>\n";
    }

    // Action table
    //-------------

    return "

<div class='theme-summary-table-container ui-widget'>
  <div class='theme-summary-table-header ui-state-active ui-corner-top'>
    <div class='theme-summary-table-title'>$title</div>
    <div class='theme-summary-table-action'>$add_html</div>
  </div>
  <table cellspacing='0' cellpadding='0' width='100%' border='0' class='theme-summary-table theme-summary-table-small display' id='$dom_id'>
    <thead>
      <tr class='theme-hidden'>
        <th>Item</th>
        <th>Action</th>
       </tr>
    </thead>
   <tbody>
$item_html
   </tbody>
  </table>
</div>
<script type='text/javascript'>
	var table_" . $dom_id . " = $('#" . $dom_id . "').dataTable({
		\"bJQueryUI\": true,
        \"bInfo\": false,
		\"bPaginate\": false,
		\"bFilter\": false,
		\"bSort\": false,
		\"sPaginationType\": \"full_numbers\"
    });
</script>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// S U M M A R Y  T A B L E
///////////////////////////////////////////////////////////////////////////////

/**
 * Summary table.
 *
 * @param string $title   table title
 * @param array  $anchors list anchors
 * @param array  $headers headers
 * @param array  $items   items
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_summary_table($title, $anchors, $headers, $items, $options = NULL)
{
    $columns = count($headers) + 1;

    // Header parsing
    //---------------

    $first_column_fixed_sort = "[ 0, 'asc' ]";

    // Tabs are just for clean indentation HTML output
    $header_html = (isset($options['row-enable-disable']) ? '<th></th>' : '');
    $empty_row = (isset($options['row-enable-disable']) ? '<td></td>' : '');

    foreach ($headers as $header) {
        $header_html .= "\n\t\t" . trim("<th>$header</th>");
        $empty_row .= '<td>&nbsp; </td>';
    }

    // Action column?
    $action_col = TRUE;
    if (isset($options['no_action']) && $options['no_action'])
        $action_col = FALSE;
    
    // No title in the action header
    if ($action_col) {
        $header_html .= "\n\t\t" . trim("<th>&nbsp; </th>");
        $empty_row .= "<td>&nbsp; </td>";
    }

    // Anchors
    //--------

    $add_html = (empty($anchors)) ? '&nbsp; ' : button_set($anchors);

    // Table ID (used for variable naming too)
    if (isset($options['id']))
        $dom_id = $options['id'];
    else
        $dom_id = 'tbl_id_' . rand(0, 1000);

    // Item parsing
    //-------------

    if (empty($items)) {
        $item_html = "<tr>$empty_row</tr>";
    } else {
        $item_html = '';

        foreach ($items as $item) {
            $item_html .= "\t<tr" . (isset($item['row_id']) ? " id='r-" . $item['row_id'] . "'" : '') . ">";
            if (isset($item['current_state']) && $item['current_state'] === TRUE) {
                $item_html .= "
                    <td>
                      <i class='theme-summary-table-entry-state theme-text-good-status fa fa-power-off'>
                        <span class='theme-hidden'>0</span>
                      </i>
                    </td>\n
                ";
            } else if (isset($item['current_state']) && $item['current_state'] === FALSE) {
                $item_html .= "
                    <td>
                      <i class='theme-summary-table-entry-state theme-text-bad-status fa fa-power-off'>
                        <span class='theme-hidden'>1</span>
                      </i>
                    </td>\n
                ";
            } else if (isset($options['row-enable-disable'])) {
                // Developer forgot to set enable/disable toggles in item array...need this to keep table td's in check
                $item_html .= "
                    <td>
                      <i class='theme-summary-table-entry-state fa fa-question'>
                        <span class='theme-hidden'>2</span>
                      </i>
                    </td>\n
                ";
            }

            foreach ($item['details'] as $value)
                $item_html .= "\t\t" . "<td>$value</td>\n";

            if ($action_col)
                $item_html .= "\t\t<td class='table-buttonset-column'>" . $item['anchors'] . "</td>";
            $item_html .= "\t</tr>\n";
        }
    }

    // Number of rows
    //---------------

    $default_rows = (empty($options['default_rows'])) ? 10 : $options['default_rows'];

    // Show a reasonable number of entries
    if ((count($items) > 100) || (isset($options['paginate_large']) && $options['paginate_large'])) {
        $row_options = '[10, 25, 50, 100, 200, 250, 500, -1], [10, 25, 50, 100, 200, 250, 500, "' . lang('base_all') . '"]';
    } else {
        if ($default_rows >= 100)
            $default_rows = 100;

        $row_options = '[10, 25, 50, 100, -1], [10, 25, 50, 100, "' . lang('base_all') . '"]';
    }

    // Size
    //-----

    if (isset($options['table_size'])) 
        $size_class = ($options['table_size'] == 'large') ? 'theme-summary-table-large' : 'theme-summary-table-small';
    else
        $size_class = 'theme-summary-table-large';

    // Paginate
    // --------

    if (isset($options['paginate'])) {
        $paginate = $options['paginate'];
        $default_rows = 10000;
    } else {
        $paginate = FALSE;
        if ((count($items) > 10) || (isset($options['paginate']) && $options['paginate']))
            $paginate = TRUE;
    }

    // Filter
    //-------

    $filter = FALSE;
    if ((count($items) > 10) || (isset($options['filter']) && $options['filter']))
        $filter = TRUE;

    // Empty table
    if (isset($options['empty_table_message'])) 
        $empty_table = "
            \"oLanguage\": {
                \"sEmptyTable\": \"" . $options['empty_table_message'] . "\"
            },
        ";
    else
        $empty_table = '';

    // Sort
    //-----

    $sort = TRUE;
    if (isset($options['sort']) && !$options['sort'])
        $sort = FALSE;
    $sorting_cols = '"bSortable": false, "aTargets": [ ' . ($action_col ? '-1' : '') . ' ]';

    if (isset($options['sort']) && is_array($options['sort']))
		$sorting_cols = '"bSortable": false, "aTargets": [ ' . implode(',', $options['sort']) . ' ]';

    // Sorting type option
    // This is a pretty big hack job...pretty tough to expose all the functionality datatables have
    $sorting_type = '';
    if (isset($options['sorting-type'])) {
        $sorting_type = "\"aoColumns\": [\n";

        foreach ($options['sorting-type'] as $s_type) {
            if ($s_type == NULL) {
                $sorting_type .= "              null,\n";
            } else {
                // Map int/string/ip to datables values
                if ($s_type == 'int')
                    $datatables_type = 'numeric';
                else if ($s_type == 'float')
                    $datatables_type = 'numeric';
                else if ($s_type == 'date')
                    $datatables_type = 'date';
                else if ($s_type == 'string')
                    $datatables_type = 'string';
                else if ($s_type == 'title-numeric')
                    $datatables_type = 'title-numeric';
                else
                    $datatables_type = 'html';

                $sorting_type .= "              {\"sType\": \"" . $datatables_type . "\"},\n";
            }
        }

        // IE8 - strip off trailing comma (sigh)
        $sorting_type = preg_replace("/,\n$/", "\n", $sorting_type);

        $sorting_type .= "          ],";
    }

    $col_widths = '';
    if (isset($options['col-widths'])) {
        $col_widths .= "\"aoColumns\": [\n";
        foreach ($options['col-widths'] as $width)
		    $col_widths .= "{sWidth: '$width'},\n";
        $col_widths .= "],\n";
    }

    // Default sort
    if (isset($options['sort-default-col'])) {
        if (isset($options['sort-default-dir']))
            $first_column_fixed_sort = "[ " . $options['sort-default-col'] . ", '" . $options['sort-default-dir'] . "' ]";
        else
            $first_column_fixed_sort = "[ " . $options['sort-default-col'] . ", 'asc' ]";
    }

	// Grouping
	//---------

	if (isset($options['grouping']) && $options['grouping']) {
		$first_column_visible = 'false';
		$first_column_fixed_sort = "[ 0, 'asc' ]";
		$group_javascript = "
        \"fnDrawCallback\": function ( oSettings ) {
            if ( oSettings.aiDisplay.length == 0 )
            {
                return;
            }
             
            var nTrs = $('#$dom_id tbody tr');
            var iColspan = nTrs[0].getElementsByTagName('td').length;
            var sLastGroup = \"\";
            for ( var i=0 ; i<nTrs.length ; i++ )
            {
                var iDisplayIndex = oSettings._iDisplayStart + i;
                var sGroup = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[0];
                if ( sGroup != sLastGroup )
                {
                    var nGroup = document.createElement( 'tr' );
                    var nCell = document.createElement( 'td' );
                    nCell.colSpan = iColspan;
                    nCell.className = \"group\";
                    nCell.innerHTML = sGroup;
                    nGroup.appendChild( nCell );
                    nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
                    sLastGroup = sGroup;
                }
            }
        },
		";
	} else {
		$first_column_visible = 'true';
		$group_javascript = '';
	}

    // Summary table
    //--------------

    // FIXME: dom IDS with periods are valid, but some massaging is required.
    // Implement below in other places.
    $dom_id_var = preg_replace('/\./', '_', $dom_id);
    $dom_id_selector = preg_replace('/\./', '\\\\\\.', $dom_id);

    return "

<div class='theme-summary-table-container ui-widget'>
  <div class='theme-summary-table-header ui-state-active ui-corner-top'>
    <div class='theme-summary-table-title'>$title</div>
    <div class='theme-summary-table-action'>$add_html</div>
  </div>
  <table cellspacing='0' cellpadding='0' width='100%' border='0' class='theme-summary-table $size_class display' id='$dom_id'>
   <thead>
    <tr>$header_html
    </tr>
   </thead>
   <tbody>
$item_html
   </tbody>
  </table>
</div>
<script type='text/javascript'>
	var table_" . $dom_id_var . " = $('#" . $dom_id_selector . "').dataTable({
		\"aoColumnDefs\": [
			{ $sorting_cols },
			{ \"bVisible\": $first_column_visible, \"aTargets\": [ 0 ] }
		],
        " . $empty_table . "
		\"bJQueryUI\": true,
        \"bInfo\": false,
        \"iDisplayLength\": $default_rows,
        \"aLengthMenu\": [$row_options],
		\"bPaginate\": " . ($paginate ? 'true' : 'false') . ",
		\"bFilter\": " . ($filter ? 'true' : 'false') . ",
		\"bSort\": " . ($sort ? 'true' : 'false') . ",
        " . $sorting_type .
        (isset($col_widths) ? "\"bAutoWidth\": false," : "") .
        $col_widths . "
		\"sPaginationType\": \"full_numbers\",
		$group_javascript
		\"aaSorting\": [ $first_column_fixed_sort ]
    });
    " . (isset($options['row-enable-disable']) ? "
        $('#$dom_id tr').each(function() {
            $(this).find('th:eq(0)').attr('width', '12px'); 
            $(this).find('td:eq(0)').css('padding', '0px'); 
        });
    " : "") . "
</script>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// L I S T  T A B L E
///////////////////////////////////////////////////////////////////////////////

/**
 * List table.
 *
 * @param string $title   table title
 * @param array  $anchors list anchors
 * @param array  $headers headers
 * @param array  $items   items
 * @param array  $options options
 *
 * Options:
 *  id: DOM ID
 *  group: flag for grouping
 *
 * @return string HTML
 */

function theme_list_table($title, $anchors, $headers, $items, $options = NULL)
{
    $columns = count($headers) + 1;

    // Header parsing
    //---------------

    // Tabs are just for clean indentation HTML output
    $header_html = '';

    foreach ($headers as $header)
        $header_html .= "\n\t\t" . trim("<th>$header</th>");

    // Action column?
    $action_col = TRUE;
    if (isset($options['no_action']) && $options['no_action'])
        $action_col = FALSE;

    // No title in the action header
    if ($action_col)
        $header_html .= "\n\t\t" . trim("<th>&nbsp; </th>");

    // Add button
    //-----------

    $add_html = (empty($anchors)) ? '&nbsp; ' : button_set($anchors);

    // Table ID (used for variable naming too)
    if (isset($options['id']))
        $dom_id = $options['id'];
    else
        $dom_id = 'tbl_id_' . rand(0, 1000);

	// Grouping
	//---------

	if (isset($options['grouping']) && $options['grouping']) {
		$first_column_visible = 'false';
		$first_column_fixed_sort = "[ 0, 'asc' ]";
		$group_javascript = "
        \"fnDrawCallback\": function ( oSettings ) {
            if ( oSettings.aiDisplay.length == 0 )
            {
                return;
            }
             
            var nTrs = $('#$dom_id tbody tr');
            var iColspan = nTrs[0].getElementsByTagName('td').length;
            var sLastGroup = \"\";
            for ( var i=0 ; i<nTrs.length ; i++ )
            {
                var iDisplayIndex = oSettings._iDisplayStart + i;
                var sGroup = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[0];
                if ( sGroup != sLastGroup )
                {
                    var nGroup = document.createElement( 'tr' );
                    var nCell = document.createElement( 'td' );
                    nCell.colSpan = iColspan;
                    nCell.className = \"group\";
                    nCell.innerHTML = sGroup;
                    nGroup.appendChild( nCell );
                    nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
                    sLastGroup = sGroup;
                }
            }
        },
		";
	} else {
		$first_column_visible = 'true';
		$first_column_fixed_sort = '';
		$group_javascript = '';
	}

    // Item parsing
    //-------------

    $item_html = '';

    foreach ($items as $item) {
        $item_html .= "\t<tr>\n";

        foreach ($item['details'] as $value)
            $item_html .= "\t\t" . "<td>$value</td>\n";

        if (isset($options['read_only']) && $options['read_only']) {
            $type = ($item['state']) ? "<span class='ui-icon ui-icon-check'>&nbsp; </span>" : ''; 
            $item_html .= "\t\t<td>$type</td>";
        } else {
            $select_html = ($item['state']) ? 'checked' : ''; 
            $item_html .= "\t\t<td class='table-buttonset-column'><input type='checkbox' name='" . $item['name'] . "' $select_html></td>\n";
        }

        $item_html .= "\t</tr>\n";
    }

    // List table
    //-----------

    return "

<div class='theme-list-table-container ui-widget'>
  <div class='theme-list-table-header ui-state-active ui-corner-top'>
    <div class='theme-list-table-title'>$title</div>
    <div class='theme-list-table-action'>$add_html</div>
  </div>
  <table cellspacing='0' cellpadding='0' width='100%' border='0' class='theme-list-table display' id='$dom_id'>
   <thead>
    <tr>$header_html
    </tr>
   </thead>
   <tbody>
$item_html
   </tbody>
  </table>
</div>
<script type='text/javascript'>
	var table_" . $dom_id . " = $('#" . $dom_id . "').dataTable({
		\"aoColumnDefs\": [
			{ \"bSortable\": false, \"aTargets\": [ " . ($action_col ? "-1" : "") . " ] },
			{ \"bVisible\": $first_column_visible, \"aTargets\": [ 0 ] }
		],
		\"bJQueryUI\": true,
		\"bPaginate\": false,
		\"bFilter\": false,
		$group_javascript
		\"aaSortingFixed\": [ $first_column_fixed_sort ],
		\"sPaginationType\": \"full_numbers\"
    });
</script>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// D I A L O G  B O X E S
///////////////////////////////////////////////////////////////////////////////

function theme_dialogbox_confirm_delete($message, $items, $ok_anchor, $cancel_anchor)
{
    $items_html = '';

    foreach ($items as $item)
        $items_html = '<li>' . $item . '</li>';

    return "
        <div class='ui-widget'>
            <div class='theme-confirmation-dialogbox ui-state-error' style='margin-top: 20px; padding: 0 .7em;'>
                <p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>$message</p>
                <ul>
                    $items_html
                </ul>
                <p>" . theme_button_set(array(anchor_ok($ok_anchor, 'high'), anchor_cancel($cancel_anchor, 'low'))) . "</p>
            </div>
        </div>
    ";
}

function theme_dialogbox_confirm($message, $ok_anchor, $cancel_anchor)
{
    $class = 'ui-state-error';
    $iconclass = 'ui-icon-alert';

    return "
        <div class='ui-widget'>
            <div class='ui-corner-all theme-confirmation-dialogbox $class' style='margin-top: 20px; padding: 0 .7em;'>
                <p><span class='ui-icon $iconclass' style='float: left; margin-right: .3em;'></span>$message</p>
                <p>" . theme_button_set(array(anchor_ok($ok_anchor, 'high'), anchor_cancel($cancel_anchor, 'low'))) . "</p>
            </div>
        </div>
    ";
}

function theme_dialogbox_info($message)
{
    $class = 'ui-state-highlight';

    return "
        <div class='ui-widget'>
            <div class='ui-corner-all theme-dialogbox-info $class'>
               $message
            </div>
        </div>
    ";
}

function theme_dialog_warning($message)
{
    $class = 'ui-state-error';
    $iconclass = 'ui-icon-alert';

    return "
        <div class='ui-widget' style='margin: 10px'>
            <div class='ui-corner-all theme-dialogbox-info $class'>
               <span class='ui-icon $iconclass' style='float: left; margin-right: .3em;'></span>$message
            </div>
        </div>
    ";
}


///////////////////////////////////////////////////////////////////////////////
// I N F O  B O X
///////////////////////////////////////////////////////////////////////////////

/**
 * Displays a standard infobox.
 *
 * Infobox types:
 * - warning  (bad, but we can cope)
 * - highlight (here's something you should know...)
 *
 * @param string $type    type of infobox
 * @param string $title   table title
 * @param string $message message
 * @param array  $options options
 *
 * @return string HTML
 */

function theme_infobox($type, $title, $message, $options = NULL)
{
    if ($type === 'warning') {
        $class = 'ui-state-error';
        $iconclass = 'ui-icon-alert';
    } else if ($type === 'highlight') {
        $class = 'ui-state-default';
        $iconclass = 'ui-icon-info';
    } else {
        // TODO: review default
        $class = 'ui-state-default';
        $iconclass = 'ui-icon-info';
    }

    $id = isset($options['id']) ? ' id=' . $options['id'] : '';

    return "
        <div class='ui-widget infobox' $id>
            <div class='ui-corner-all theme-infobox $class' style=' '>
                <h2>$title</h2>
                <div class='theme-infobox-text'>$message</div>
            </div>
        </div>
    ";
}

///////////////////////////////////////////////////////////////////////////////
// C O N F I R M  A C T I O N  B O X
///////////////////////////////////////////////////////////////////////////////

function theme_confirm($title, $confirm_uri, $cancel_uri, $message, $options)
{
    $message = "
        <p>$message</p>
        <div>" . theme_button_set(array(anchor_ok($confirm_uri), anchor_cancel($cancel_uri))) . "</div>
    ";

    return theme_infobox('highlight', $title, $message);
}

///////////////////////////////////////////////////////////////////////////////
// C O N F I R M  D E L E T E  B O X
///////////////////////////////////////////////////////////////////////////////

function theme_confirm_delete($title, $confirm_uri, $cancel_uri, $items, $message, $options)
{
    foreach ($items as $item)
        $items_html = "<li>$item</li>\n";

    $items_html = "<ul>\n$items_html\n</ul>\n";

    $message = "
        <p>$message</p>
        <div>$items_html</div>
        <div>" . theme_button_set(array(anchor_ok($confirm_uri), anchor_cancel($cancel_uri))) . "</div>
    ";

    return theme_infobox('highlight', $title, $message);
}

///////////////////////////////////////////////////////////////////////////////
// W I Z A R D  I N T R O  B O X
///////////////////////////////////////////////////////////////////////////////

/**
 * Displays an intro box when in wizard mode.
 *
 */

function theme_wizard_intro_box($data, $options)
{
    // TODO: bad hack.  Move to CSS if this is what we roll with.
    // TODO: fix the CSS classes (stealing help-box stuff)
    // TODO: sorry, div layout was causing grief.
    $font = " style='font-size: 13px'";

    $action = '';
    if (isset($options['action']))
        $action = anchor_custom(
            $options['action']['url'], 
            $options['action']['text'], 
            $options['action']['priority'], 
            $options['action']['js'] 
        );
    return theme_dialogbox_info("
        <div class='theme-help-box-breadcrumb'>" . $data['wizard_name'] . "</div><div style='float: right; margin-right: 15px;'>" . $action . "</div>
        <div class='theme-help-box-content'>
            <table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                    <td><div class='theme-wizard-intro-icon'><img src='" . $data['icon_path'] . "' alt=''></div></td>
                    <td valign='top'><p class='theme-wizard-intro-description'$font>" . $data['wizard_description'] . "</p></td>
                </tr>
            </table>
        </div>
    ");
}

///////////////////////////////////////////////////////////////////////////////
// H E L P  B O X
///////////////////////////////////////////////////////////////////////////////

/**
 * Displays a help box.
 *
 * The available data for display:
 * - $name - app name
 * - $category - category
 * - $subcategory - subcategory
 * - $description - description
 * - $user_guide_url - URL to the User Guide
 * - $support_url - URL to support
 */

function theme_help_box($data)
{
    if (!empty($data['user_guide_url'])) {
        $user_guide_link = "
            <div class='theme-help-box-assets-icons theme-help-box-user-guide'>
                <a target='_blank' href='" . $data['user_guide_url'] . "'>" . $data['user_guide_url_text'] . "</a>
            </div>
        ";
    } else {
        $user_guide_link = "";
    }

    if (!empty($data['support_url'])) {
        $support_link = "
            <div class='theme-help-box-assets-icons theme-help-box-support'>
                <a target='_blank' href='" . $data['support_url'] . "'>" . $data['support_url_text'] . "</a>
            </div>
        ";
    } else {
        $support_link = "";
    }

    if ($support_link || $user_guide_link) {
        $help_box_assets = "
            <div class='theme-help-box-assets'>
                <div class='theme-help-box-assets-style'>
                    $user_guide_link
                    $support_link
                </div>
            </div>
        ";
    } else {
        $help_box_assets = '';
    }

    $action = '';
    if (isset($data['action']))
        $action = anchor_custom(
            $data['action']['url'], 
            $data['action']['text'], 
            $data['action']['priority'], 
            $data['action']['js'] 
        );

    return theme_dialogbox_info("
        <div class='theme-help-box-breadcrumb' >" . $data['name'] . "</div><div style='float: right; margin-right: 15px;'>" . $action . "</div>
        <div class='theme-help-box-content'>
          <div class='theme-help-box-icon'><img src='" . $data['icon_path'] . "' alt=''></div>
          <div class='theme-help-box-assets'>$help_box_assets</div>
          <div class='theme-help-box-description'>" . $data['description'] . "</div>
        </div>
    ");
}

///////////////////////////////////////////////////////////////////////////////
// I N L I N E  H E L P  B O X
///////////////////////////////////////////////////////////////////////////////

/**
 * Displays an inline box.
 *
 * Inline help is displayed on some pages, notably on app pages that are shown
 * before the network is configured (install wizard, graphical console).
 *
 * The available data for display:
 * - $name - app name
 */

function theme_inline_help_box($data)
{
    $help = '';

    $index = 0;
    foreach ($data['inline_help'] as $heading => $text) {
        $help .= "<h3 style='color: #666666; font-size: 13px; font-weight: bold; margin-top: 15px;' id='inline-help-title-$index'>$heading</h3>";
        $help .= "<p style='font-size: 13px;' id='inline-help-content-$index'>$text</p>";
        $index++;
    }

    $html = theme_dialogbox_info("
        <h3 style='padding-top: 5px'>" . lang('base_help') . "</h3>
        $help
    ");

    return $html;
}

///////////////////////////////////////////////////////////////////////////////
// A P P  S U M M A R Y  B O X
///////////////////////////////////////////////////////////////////////////////

/**
 * Displays a summary box.
 *
 * The available data for display:
 * - $name - app name
 * - $tooltip -  tooltip
 * - $version - version number (e.g. 4.7)
 * - $release - release number (e.g. 31.1, so version-release is 4.7-31.1)
 * - $vendor - vendor
 * 
 * If this application is included in the Marketplace, the following
 * information is also available.
 *
 * - $subscription_expiration - subscription expiration (if applicable)
 * - $install_status - install status ("up-to-date" or "update available")
 * - $marketplace_chart - a relevant chart object
 */

function theme_summary_box($data)
{
    clearos_load_language('base');

    $tooltip = empty($data['tooltip']) ? '' : '<p><b>' . lang('base_tooltip') . ' -- </b>' . $data['tooltip'] . '</p>';

    if (empty($data['tooltip'])) {
        $tooltip = '';
    } else {
        $tooltip = "
            <table width='100%' id='sidebar_tooltip_table'>
                <tr>
                    <td colspan='2'><b>" . lang('base_tooltip') . "</b> - " . $data['tooltip'] . "</td>
                </tr>
            </table>
        ";
    }

    // TODO: move this out of the theme
    // TODO: remove sidebar unless it's directly related to this widget.
    // TODO: translate
    if ($data['show_marketplace']) {
        $marketplace =  "
            <div class='marketplace-linkback'>" .
            anchor_custom('/app/marketplace/view/' . $data['basename'], 'App Details') . "
            </div>
            <div id='sidebar-recommended-apps'>
            </div>
        ";
    } else {
        $marketplace = '';
    }

    $html = theme_dialogbox_info("
        <h3>" . $data['name'] . "</h3>
        <table width='100%' id='sidebar_summary_table'>
            <tr>
                <td width='55%'><b>" . lang('base_vendor') . "</b></td>
                <td width='45%'>" . $data['vendor'] . "</td>
            </tr>
            <tr>
                <td><b>" . lang('base_version') . "</b></td>
                <td>" . $data['version'] . '-' . $data['release'] . "</td>
            </tr>
            <tr id='sidebar_additional_info_row' class='theme-hidden'>
                <td valign='top'><b>" . lang('base_additional_info') . "</b></td>
                <td id='sidebar_additional_info'>" . theme_loading('small') . "</td>
            </tr>
        </table>
        $tooltip
        $marketplace
    ");

    return $html;
}

///////////////////////////////////////////////////////////////////////////////
// C O N T R O L  P A N E L
///////////////////////////////////////////////////////////////////////////////

// Note: this theme does not use the "control panel" view so this function
// is here just for sanity checking during development!

function theme_control_panel($form_data)
{
    $items = '';

    foreach ($form_data as $form => $details)
        $items .= "<li><a rel='external' href='$form'>" . $details['title'] . "</a></li>\n";

    return "
        <div class='theme-control-panel'>
            <ul>
                $items
            </ul>
        </div>
    ";
}
