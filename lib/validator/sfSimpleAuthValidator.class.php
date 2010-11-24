<?php

/**
 * sfSimpleAuthSigninForm for sfSimpleAuth actions
 *
 * @package sfSimpleAuthPlugin
 * @subpackage sfValidator
 * @author Lionel Chanson <lionel.chanson@particul.es>
 * @see sfValidatorBase
 *
 */
class sfSimpleAuthValidator extends sfValidatorBase
{

  /**
   * Add a custom message for invalid.
   *
   * @param Array $options
   * @param Array $messages
   */
  public function configure( $options = array( ), $messages = array( ) )
  {

    //override invalid message
    $this->setMessage('invalid', 'username and/or password is invalid');
  }

  /**
   * Test username and password values.
   *
   * @param Array $value an array with submited values.
   */
  protected function doClean( $values )
  {
    //get signin values.
    $signinValues = $this->getSigninValues();

    //username is ok ?
    if ( $signinValues['username'] == $values['username'] )
    {
      //password is encrypted in app.yml
      $password = !is_null($signinValues['encryption']) ?
                      $this->encryptPasswordValue($values['password'], $signinValues['encryption']) : $values['password'];

      //password is ok ?
      if ( $password == $signinValues['password'] )
      {
        return $values;
      }
    }

    throw new sfValidatorErrorSchema($this,
            array( new sfValidatorError($this, 'invalid') ));
  }

  /**
   * Return a hash string of password input by encryption method.
   * 
   * @param string $password password input value in form
   * @return string
   */
  protected function encryptPasswordValue( $password, $encryption )
  {
    $function = $encryption;

    //function is not callable php extension not loaded ?
    if ( !is_callable($function) )
    {
      throw new sfException(sprintf('Function "%s" is not callable', $function));
    }

    return call_user_func($function, $password);
  }

  protected function getSigninValues()
  {
    return array(
      'username' => sfConfig::get('app_sf_simple_auth_username'),
      'password' => sfConfig::get('app_sf_simple_auth_password'),
      'encryption' => sfConfig::get('app_sf_simple_auth_encryption')
      );
  }

}

?>
