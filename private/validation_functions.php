<?php

function is_blank($value)
{
  return !isset($value) || trim($value) === '';
}

function has_presence($value)
{
  return !is_blank($value);
}

function has_length_greater_than($value, $min)
{
  $length = strlen($value);
  return $length > $min;
}
function has_length_less_than($value, $max)
{
  $length = strlen($value);
  return $length < $max;
}

function has_length_exactly($value, $exact)
{
  $length = strlen($value);
  return $length == $exact;
}

function has_length($value, $options)
{
  if (isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
    return false;
  } elseif (isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
    return false;
  } elseif (isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
    return false;
  } else {
    return true;
  }
}

function has_inclusion_of($value, $set)
{
  return in_array($value, $set);
}

function has_exclusion_of($value, $set)
{
  return !in_array($value, $set);
}

function has_string($value, $required_string)
{
  return strpos($value, $required_string) !== false;
}

function has_valid_email_format($value)
{
  $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
  return preg_match($email_regex, $value) === 1;
}

function has_valid_phone_number_format($value)
{
  $phone_number_regex = '/^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$/';
  return preg_match($phone_number_regex, $value) === 1;
}
function has_valid_postal_code_format($value)
{
  $postal_code_regex = '/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/';
  return preg_match($postal_code_regex, $value) === 1;
}

function has_unique_user_email($email, $current_id = "0")
{
  global $db;

  $sql = "SELECT * FROM users ";
  $sql .= "WHERE email='" . db_escape($db, $email) . "' ";
  $sql .= "AND id != '" . db_escape($db, $current_id) . "'";

  $user_set = mysqli_query($db, $sql);
  $user_count = mysqli_num_rows($user_set);
  mysqli_free_result($user_set);

  return $user_count === 0;
}
