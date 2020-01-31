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
            $errors[sprintf("%s[%d]", $name, $rowNumber)] = ts('Please enter the %1 for participant %2', [1 => $label, 2 => $rowNumber]);
          }
        }
        foreach ([
          'golfer_email_address' => ts('Email Address'),
          'golfer_street_address' => ts('Address'),
          'golfer_city' => ts('City'),
          'golfer_postal_code' => ts('Postal Code'),
          'golfer_state_province' => ts('Province'),
          'golfer_country' => ts('Country'),
        ] as $name => $label) {
          if (empty($fields[$name][$rowNumber])) {
            $errors[sprintf("%s[%d]", $name, $rowNumber)] = ts('Please enter the %1 for participant %2', [1 => $label, 2 => $rowNumber]);
          }
        }
      }
    }
    if (empty($fields[GOLFER_PF]) && empty($fields[DINNER_PF]) && empty($fields['price_882'])) {
      $errors[GOLFER_PF] = E::ts('Please select either a golfer or dinner ticket or enter a donation amount');
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
        'golfer_last_name' => ts('Last Name'),
        'golfer_email_address' => ts('Email Address'),
        'golfer_street_address' => ts('Address'),
        // 'golfer_supplemental_address_1' => ts('Address 2'),
        'golfer_city' => ts('City'),
        'golfer_postal_code' => ts('Postal Code'),
        'golfer_state_province' => ts('Province'),
        'golfer_country' => ts('Country'),
      ];
      for ($rowNumber = 1; $rowNumber <= 4; $rowNumber++) {
        foreach ($fields as $fieldName => $fieldLabel) {
          $name = sprintf("%s[%d]", $fieldName, $rowNumber);
          if ($fieldName !== 'golfer_state_province' && $fieldName !== 'golfer_country') {
            $form->add('text', $name, $fieldLabel, NULL);
          }
          $config = CRM_Core_Config::singleton();
          if ($fieldName === 'golfer_state_province') {
            $form->addChainSelect($name, [
              'control_field' => sprintf("%s[%d]", 'golfer_country', $rowNumber),
              'label' => $fieldLabel,
            ]);
            $form->setDefaults([$name => $config->defaultContactStateProvince]);
          }
          if ($fieldName === 'golfer_country') {
            $form->add('select', $name, $fieldLabel, ['' => ts('- select -')] + CRM_Core_PseudoConstant::country());
            $form->setDefaults([$name => $config->defaultContactCountry]);
          }
        }
      }
      $form->add('textarea', 'dinner_guests', ts('Dinner Guests'));
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/MultipleGolfers.tpl',
      ));
      CRM_Core_Resources::singleton()->addScript(
        "CRM.$(function($) {
          $('#multiplehonorees').insertAfter($('#priceset'));
          $('.dinner_ticket_s_-section').addClass('hiddenElement');
          $('#splitreceipt').addClass('hiddenElement');
          $('.dinner_guests-section').addClass('hiddenElement');
          $('.dinner_guests-section').insertAfter('.dinner_ticket_s_-section');

          $('#first_name').on('change', function(e, v) {
            $('#golfer_first_name_1').val($(this).val());
          });
          $('#last_name').on('change', function(e, v) {
            $('#golfer_last_name_1').val($(this).val());
          });
          $('#email-1').on('change', function(e, v) {
            $('#golfer_email_address_1').val($(this).val());
          });
          $('#street_address-Primary').on('change', function(e, v) {
            $('#golfer_street_address_1').val($(this).val());
          });
          $('#city-Primary').on('change', function(e, v) {
            $('#golfer_city_1').val($(this).val());
          });
          $('#postal_code-Primary').on('change', function(e, v) {
            $('#golfer_postal_code_1').val($(this).val());
          });
          $('#state_province-Primary').on('change', function(e, v) {
            $('#golfer_state_province_1').val($(this).val());
          });
          $('#last_name').on('change', function(e, v) {
            $('#golfer_country_1').val($(this).val());
          });

          if ($('input[name=\"" . GOLFER_PF . "\"]:checked').val() == " . GOLFER_PFV . ") {
            for (i = 1; i <= 4; i++) {
              $('#add-item-row-' + i).removeClass('hiddenElement');
            }
            $('#splitreceipt').removeClass('hiddenElement');
          }
          if ($('input[name=\"" . GOLFER_PF . "\"]:checked').val() == 0) {
            $('.dinner_ticket_s_-section').removeClass('hiddenElement');
          }

          $('input[name=\"" . DINNER_PF . "\"]').on('keyup', function(e, v) {
            var value = $(this).val();
            if (value > 1) {
              $('.dinner_guests-section').removeClass('hiddenElement');
            }
            else {
              $('.dinner_guests-section').addClass('hiddenElement');
            }
          });

          $('input[name=\"" . GOLFER_PF . "\"]').on('click', function(e, v) {
            if ($(this).val() == " . GOLFER_PFV .") {
              $('.dinner_guests-section').addClass('hiddenElement');
              $('.dinner_guests-section').val('');

              $('input[name=\"" . DINNER_PF . "\"]').val('');
              $('input[name=\"" . DINNER_PF . "\"]').trigger('keyup');
              $('#splitreceipt').removeClass('hiddenElement');
              $('.dinner_ticket_s_-section').addClass('hiddenElement');
              for (i = 1; i <= 4; i++) {
                if (i == 1) {
                  $('#golfer_first_name_1').val($('#first_name').val());
                  $('#golfer_last_name_1').val($('#last_name').val());
                  $('#golfer_email_address_1').val($('#email-1').val());
                  $('#golfer_street_address_1').val($('#street_address-Primary').val())
                  $('#golfer_city_1').val($('#city-Primary').val())
                  $('#golfer_postal_code_1').val($('#postal_code-Primary').val())
                  $('#golfer_state_province_1').val($('#state_province-Primary').val())
                }
                $('#add-item-row-' + i).removeClass('hiddenElement');
              }
            }
            else {
              $('#splitreceipt').addClass('hiddenElement');
              if ($(this).val() == 0) {
                $('.dinner_ticket_s_-section').removeClass('hiddenElement');
              }
              else {
                $('.dinner_ticket_s_-section').addClass('hiddenElement');
                $('input[name=\"" . DINNER_PF . "\"]').val('');
                $('input[name=\"" . DINNER_PF . "\"]').trigger('keyup');
              }
              for (i = 1; i <= 4; i++) {
                $('#add-item-row-' + i).addClass('hiddenElement');
                var row = $('#add-item-row-' + i);
                $('input[id^=\"golfer_first_name\"]', row).val('');
                $('input[id^=\"golfer_last_name\"]', row).val('');
                if (i > 1) {
                  $('input[id^=\"golfer_email_address\"]', row).val('');
                  $('input[id^=\"golfer_street_address\"]', row).val('');
                  $('input[id^=\"golfer_city\"]', row).val('');
                  $('input[id^=\"golfer_postal_code\"]', row).val('');
                }
              }
            }
          });
        });
      ");
      $form->addYesNo('is_split_receipt', ts('Do you want to split the tax receipt?'));
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/SplitReceipt.tpl',
      ));
    }
  }
  if ($formName == 'CRM_Event_Form_Registration_Confirm') {
    $eventType = civicrm_api3('Event', 'getValue', ['id' => $form->_eventId, 'return' => 'event_type_id']);
    if ($eventType != GOLFER_EVENT_TYPE) {
      return;
    }
    $fv = $form->getVar('_params')[0];
    $golfers = [
      'first_name' => [],
      'last_name' => [],
      'email_addres' => [],
      'street_address' => [],
      'city' => [],
      'postal_code' => [],
      // 'supplemental_address_1' => [],
      'state_province_id' => [],
      'country_id' => [],
    ];
    for ($i = 1; $i <=4; $i++) {
      if (!empty($fv['golfer_first_name'][$i])) {
        $golfers['first_name'][$i] = $fv['golfer_first_name'][$i];
        $golfers['last_name'][$i] = $fv['golfer_last_name'][$i];
        $golfers['email_address'][$i] = $fv['golfer_email_address'][$i];
        $golfers['street_address'][$i] = $fv['golfer_street_address'][$i];
        $golfers['city'][$i] = $fv['golfer_city'][$i];
        $golfers['postal_code'][$i] = $fv['golfer_postal_code'][$i];
        // $golfers['supplemental_address_1'][$i] = $fv['golfer_supplemental_address_1'][$i];
        $golfers['state_province_id'][$i] = CRM_Core_PseudoConstant::getLabel('CRM_Core_BAO_Address', 'state_province_id', $fv['golfer_state_province'][$i]);
        $golfers['country_id'][$i] = CRM_Core_PseudoConstant::getLabel('CRM_Core_BAO_Address', 'country_id', $fv['golfer_country'][$i]);
      }
    }
    if (!empty($golfers['first_name'])) {
      $form->assign('golfers', $golfers);
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/MultipleGolfersPage.tpl',
      ));
    }
  }
  if ($formName == 'CRM_Event_Form_Registration_ThankYou') {
    $eventType = civicrm_api3('Event', 'getValue', ['id' => $form->_eventId, 'return' => 'event_type_id']);
    if ($eventType != GOLFER_EVENT_TYPE) {  
      return;
    }
    $fv = $form->getVar('_params')[0];
    $values = $form->getVar('_values');
    $golfers = [
      'first_name' => [],
      'last_name' => [],
      'email_addres' => [],
      'street_address' => [],
      'city' => [],
      'postal_code' => [],
      // 'supplemental_address_1' => [],
      'state_province_id' => [],
      'country_id' => [],
    ];
    for ($i = 1; $i <=4; $i++) {
      if (!empty($fv['golfer_first_name'][$i])) {
        $golfers['first_name'][$i] = $fv['golfer_first_name'][$i];
        $golfers['last_name'][$i] = $fv['golfer_last_name'][$i];
        $golfers['email_address'][$i] = $fv['golfer_email_address'][$i];
        $golfers['street_address'][$i] = $fv['golfer_street_address'][$i];
        $golfers['city'][$i] = $fv['golfer_city'][$i];
        $golfers['postal_code'][$i] = $fv['golfer_postal_code'][$i];
        // $golfers['supplemental_address_1'][$i] = $fv['golfer_supplemental_address_1'][$i];
        $golfers['state_province_id'][$i] = CRM_Core_PseudoConstant::getLabel('CRM_Core_BAO_Address', 'state_province_id', $fv['golfer_state_province'][$i]);
        $golfers['country_id'][$i] = CRM_Core_PseudoConstant::getLabel('CRM_Core_BAO_Address', 'country_id', $fv['golfer_country'][$i]);
      }
    }
    if (!empty($golfers['first_name'])) {
      $form->assign('golfers', $golfers);
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/MultipleGolfersPage.tpl',
      ));
    }

    if (empty($values['contributionId'])) {
      return;
    }

    if (!empty($fv['dinner_guests']) && ($participantID = $form->getVar('_participantId'))) {
      civicrm_api3('Participant', 'create', [
        'id' => $participantID,
        DINNER_GUESTS => $fv['dinner_guests'],
      ]);
    }

    if (!empty($fv[GOLFER_PF]) &&  array_key_exists(GOLFER_PFV, $fv[GOLFER_PF])) {
      $avg = (float) ($fv['amount'] / 4);
      $softCredits = [];
      for ($i = 2; $i <=4; $i++) {
        $softCredits[$i] = [];
        $addressParams = [
          'location_type_id' => 'Billing',
          'street_address' => $fv['golfer_street_address'][$i],
          'city' => $fv['golfer_city'][$i],
          'postal_code' => $fv['golfer_postal_code'][$i],
          'state_province_id' => $fv['golfer_state_province'][$i],
          'country_id' => $fv['golfer_country'][$i],
        ];
        // if (!empty($fv['golfer_supplemental_address_1'][$i])) {
        //  $addressParams['supplemental_address_1'] = $fv['golfer_supplemental_address_1'][$i];
        //}
        $params = [
          'first_name' => $fv['golfer_first_name'][$i],
          'last_name' => $fv['golfer_last_name'][$i],
          'contact_type' => 'Individual',
          'email' => $fv['golfer_email_address'][$i],
        ];
        $params['id'] = CRM_Utils_Array::value('id', civicrm_api3('Contact' , 'get', array_merge(
          $params,
          ['options' => ['limit' => 1]]
        )));
        $contactID = civicrm_api3('Contact' , 'create', $params)['id'];
        $addressParams['contact_id'] = $contactID;
        civicrm_api3('Address', 'create', $addressParams);
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

      // Check to see if receipts need to be split.
      if (!empty($fv['is_split_receipt'])) {
        $contribution = new CRM_Contribute_DAO_Contribution();
        $contribution->id = $values['contributionId'];
        $contribution->find(TRUE);

        $nullVar = NULL;
        cdntaxreceipts_issueTaxReceipt(
          $contribution,
          $nullVar,
          CDNTAXRECEIPTS_MODE_WORKFLOW,
          TRUE
        );
      }
      else {
        $contribution = new CRM_Contribute_DAO_Contribution();
        $contribution->id = $values['contributionId'];
        $contribution->find(TRUE);

        $nullVar = NULL;
        cdntaxreceipts_issueTaxReceipt(
          $contribution,
          $nullVar,
          CDNTAXRECEIPTS_MODE_WORKFLOW,
          FALSE,
          TRUE
        );
      }
    }
    else {
      // We send the receipt to the contributor.
      $contribution = new CRM_Contribute_DAO_Contribution();
      $contribution->id = $values['contributionId'];
      $contribution->find(TRUE);

      $nullVar = NULL;
      cdntaxreceipts_issueTaxReceipt(
        $contribution,
        $nullVar,
        CDNTAXRECEIPTS_MODE_WORKFLOW,
        FALSE,
        TRUE
      );
    }
  }

}

function aogolfevent_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  if ($objectName == "LineItem" && $op == "create" && $objectRef->entity_table == 'civicrm_participant') {
    $count = civicrm_api3('LineItem', 'getcount', [
      'entity_table' => 'civicrm_participant',
      'entity_id' => $objectRef->entity_id,
    ]);
    $dao = new CRM_Aogolfevent_DAO_EventContributionPF();
    $dao->price_field_id = $objectRef->price_field_id;
    $dao->find(TRUE);

    if ($count > 0 && !empty($dao->is_donation)) {
      if ($count == 0) {
        $objectRef->participant_count = 0;
        $participantDAO = new CRM_Event_BAO_Participant();
        $participantDAO->id = $objectRef->entity_id;
        $participantDAO->find(TRUE);
        $participantDAO->status_id = 18;
        $participantDAO->save();
      }
      CRM_Core_DAO::executeQuery("UPDATE civicrm_line_item SET participant_count = 0 WHERE id = $objectId ");
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
