<?php
use CRM_Aogolfevent_ExtensionUtil as E;

class CRM_Aogolfevent_BAO_EventContributionPF extends CRM_Aogolfevent_DAO_EventContributionPF {

  /**
   * Create a new EventContributionPF based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Aogolfevent_DAO_EventContributionPF|NULL
   *
  public static function create($params) {
    $className = 'CRM_Aogolfevent_DAO_EventContributionPF';
    $entityName = 'EventContributionPF';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */

}
