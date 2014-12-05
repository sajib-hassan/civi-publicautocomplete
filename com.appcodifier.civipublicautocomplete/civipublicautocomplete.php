<?php

require_once 'civipublicautocomplete.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function civipublicautocomplete_civicrm_config(&$config) {
    _civipublicautocomplete_civix_civicrm_config($config);
}

function civipublicautocomplete_civicrm_buildForm($formName, &$form) {
    $forms = array('CRM_Contribute_Form_Contribution_Main');
    if (!in_array($formName, $forms)) {
        return;
    }
    if (!CRM_Core_Permission::check('access CiviCRM') && !CRM_Core_Permission::check('access AJAX API')) {
        return;
    }
    CRM_Core_Resources::singleton()->addStyle('
        #crm-container.crm-public input.huge.ui-autocomplete-input {
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAAAmJLR0QA/4ePzL8AAAAJcEhZcwAAAEgAAABIAEbJaz4AAAAJdnBBZwAAABAAAAAQAFzGrcMAAADcSURBVCjPhdG9TgJhEIXh58M1EGEFjEohiUGk4f4vBaSy0UYRBFEIP8JaLEvWhOjbTc6bzMlMSPxNRICGpopgZejJJosTIRGCtjtLE1uxmrGeZSZEaGh5NzBH5Na9jp7ksMKNtQcL8O1R2bXYLBUKqBjv45QXJ86yoYBg96v4zr55JqzECjmhamedF4ZqWoe4runTJHcHzy60lb3aqmo6tVHJSoZEoKTjSoSdL5GShZ5ZdqhUPVcWrEzVdRXN9X3khTyXuooW+sm04BgjAyux+7TkMd4kWkaE/979AxXnQ1s0DN1UAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDEwLTAyLTExVDExOjUwOjA4LTA2OjAw1hBl+wAAACV0RVh0ZGF0ZTptb2RpZnkAMjAwNi0wNS0wNVQxMzoyMjo0MC0wNTowML/k/hoAAAAASUVORK5CYII=) no-repeat scroll right center white;
            padding-right: 16px;
        }
        #crm-container.crm-public input.huge.ui-autocomplete-input.ui-autocomplete-loading{
            background: url("/sites/all/modules/civicrm/i/loading.gif") no-repeat scroll right center white;
        }
        .autocomplete.ui-autocomplete {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1001;
        }
        * html .autocomplete.ui-autocomplete {
            height: 300px;
        }');
    CRM_Core_Resources::singleton()->addScriptFile('com.appcodifier.civipublicautocomplete', 'js/public.autocomplete.js');
}

/**
 * Implementation of hook_civicrm_install
 */
function civipublicautocomplete_civicrm_install() {
    return _civipublicautocomplete_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function civipublicautocomplete_civicrm_uninstall() {
    return _civipublicautocomplete_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function civipublicautocomplete_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
    return _civipublicautocomplete_civix_civicrm_upgrade($op, $queue);
}
