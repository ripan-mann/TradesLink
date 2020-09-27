<?php

// Performs all actions necessary to log in an admin
function log_in_user($user)
{
  // Renerating the ID protects the admin from session fixation.
  session_regenerate_id();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['last_login'] = time();
  $_SESSION['first_name'] = $user['first_name'];
  return true;
}
function log_in_provider($provider)
{
  // Renerating the ID protects the admin from session fixation.
  session_regenerate_id();
  $_SESSION['provider_id'] = $provider['id'];
  $_SESSION['last_login'] = time();
  $_SESSION['business_name'] = $provider['business_name'];
  return true;
}

function log_out()
{
  if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['first_name']);
  } elseif (isset($_SESSION['provider_id'])) {
    unset($_SESSION['provider_id']);
    unset($_SESSION['business_name']);
  }
  unset($_SESSION['last_login']);

  return true;
}

function is_logged_in()
{
  if (isset($_SESSION['user_id'])) {
    return true;
  } elseif (isset($_SESSION['provider_id'])) {
    return true;
  } else {
    return false;
  }
}

function require_login()
{
  if (!is_logged_in()) {
    redirect_to(url_for('/account/login.php'));
  }
}
