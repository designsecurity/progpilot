/**
 * $RCSfile: form_utils.js,v $
 * $Revision: 1.5 $
 * $Date: 2005/10/25 16:01:51 $
 *
 * Various form utilitiy functions.
 *
 * @author Moxiecode
 * @copyright Copyright � 2005, Moxiecode Systems AB, All rights reserved.
 */

function getColorPickerHTML(id, target_form_element) {
	var html = "";

	html += '<a id="' + id + '_link" href="javascript:void(0);" onkeydown="pickColor(event,\'' + target_form_element +'\');" onmousedown="pickColor(event,\'' + target_form_element +'\');return false;">';
	html += '<img id="' + id + '" src="../../themes/advanced/images/color.gif"';
	html += ' onmouseover="tinyMCE.switchClass(this,\'mceButtonOver\');"';
	html += ' onmouseout="tinyMCE.restoreClass(this);"';
	html += ' onmousedown="tinyMCE.restoreAndSwitchClass(this,\'mceButtonDown\');"';
	html += ' width="20" height="16" border="0" title="' + tinyMCE.getLang('lang_browse') + '"';
	html += ' class="mceButtonNormal" alt="' + tinyMCE.getLang('lang_browse') + '" /></a>';

	return html;
}

function pickColor(e, target_form_element) {
	if ((e.keyCode == 32 || e.keyCode == 13) || e.type == "mousedown")
		tinyMCEPopup.pickColor(e, target_form_element);
}

function updateColor(img_id, form_element_id) {
	document.getElementById(img_id).style.backgroundColor = document.forms[0].elements[form_element_id].value;
}

function setBrowserDisabled(id, state) {
	var img = document.getElementById(id);
	var lnk = document.getElementById(id + "_link");

	if (lnk) {
		if (state) {
			lnk.setAttribute("realhref", lnk.getAttribute("href"));
			lnk.removeAttribute("href");
			tinyMCE.switchClass(img, 'mceButtonDisabled', true);
		} else {
			lnk.setAttribute("href", lnk.getAttribute("realhref"));
			tinyMCE.switchClass(img, 'mceButtonNormal', false);
		}
	}
}

function getBrowserHTML(id, target_form_element, type, prefix) {
	var option = prefix + "_" + type + "_browser_callback";
	var cb = tinyMCE.getParam(option, tinyMCE.getParam("file_browser_callback"));
	if (cb == null)
		return "";

	var html = "";

	html += '<a id="' + id + '_link" href="javascript:openBrower(\'' + id + '\',\'' + target_form_element + '\', \'' + type + '\',\'' + option + '\');" onmousedown="return false;">';
	html += '<img id="' + id + '" src="../../themes/advanced/images/browse.gif"';
	html += ' onmouseover="tinyMCE.switchClass(this,\'mceButtonOver\');"';
	html += ' onmouseout="tinyMCE.restoreClass(this);"';
	html += ' onmousedown="tinyMCE.restoreAndSwitchClass(this,\'mceButtonDown\');"';
	html += ' width="20" height="18" border="0" title="' + tinyMCE.getLang('lang_browse') + '"';
	html += ' class="mceButtonNormal" alt="' + tinyMCE.getLang('lang_browse') + '" /></a>';

	return html;
}

function openBrower(img_id, target_form_element, type, option) {
	var img = document.getElementById(img_id);

	if (img.className != "mceButtonDisabled")
		tinyMCEPopup.openBrowser(target_form_element, type, option);
}

function selectByValue(form_obj, field_name, value, add_custom) {
	if (!form_obj || !form_obj.elements[field_name])
		return;

	var sel = form_obj.elements[field_name];

	var found = false;
	for (var i=0; i<sel.options.length; i++) {
		var option = sel.options[i];

		if (option.value == value) {
			option.selected = true;
			found = true;
		} else
			option.selected = false;
	}

	if (!found && add_custom && value != '') {
		var option = new Option('Value: ' + value, value);
		option.selected = true;
		sel.options[sel.options.length] = option;
	}

	return found;
}

function getSelectValue(form_obj, field_name) {
	var elm = form_obj.elements[field_name];

	if (elm == null || elm.options == null)
		return "";

	return elm.options[elm.selectedIndex].value;
}

function addClassesToList(list_id, specific_option) {
return;
	// Setup class droplist
	var styleSelectElm = document.getElementById(list_id);
	var styles = tinyMCE.getParam('theme_advanced_styles', false);
	styles = tinyMCE.getParam(specific_option, styles);

	if (styles) {
		var stylesAr = styles.split(';');

		for (var i=0; i<stylesAr.length; i++) {
			if (stylesAr != "") {
				var key, value;

				key = stylesAr[i].split('=')[0];
				value = stylesAr[i].split('=')[1];

				styleSelectElm.options[styleSelectElm.length] = new Option(key, value);
			}
		}
	} else {
		// Use auto impored classes
		var csses = tinyMCE.getCSSClasses(tinyMCE.getWindowArg('editor_id'));
		for (var i=0; i<csses.length; i++)
			styleSelectElm.options[styleSelectElm.length] = new Option(csses[i], csses[i]);
	}
}

function isVisible(element_id) {
	var elm = document.getElementById(element_id);

	return elm && elm.style.display != "none";
}

function convertRGBToHex(col) {
	var re = new RegExp("rgb\\s*\\(\\s*([0-9]+).*,\\s*([0-9]+).*,\\s*([0-9]+).*\\)", "gi");

	var rgb = col.replace(re, "$1,$2,$3").split(',');
	if (rgb.length == 3) {
		r = parseInt(rgb[0]).toString(16);
		g = parseInt(rgb[1]).toString(16);
		b = parseInt(rgb[2]).toString(16);

		r = r.length == 1 ? '0' + r : r;
		g = g.length == 1 ? '0' + g : g;
		b = b.length == 1 ? '0' + b : b;

		return "#" + r + g + b;
	}

	return col;
}

function convertHexToRGB(col) {
	if (col.indexOf('#') != -1) {
		col = col.replace(new RegExp('[^0-9A-F]', 'gi'), '');

		r = parseInt(col.substring(0, 2), 16);
		g = parseInt(col.substring(2, 4), 16);
		b = parseInt(col.substring(4, 6), 16);

		return "rgb(" + r + "," + g + "," + b + ")";
	}

	return col;
}

function trimSize(size) {
	return size.replace(new RegExp('[^0-9%]', 'gi'), '');
}

function getCSSSize(size) {
	size = trimSize(size);

	if (size == "")
		return "";

	return size.indexOf('%') != -1 ? size : size + "px";
}

function getStyle(elm, attrib, style) {
	var val = tinyMCE.getAttrib(elm, attrib);

	if (val != '')
		return '' + val;

	if (typeof(style) == 'undefined')
		style = attrib;

	val = eval('elm.style.' + style);

	return val == null ? '' : '' + val;
}
