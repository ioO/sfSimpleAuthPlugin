<?php

include dirname(__FILE__).'/../../../../test/bootstrap/unit.php';


/**
 * A test class to push signin values that aren't getted from app.yml
 * by unittest
 * 
 */

class testsfSimpleAuthValidator extends sfSimpleAuthValidator
{
  public static $values;

  protected function getSigninValues()
  {
    return self::$values;
  }

}

$t = new lime_test(10);

$v = new testsfSimpleAuthValidator();

$t->diag('->clean()');
$t->can_ok($v, 'clean', '->clean() is avaible');

$t->diag('test without encryption');

testsfSimpleAuthValidator::$values = array(
      'username' => 'username',
      'password' => 'password',
      'encryption' => null,
    );

try
{
  $values = $v->clean(array( 'username' => 'username', 'password' => 'password'));
  $t->pass('->clean() does not throw an error if signin values are right');
  $t->isa_ok($values, 'array', '->clean() return an "array" with cleaned values');
}
catch ( sfValidatorErrorSchema $e )
{
  $t->fail('->clean() does not throw an error if signin values are right');
}

try
{
  $values = $v->clean(array( 'username' => 'username', 'password' => 'wrong'));
  $t->fail('->clean() throw an error if signin values are wrong');
}
catch ( sfValidatorErrorSchema $e )
{
  $t->pass('->clean() throw an error if signin values are wrong');
  $t->is($e->getCode(), 'invalid', '->clean() throw and invalid error');
}

$t->diag('test with encryption');

testsfSimpleAuthValidator::$values = array(
      'username' => 'username',
      'password' => '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',
      'encryption' => 'sha1',
    );

try
{
  $values = $v->clean(array( 'username' => 'username', 'password' => 'password'));
  $t->pass('->clean() does not throw an error if signin values are right');
}
catch ( sfValidatorErrorSchema $e )
{
  $t->fail('->clean() does not throw an error if signin values are right');
}

try
{
  $values = $v->clean(array( 'username' => 'username', 'password' => 'wrong'));
  $t->fail('->clean() throw an error if signin values are wrong');
}
catch ( sfValidatorErrorSchema $e )
{
  $t->pass('->clean() throw an error if signin values are wrong');
  $t->is($e->getCode(), 'invalid', '->clean() throw and invalid error');
}

$t->diag('test with an unknow encryption');

testsfSimpleAuthValidator::$values = array(
      'username' => 'username',
      'password' => '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',
      'encryption' => 'mybadcrypt',
    );

try
{
  $values = $v->clean(array( 'username' => 'username', 'password' => 'password'));
  $t->fail('->clean() throw an sfException due to unknow encryption function');
}
catch ( sfException $e )
{
  $t->pass('->clean() throw an sfException due to unknow encryption function');
  $t->skip($e->getMessage());
}