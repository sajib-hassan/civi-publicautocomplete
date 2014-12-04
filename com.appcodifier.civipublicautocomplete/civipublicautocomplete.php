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
