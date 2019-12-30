<?php

require_once 'aogolfevent.civix.php';
require_once 'aogolfevent.constant.php';
use CRM_Aogolfevent_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function aogolfevent_civicrm_config(&$config) {
  _aogolfevent_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function aogolfevent_civicrm_xmlMenu(&$files) {
  _aogolfevent_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function aogolfevent_civicrm_install() {
  _aogolfevent_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function aogolfevent_civicrm_postInstall() {
  _aogolfevent_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function aogolfevent_civicrm_uninstall() {
  _aogolfevent_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function aogolfevent_civicrm_enable() {
  _aogolfevent_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function aogolfevent_civicrm_disable() {
  _aogolfevent_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function aogolfevent_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _aogolfevent_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function aogolfevent_civicrm_managed(&$entities) {
  _aogolfevent_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function aogolfevent_civicrm_caseTypes(&$caseTypes) {
  _aogolfevent_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function aogolfevent_civicrm_angularModules(&$angularModules) {
  _aogolfevent_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function aogolfevent_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _aogolfevent_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

function aogolfevent_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
  if ($formName == 'CRM_Event_Form_Registration_Register') {
    if (!empty($fields[GOLFER_PF]) && $fields[GOLFER_PF] == GOLFER_PFV) {
      for ($rowNumber = 1; $rowNumber <= 4; $rowNumber++) {
        foreach ([
          'golfer_first_name' => ts('First Name'),
          'golfer_last_name' => ts('Last Name'),
        ] as $name => $label) {
          if (empty($fields[$name][$rowNumber])) {
            $errors[sprintf("%s[%d]", $name, $rowNumber)] = ts('Please enter the ') . $label;
          }
        }
      }
    }
  }
}

function aogolfevent_civicrm_buildForm($formName, &$form) {
  if ($formName == "CRM_Price_Form_Field") {
    if (in_array(CRM_Core_Component::getComponentID('CiviEvent'), $form->getVar('_extendComponentId'))) {
      $form->addYesNo('is_donation', ts('Is used for Donation?'), TRUE);
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/IsDonation.tpl',
      ));
      if ($priceFieldID = $form->getVar('_fid')) {
        $isDonation = CRM_Core_DAO::singleValueQuery("SELECT is_donation FROM civicrm_event_contribution_pf WHERE price_field_id = " . $priceFieldID);
        $form->setDefaults(['is_donation' => $isDonation]);
      }
    }
  }
  if ($formName == 'CRM_Event_Form_Registration_Register') {
    $eventType = civicrm_api3('Event', 'getValue', ['id' => $form->_eventId, 'return' => 'event_type_id']);
    if ($eventType == GOLFER_EVENT_TYPE) {
      $fields = [
        'golfer_first_name' => ts('First Name'),
        'golfer_last_name' => ts('Last Name')
      ];
      for ($rowNumber = 1; $rowNumber <= 4; $rowNumber++) {
        foreach ($fields as $fieldName => $fieldLabel) {
          $name = sprintf("%s[%d]", $fieldName, $rowNumber);
          $form->add('text', $name, $fieldLabel, NULL);
        }
      }
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/MultipleGolfers.tpl',
      ));
      CRM_Core_Resources::singleton()->addScript(
        "CRM.$(function($) {
          $('#multiplehonorees').insertAfter($('#priceset'));
          if ($('input[name=\"" . GOLFER_PF . "\"]:checked').val() == " . GOLFER_PFV . ") {
            for (i = 1; i <= 4; i++) {
              $('#add-item-row-' + i).removeClass('hiddenElement');
            }
          }
          $('input[name=\"" . GOLFER_PF . "\"]').on('click', function(e, v) {
            if ($(this).val() == " . GOLFER_PFV .") {
              for (i = 1; i <= 4; i++) {
                $('#add-item-row-' + i).removeClass('hiddenElement');
              }
            }
            else {
              for (i = 1; i <= 4; i++) {
                $('#add-item-row-' + i).addClass('hiddenElement');
                var row = $('#add-item-row-' + i);
                $('input[id^=\"golfer_first_name\"]', row).val('');
                $('input[id^=\"golfer_last_name\"]', row).val('');
              }
            }
          });
        });
      ");
    }
  }
  if ($formName == 'CRM_Event_Form_Registration_ThankYou') {
    $fv = $form->getVar('_params')[0];
    $values = $form->getVar('_values');
    if (empty($values['contributionId'])) {
      return;
    }

    if (!empty($fv[GOLFER_PF]) &&  array_key_exists(GOLFER_PFV, $fv[GOLFER_PF])) {
      $avg = (float) ($fv['amount'] / 4);
      $softCredits = [];
      for ($i = 1; $i <=4; $i++) {
        $softCredits[$i] = [];
        $params = [
          'first_name' => $fv['golfer_first_name'][$i],
          'last_name' => $fv['golfer_last_name'][$i],
          'contact_type' => 'Individual',
        ];
        $params['id'] = CRM_Utils_Array::value('id', civicrm_api3('Contact' , 'get', array_merge(
          $params,
          ['options' => ['limit' => 1]]
        )));
        $contactID = civicrm_api3('Contact' , 'create', $params)['id'];
        $softCredits[$i] = [
          'contact_id' => $contactID,
          'amount' => $avg,
          'soft_credit_type_id' => CRM_Core_PseudoConstant::getKey('CRM_Contribute_BAO_ContributionSoft', 'soft_credit_type_id', 'On Behalf of'),
        ];
      }
      if (!empty($softCredits)) {
        $contriParams = [
          'id' => $values['contributionId'],
          'soft_credit' => $softCredits,
        ];
        CRM_Contribute_BAO_Contribution::create($contriParams);
      }
    }
  }

}

function aogolfevent_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  if ($objectName == "LineItem" && $op == "create" && $objectRef->entity_table == 'civicrm_participant') {
    $count = civicrm_api3('LineItem', 'getcount', [
      'entity_table' => 'civicrm_participant',
      'entity_id' => $objectRef->entity_id,
    ]);
    if ($count == 1) {
      $dao = new CRM_Aogolfevent_DAO_EventContributionPF();
      $dao->price_field_id = $objectRef->price_field_id;
      $dao->find(TRUE);
      if (!empty($dao->is_donation)) {
        $objectRef->participant_count = 0;
        $participantDAO = new CRM_Event_BAO_Participant();
        $participantDAO->id = $objectRef->entity_id;
        $participantDAO->find(TRUE);
        $participantDAO->status_id = 17;
        $participantDAO->save();
      }
    }
  }
}

function aogolfevent_civicrm_postProcess($formName, &$form) {
  if ($formName == "CRM_Price_Form_Field") {
    $priceFieldID = $form->getVar('_fid');
    $isDonation = CRM_Utils_Array::value('is_donation', $form->_submitValues);
    if (!is_null($isDonation)) {
      $dao = new CRM_Aogolfevent_DAO_EventContributionPF();
      $dao->price_field_id = $priceFieldID;
      $dao->find(TRUE);
      $dao->is_donation = $isDonation;
      $dao->save();
    }
    else {
      $dao = new CRM_Aogolfevent_DAO_EventContributionPF();
      $dao->price_field_id = $priceFieldID;
      $dao->find(TRUE);
      $dao->delete();
    }
  }
  if ($formName == "CRM_Event_Form_Registration_Confirm") {

  }
}



/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function aogolfevent_civicrm_entityTypes(&$entityTypes) {
  _aogolfevent_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function aogolfevent_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function aogolfevent_civicrm_navigationMenu(&$menu) {
  _aogolfevent_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _aogolfevent_civix_navigationMenu($menu);
} // */
