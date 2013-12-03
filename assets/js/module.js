/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

$(document).ready(function() {
	handleButton($('#et_save'));

	handleButton($('#et_cancel'),function(e) {
		if (m = window.location.href.match(/\/update\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/update/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+OE_patient_id;
		}
		e.preventDefault();
	});

	handleButton($('#et_deleteevent'));

	handleButton($('#et_canceldelete'),function(e) {
		e.preventDefault();
		if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/delete/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+OE_patient_id;
		}
	});

	$('select.populate_textarea').unbind('change').change(function() {
		if ($(this).val() != '') {
			var cLass = $(this).parent().parent().parent().attr('class').match(/Element.*/);
			var el = $('#'+cLass+'_'+$(this).attr('id'));
			var currentText = el.text();
			var newText = $(this).children('option:selected').text();

			if (currentText.length == 0) {
				el.text(ucfirst(newText));
			} else {
				el.text(currentText+', '+newText);
			}
		}
	});

	$('input[id="Element_OphTrConsent_Other_witness_required"]').unbind('click').click(function() {
		if ($(this).attr('checked') == 'checked') {
			$('#Element_OphTrConsent_Other_witness_name').show().closest('.field-row').show();
			$('#Element_OphTrConsent_Other_witness_name').val('').focus();
		} else {
			$('#Element_OphTrConsent_Other_witness_name').hide().closest('.field-row').hide();
		}
	});

	$('input[id="Element_OphTrConsent_Other_interpreter_required"]').unbind('click').click(function() {
		if ($(this).attr('checked') == 'checked') {
			$('#Element_OphTrConsent_Other_interpreter_name').show().closest('.field-row').show();
			$('#Element_OphTrConsent_Other_interpreter_name').val('').focus();
		} else {
			$('#Element_OphTrConsent_Other_interpreter_name').hide().closest('.field-row').hide();
		}
	});

	$('#et_print').unbind('click').click(function() {
		var m = window.location.href.match(/\/view\/([0-9]+)/);
		printIFrameUrl(baseUrl+'/OphTrConsent/default/print/'+m[1],null);
		return false;
	});

	$('#et_print_va').unbind('click').click(function() {
		var m = window.location.href.match(/\/view\/([0-9]+)/);
		printIFrameUrl(baseUrl+'/OphTrConsent/default/print/'+m[1],{"vi":true});
		return false;
	});

	$('tr.clickable').disableSelection();

	$('tr.clickable').click(function() {
		$(this).children('td:first').children('input[type="radio"]').attr('checked',true);
	});
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}

function OphTrConsent_inArray(needle, haystack) {
	var length = haystack.length;
	for(var i = 0; i < length; i++) {
		if (haystack[i].toLowerCase() == needle.toLowerCase()) return true;
	}
	return false;
}

function callbackAddProcedure(procedure_id) {
	$.ajax({
		'url': baseUrl+'/procedure/benefits/'+procedure_id,
		'type': 'GET',
		'dataType': 'json',
		'success': function(data) {
			var benefits = $('#Element_OphTrConsent_BenefitsAndRisks_benefits').text().split(/,\s*/);
			for (var i in benefits) {
				if (benefits[i].length <1) {
					benefits.splice(i,1);
				}
			}
			for (var i in data) {
				if (!OphTrConsent_inArray(data[i], benefits)) {
					benefits.push(data[i]);
				}
			}
			$('#Element_OphTrConsent_BenefitsAndRisks_benefits').text(OphTrConsent_ucfirst(benefits.join(", ")));
		}
	});

	$.ajax({
		'url': baseUrl+'/procedure/complications/'+procedure_id,
		'type': 'GET',
		'dataType': 'json',
		'success': function(data) {
			var complications = $('#Element_OphTrConsent_BenefitsAndRisks_risks').text().split(/,\s*/);
			for (var i in complications) {
				if (complications[i].length <1) {
					complications.splice(i,1);
				}
			}
			for (var i in data) {
				if (!OphTrConsent_inArray(data[i], complications)) {
					complications.push(data[i]);
				}
			}
			$('#Element_OphTrConsent_BenefitsAndRisks_risks').text(OphTrConsent_ucfirst(complications.join(", ")));
		}
	});
}

function OphTrConsent_ucfirst(str) {
	str += '';
	var f = str.charAt(0).toUpperCase();
	return f + str.substr(1);
}

function callbackRemoveProcedure(procedure_id) {
}
