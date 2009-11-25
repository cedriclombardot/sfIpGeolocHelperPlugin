<?php

/**
 * ip2country form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class Baseip2countryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ip_from'       => new sfWidgetFormInputHidden(),
      'ip_to'         => new sfWidgetFormInput(),
      'country_code2' => new sfWidgetFormInput(),
      'country_code3' => new sfWidgetFormInput(),
      'country_name'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ip_from'       => new sfValidatorPropelChoice(array('model' => 'ip2country', 'column' => 'ip_from', 'required' => false)),
      'ip_to'         => new sfValidatorInteger(array('required' => false)),
      'country_code2' => new sfValidatorString(array('max_length' => 2)),
      'country_code3' => new sfValidatorString(array('max_length' => 2)),
      'country_name'  => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('ip2country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ip2country';
  }


}
