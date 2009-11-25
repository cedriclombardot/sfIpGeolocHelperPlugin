<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * country filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasecountryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(),
      'printable_name' => new sfWidgetFormFilterInput(),
      'iso3'           => new sfWidgetFormFilterInput(),
      'numcode'        => new sfWidgetFormFilterInput(),
      'zone_ip_list'   => new sfWidgetFormPropelChoice(array('model' => 'Zone', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'printable_name' => new sfValidatorPass(array('required' => false)),
      'iso3'           => new sfValidatorPass(array('required' => false)),
      'numcode'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'zone_ip_list'   => new sfValidatorPropelChoice(array('model' => 'Zone', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('country_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addZoneIpListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(ZoneIpPeer::PAYS_ID, countryPeer::ISO);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(ZoneIpPeer::ZONE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(ZoneIpPeer::ZONE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'country';
  }

  public function getFields()
  {
    return array(
      'iso'            => 'Text',
      'name'           => 'Text',
      'printable_name' => 'Text',
      'iso3'           => 'Text',
      'numcode'        => 'Number',
      'zone_ip_list'   => 'ManyKey',
    );
  }
}
