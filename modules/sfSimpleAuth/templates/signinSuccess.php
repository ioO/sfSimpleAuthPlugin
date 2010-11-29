<?php use_helper('I18N') ?>
<?php if( !is_null($template) ) : ?>
  <?php include_partial($template, array('form' => $form)) ?>
<?php else : ?>
  <form action="<?php echo url_for('@sf_simple_auth_signin') ?>" method="post" id="signinForm">
    <table>
      <?php echo $form ?>
    </table>
    <input type="submit" value="<?php echo __('Signin') ?>" />
  </form>
<?php endif; ?>