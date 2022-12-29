<?php

if (!isset($_POST['username-input']) ||
    !isset($_POST['email-input']) ||
    !isset($_POST['password-input']) ||
    !isset($_POST['password-input-retype'])) {

    //redirect
    die();
  }

