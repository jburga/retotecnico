
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if ($("#id_ac_" + sField).length > 0) {
    if ($oField.hasClass("select2-hidden-accessible")) {
      if (false == scSetFocusOnField($oField)) {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
    else {
      if (false == scSetFocusOnField($oField)) {
        if (false == scSetFocusOnField($("#id_ac_" + sField))) {
          setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
        }
      }
      else {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["num_documento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nombre" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["apellido" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["edad" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["num_documento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["num_documento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nombre" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nombre" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["apellido" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["apellido" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["edad" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["edad" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val() || scEventControl_data[sFieldName]["calculated"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_num_documento' + iSeqRow).bind('blur', function() { sc_form_personal_num_documento_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_personal_num_documento_onfocus(this, iSeqRow) });
  $('#id_sc_field_nombre' + iSeqRow).bind('blur', function() { sc_form_personal_nombre_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_personal_nombre_onfocus(this, iSeqRow) });
  $('#id_sc_field_apellido' + iSeqRow).bind('blur', function() { sc_form_personal_apellido_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_personal_apellido_onfocus(this, iSeqRow) });
  $('#id_sc_field_edad' + iSeqRow).bind('blur', function() { sc_form_personal_edad_onblur(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_personal_edad_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_personal_num_documento_onblur(oThis, iSeqRow) {
  do_ajax_form_personal_mob_validate_num_documento();
  scCssBlur(oThis);
}

function sc_form_personal_num_documento_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_personal_nombre_onblur(oThis, iSeqRow) {
  do_ajax_form_personal_mob_validate_nombre();
  scCssBlur(oThis);
}

function sc_form_personal_nombre_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_personal_apellido_onblur(oThis, iSeqRow) {
  do_ajax_form_personal_mob_validate_apellido();
  scCssBlur(oThis);
}

function sc_form_personal_apellido_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_personal_edad_onblur(oThis, iSeqRow) {
  do_ajax_form_personal_mob_validate_edad();
  scCssBlur(oThis);
}

function sc_form_personal_edad_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("num_documento", "", status);
	displayChange_field("nombre", "", status);
	displayChange_field("apellido", "", status);
	displayChange_field("edad", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_num_documento(row, status);
	displayChange_field_nombre(row, status);
	displayChange_field_apellido(row, status);
	displayChange_field_edad(row, status);
}

function displayChange_field(field, row, status) {
	if ("num_documento" == field) {
		displayChange_field_num_documento(row, status);
	}
	if ("nombre" == field) {
		displayChange_field_nombre(row, status);
	}
	if ("apellido" == field) {
		displayChange_field_apellido(row, status);
	}
	if ("edad" == field) {
		displayChange_field_edad(row, status);
	}
}

function displayChange_field_num_documento(row, status) {
}

function displayChange_field_nombre(row, status) {
}

function displayChange_field_apellido(row, status) {
}

function displayChange_field_edad(row, status) {
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_personal_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(25);
		}
	}
}
function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd

function scJQSelect2Add(seqRow, specificField) {
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
  scJQSelect2Add(iLine);
} // scJQElementsAdd

var scBtnGrpStatus = {};
function scBtnGrpShow(sGroup) {
  if (typeof(scBtnGrpShowMobile) === typeof(function(){})) { return scBtnGrpShowMobile(sGroup); };
  var btnPos = $('#sc_btgp_btn_' + sGroup).offset();
  scBtnGrpStatus[sGroup] = 'open';
  $('#sc_btgp_btn_' + sGroup).mouseout(function() {
    scBtnGrpStatus[sGroup] = '';
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  }).mouseover(function() {
    scBtnGrpStatus[sGroup] = 'over';
  });
  $('#sc_btgp_div_' + sGroup + ' span a').click(function() {
    scBtnGrpStatus[sGroup] = 'out';
    scBtnGrpHide(sGroup);
  });
  $('#sc_btgp_div_' + sGroup).css({
    'left': btnPos.left
  })
  .mouseover(function() {
    scBtnGrpStatus[sGroup] = 'over';
  })
  .mouseleave(function() {
    scBtnGrpStatus[sGroup] = 'out';
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  })
  .show('fast');
}
function scBtnGrpHide(sGroup) {
  if ('over' != scBtnGrpStatus[sGroup]) {
    $('#sc_btgp_div_' + sGroup).hide('fast');
  }
}