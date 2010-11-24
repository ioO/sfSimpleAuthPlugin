<?php

/**
 * BasesfSimpleAuthSigninForm for sfSimpleAuth actions
 *
 * @package sfSimpleAuthPlugin
 * @subpackage sfForm
 * @author Lionel Chanson <lionel.chanson@particul.es>
 * @see sfForm
 *
 */

class BasesfSimpleAuthSigninForm extends BaseForm
{
  public function setup()
  {
   
    //set widgets
    $this->setWidget('username', new sfWidgetFormInputText());
    $this->setWidget('password', new sfWidgetFormInputPassword());

    //set validators
    $this->setValidator('username', new sfValidatorString());
    $this->setValidator('password', new sfValidatorString());

    //set a post validator to test username and password.
      $this->validatorSchema->setPostValidator(new sfSimpleAuthValidator());

    $this->widgetSchema->setNameFormat('signin[%s]');
  }
}
