<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ip2country filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class Baseip2countryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ip_to'         => new sfWidgetFormFilterInput(),
      'country_code2' => new sfWidgetFormFilterInput(),
      'country_code3' => new sfWidgetFormFilterInput(),
      'country_name'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ip_to'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'country_code2' => new sfValidatorPass(array('required' => false)),
      'country_code3' => new sfValidatorPass(array('required' => false)),
      'country_name'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ip2country_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ip2country';
  }

  public function getFields()
  {
    return array(
      'ip_from'       => 'Number',
      'ip_to'         => 'Number',
      'country_code2' => 'Text',
      'country_code3' => 'Text',
      'country_name'  => 'Text',
    );
  }
}
