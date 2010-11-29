<?php

include(dirname(__FILE__).'/../../../../../test/bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  restart()->
  get('/signin')->info('action has to be forwarded')->isForwardedTo('sfSimpleAuth', 'signin')->
        
  get('/signin')->info('Call signin form')->

  with('request')->begin()->
    isParameter('module', 'sfSimpleAuth')->
    isParameter('action', 'signin')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkForm('sfSimpleAuthSigninForm')->
    checkElement('input[type=submit]')->
    checkElement('p', 'Signin Partial')->
  end()->

  info('Submit empty form')->
  click('input[type=submit]', array('signin' => array(
    'username'  =>  '',
    'password'  =>  ''
  )))->

  with('form')->begin()->
    hasErrors(3)->
    hasGlobalError('invalid')->
    isError('username', 'required')->
    isError('password', 'required')->
  end()->

  info('Submit form without username')->

  click('input[type=submit]', array('signin' => array(
    'username'  =>  '',
    'password'  =>  'password'
  )))->

  with('form')->begin()->
    hasErrors(2)->
    hasGlobalError('invalid')->
    isError('username', 'required')->
  end()->

  info('Submit form without password')->

  click('input[type=submit]', array('signin' => array(
    'username'  =>  'username',
    'password'  =>  ''
  )))->

  with('form')->begin()->
    hasErrors(2)->
    hasGlobalError('invalid')->
    isError('password', 'required')->
  end()->
        
  info('Submit form with bad password')->

  click('input[type=submit]', array('signin' => array(
    'username'  =>  'username',
    'password'  =>  'passwor'
  )))->

  with('form')->begin()->
    hasErrors(1)->
    hasGlobalError('invalid')->
  end()->

  info('Submit form with bad id')->

  click('input[type=submit]', array('signin' => array(
    'username'  =>  'usernam',
    'password'  =>  'password'
  )))->

  with('form')->begin()->
    hasErrors(1)->
    hasGlobalError('invalid')->
  end()->

  info('Test with good ids')->

  click('input[type=submit]', array('signin' => array(
    'username'  =>  'username',
    'password'  =>  'password'
  )))->

  with('form')->hasErrors(false)->
  with('user')->isAuthenticated()->

 info('Test signout')->
  get('/signout')->

  with('request')->begin()->
    isParameter('module', 'sfSimpleAuth')->
    isParameter('action', 'signout')->
  end()->

  with('response')->isRedirected()->

  with('user')->isAuthenticated(false);