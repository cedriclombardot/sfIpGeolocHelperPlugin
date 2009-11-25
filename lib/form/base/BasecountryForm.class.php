<?php

/**
 * country form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasecountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'iso'            => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInput(),
      'printable_name' => new sfWidgetFormInput(),
      'iso3'           => new sfWidgetFormInput(),
      'numcode'        => new sfWidgetFormInput(),
      'zone_ip_list'   => new sfWidgetFormPropelChoiceMany(array('model' => 'Zone')),
    ));

    $this->setValidators(array(
      'iso'            => new sfValidatorPropelChoice(array('model' => 'country', 'column' => 'iso', 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 80)),
      'printable_name' => new sfValidatorString(array('max_length' => 80)),
      'iso3'           => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'numcode'        => new sfValidatorInteger(array('required' => false)),
      'zone_ip_list'   => new sfValidatorPropelChoiceMany(array('model' => 'Zone', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'country', 'column' => array('name'))),
        new sfValidatorPropelUnique(array('model' => 'country', 'column' => array('printable_name'))),
      ))
    );

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'country';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['zone_ip_list']))
    {
      $values = array();
      foreach ($this->object->getZoneIps() as $obj)
      {
        $values[] = $obj->getZoneId();
      }

      $this->setDefault('zone_ip_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveZoneIpList($con);
  }

  public function saveZoneIpList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['zone_ip_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(ZoneIpPeer::PAYS_ID, $this->object->getPrimaryKey());
    ZoneIpPeer::doDelete($c, $con);

    $values = $this->getValue('zone_ip_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ZoneIp();
        $obj->setPaysId($this->object->getPrimaryKey());
        $obj->setZoneId($value);
        $obj->save();
      }
    }
  }

}
