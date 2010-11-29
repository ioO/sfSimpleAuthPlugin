<?php

/**
 * sf_simple_auth actions.
 *
 * @package    etamin
 * @subpackage sf_simple_auth
 * @author     Lionel Chanson <lionel@etamin-project.org>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BasesfSimpleAuthActions extends sfActions
{

  /**
   * Check signin form and setAuthentification to user.
   * If set in app, it uses another template.
   *
   * @param sfRequest $request A request object
   */
  public function executeSignin( sfWebRequest $request )
  {
    $this->template = $this->setSimpleAuthTemplate(sfConfig::get('app_sf_simple_auth_template'));

    $this->form = new sfSimpleAuthSigninForm();

    if ( $request->isMethod('post') )
    {
      $this->processForm($this->form, $request);
    }
  }

  /**
   * Unauthentificates current user.
   *
   */
  public function executeSignout( sfWebRequest $request )
  {
    $this->getUser()->setAuthenticated(false);
    $this->redirect('@sf_simple_auth_signin');
  }

  /**
   * Process signinForm
   *
   * @param sfSimpleAuthSigninForm $form
   * @param sfWebRequest $request
   * @return boolean|sfForm errors
   */
  protected function processForm( sfForm $form, sfWebRequest $request )
  {
    $form->bind($request->getPostParameter('signin'));

    if ( $form->isValid() )
    {
      $this->getUser()->setAuthenticated(true);
      $this->redirect('@homepage');
    }
  }

  /**
   * Get template params and set specific template.
   * Throw sfConfigurationException if template params is not well formed.
   *
   * @param Array $conf template params in configuration
   * @return sfView A template path.
   */
  protected function setSimpleAuthTemplate($conf)
  {
    //template params is an array with module, action values
    if( count($conf) == 2)
    {
      return sprintf('%s/%s', $conf[0], $conf[1]);
    }
    //template params is no well formed
    else if( count($conf) != 0 )
    {
      $message = sprintf('sfSimpleAuth template configuration param is a YAML array like [module,partial]');
      throw new sfConfigurationException($message);
    }
    return null;
  }
}
