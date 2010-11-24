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
   *
   * @param sfRequest $request A request object
   */
  public function executeSignin( sfWebRequest $request )
  {
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
}
