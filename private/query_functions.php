<?php

// Find all admins, ordered last_name, first_name
function find_all_users()
{
  global $db;

  $sql = "SELECT * FROM users ";
  $sql .= "ORDER BY last_name ASC, first_name ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_user_by_id($id)
{
  global $db;

  $sql = "SELECT * FROM users ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $user = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $user; // returns an assoc. array
}

function find_user_by_email($email)
{
  global $db;

  $sql = "SELECT * FROM users ";
  $sql .= "WHERE email='" . db_escape($db, $email) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $user = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $user; // returns an assoc. array
}

function validate_user($user, $options = [])
{

  $password_required = $options['password_required'] ?? true;

  if (is_blank($user['first_name'])) {
    $errors[] = "First name cannot be blank.";
  } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
    $errors[] = "First name must be between 2 and 255 characters.";
  }

  if (is_blank($user['last_name'])) {
    $errors[] = "Last name cannot be blank.";
  } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Last name must be between 2 and 255 characters.";
  }

  if (is_blank($user['phone_number'])) {
    $errors[] = "Phone number cannot be blank.";
  } elseif (!has_length($user['phone_number'], array('min' => 2, 'max' => 12))) {
    $errors[] = "Phone number must be between 2 and 10 characters.";
  } elseif (!has_valid_phone_number_format($user['phone_number'])) {
    $errors[] = "Phone number must be a valid format.";
  }

  if (is_blank($user['email'])) {
    $errors[] = "Email cannot be blank.";
  } elseif (!has_length($user['email'], array('max' => 255))) {
    $errors[] = "Last name must be less than 255 characters.";
  } elseif (!has_valid_email_format($user['email'])) {
    $errors[] = "Email must be a valid format.";
  } elseif (!has_unique_user_email($user['email'], $user['id'] ?? 0)) {
    $errors[] = "Email not allowed. Try another.";
  }

  if ($password_required) {
    if (is_blank($user['password'])) {
      $errors[] = "Password cannot be blank.";
    } elseif (!has_length($user['password'], array('min' => 12))) {
      $errors[] = "Password must contain 12 or more characters";
    } elseif (!preg_match('/[A-Z]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 uppercase letter";
    } elseif (!preg_match('/[a-z]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 lowercase letter";
    } elseif (!preg_match('/[0-9]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 number";
    } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 symbol";
    }

    // if (is_blank($user['confirm_password'])) {
    //   $errors[] = "Confirm password cannot be blank.";
    // } elseif ($user['password'] !== $user['confirm_password']) {
    //   $errors[] = "Password and confirm password must match.";
    // }
  }
  if (is_blank($user['street'])) {
    $errors[] = "Address cannot be blank.";
  } elseif (!has_length($user['street'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Address must be between 2 and 255 characters.";
  }

  if (is_blank($user['city'])) {
    $errors[] = "City cannot be blank.";
  } elseif (!has_length($user['city'], array('min' => 2, 'max' => 255))) {
    $errors[] = "City must be between 2 and 255 characters.";
  }

  if (is_blank($user['province'])) {
    $errors[] = "Province cannot be blank.";
  } elseif (!has_length($user['province'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Province must be between 2 and 255 characters.";
  }

  if (is_blank($user['postal_code'])) {
    $errors[] = "Postal code cannot be blank.";
  } elseif (!has_length($user['postal_code'], array('max' => 7))) {
    $errors[] = "Last name must be less than 7 characters.";
  } elseif (!has_valid_postal_code_format($user['postal_code'])) {
    $errors[] = "Postal Code must be a valid format.";
  }


  return $errors;
}

function insert_user($user)
{
  global $db;

  $errors = validate_user($user);
  if (!empty($errors)) {
    return $errors;
  }

  $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

  $sql = "INSERT INTO users ";
  $sql .= "(first_name, last_name, phone_number, email, hashed_password, street, city, province, postal_code) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $user['first_name']) . "',";
  $sql .= "'" . db_escape($db, $user['last_name']) . "',";
  $sql .= "'" . db_escape($db, $user['phone_number']) . "',";
  $sql .= "'" . db_escape($db, $user['email']) . "',";
  $sql .= "'" . db_escape($db, $hashed_password) . "',";
  $sql .= "'" . db_escape($db, $user['street']) . "',";
  $sql .= "'" . db_escape($db, $user['city']) . "',";
  $sql .= "'" . db_escape($db, $user['province']) . "',";
  $sql .= "'" . db_escape($db, $user['postal_code']) . "'";

  $sql .= ")";
  $result = mysqli_query($db, $sql);

  // For INSERT statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_user($user)
{
  global $db;

  $password_sent = !is_blank($user['password']);

  $errors = validate_user($user, ['password_required' => $password_sent]);
  if (!empty($errors)) {
    return $errors;
  }

  $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

  $sql = "UPDATE users SET ";
  $sql .= "first_name='" . db_escape($db, $user['first_name']) . "', ";
  $sql .= "last_name='" . db_escape($db, $user['last_name']) . "', ";
  $sql .= "phone_number='" . db_escape($db, $user['phone_number']) . "', ";
  $sql .= "email='" . db_escape($db, $user['email']) . "', ";
  if ($password_sent) {
    $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
  }
  $sql .= "street='" . db_escape($db, $user['street']) . "', ";
  $sql .= "city='" . db_escape($db, $user['city']) . "', ";
  $sql .= "province='" . db_escape($db, $user['province']) . "', ";
  $sql .= "postal_code='" . db_escape($db, $user['postal_code']) . "' ";
  $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);

  // For UPDATE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function delete_user($admin)
{
  global $db;

  $sql = "DELETE FROM admins ";
  $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
  $sql .= "LIMIT 1;";
  $result = mysqli_query($db, $sql);

  // For DELETE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // DELETE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function find_all_providers()
{
  global $db;

  $sql = "SELECT * FROM providers ";
  $sql .= "ORDER BY first_name ASC, last_name ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function search_providers($query)
{
  global $db;

  $sql = "SELECT * FROM providers ";
  $sql .= "WHERE business_name LIKE '%" . db_escape($db, $query) . "%' OR ";
  $sql .= "city LIKE '%" . db_escape($db, $query) . "%' OR ";
  $sql .= "profession LIKE '%" . db_escape($db, $query) . "%' OR ";
  $sql .= "preferred_area LIKE '%" . db_escape($db, $query) . "%' OR ";
  $sql .= "available LIKE '%" . db_escape($db, $query) . "%'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result; // returns an assoc. array
}

function find_provider_by_id($id)
{
  global $db;

  $sql = "SELECT * FROM providers ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $provider = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $provider; // returns an assoc. array
}

function find_provider_by_email($email)
{
  global $db;

  $sql = "SELECT * FROM providers ";
  $sql .= "WHERE email='" . db_escape($db, $email) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $provider = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $provider; // returns an assoc. array
}

function validate_provider($provider, $options = [])
{

  $password_required = $options['password_required'] ?? true;

  if (is_blank($provider['first_name'])) {
    $errors[] = "First name cannot be blank.";
  } elseif (!has_length($provider['first_name'], array('min' => 2, 'max' => 255))) {
    $errors[] = "First name must be between 2 and 255 characters.";
  }

  if (is_blank($provider['last_name'])) {
    $errors[] = "Last name cannot be blank.";
  } elseif (!has_length($provider['last_name'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Last name must be between 2 and 255 characters.";
  }

  if (is_blank($provider['phone_number'])) {
    $errors[] = "Phone number cannot be blank.";
  } elseif (!has_length($provider['phone_number'], array('min' => 2, 'max' => 12))) {
    $errors[] = "Phone number must be between 2 and 10 characters.";
  } elseif (!has_valid_phone_number_format($provider['phone_number'])) {
    $errors[] = "Phone number must be a valid format.";
  }

  if (is_blank($provider['email'])) {
    $errors[] = "Email cannot be blank.";
  } elseif (!has_length($provider['email'], array('max' => 255))) {
    $errors[] = "Last name must be less than 255 characters.";
  } elseif (!has_valid_email_format($provider['email'])) {
    $errors[] = "Email must be a valid format.";
  } elseif (!has_unique_user_email($provider['email'], $provider['id'] ?? 0)) {
    $errors[] = "Email not allowed. Try another.";
  }


  if (is_blank($provider['business_name'])) {
    $errors[] = "Business name cannot be blank.";
  } elseif (!has_length($provider['business_name'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Business name must be between 2 and 255 characters.";
  }


  if (is_blank($provider['street'])) {
    $errors[] = "Address cannot be blank.";
  } elseif (!has_length($provider['street'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Address must be between 2 and 255 characters.";
  }

  if (is_blank($provider['city'])) {
    $errors[] = "City cannot be blank.";
  } elseif (!has_length($provider['city'], array('min' => 2, 'max' => 255))) {
    $errors[] = "City must be between 2 and 255 characters.";
  }

  if (is_blank($provider['province'])) {
    $errors[] = "Province cannot be blank.";
  } elseif (!has_length($provider['province'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Province must be between 2 and 255 characters.";
  }

  if (is_blank($provider['postal_code'])) {
    $errors[] = "Postal code cannot be blank.";
  } elseif (!has_length($provider['postal_code'], array('max' => 7))) {
    $errors[] = "Last name must be less than 7 characters.";
  } elseif (!has_valid_postal_code_format($provider['postal_code'])) {
    $errors[] = "Postal Code must be a valid format.";
  }

  if (is_blank($provider['profession'])) {
    $errors[] = "Profession cannot be blank.";
  } elseif (!has_length($provider['province'], array('min' => 2, 'max' => 255))) {
    $errors[] = "profession must be between 2 and 255 characters.";
  }

  if (is_blank($provider['preferred_area'])) {
    $errors[] = "Preferred Area cannot be blank.";
  } elseif (!has_length($provider['preferred_area'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Preferred Area must be between 2 and 255 characters.";
  }
  if (is_blank($provider['available'])) {
    $errors[] = "Availability cannot be blank.";
  } elseif (!has_length($provider['available'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Availability must be between 2 and 255 characters.";
  }
  if (is_blank($provider['price_per_hour'])) {
    $errors[] = "Price cannot be blank.";
  } elseif (!has_length($provider['price_per_hour'], array('min' => 2, 'max' => 5))) {
    $errors[] = "Price must be between 2 and 5 characters.";
  }

  if ($password_required) {
    if (is_blank($provider['password'])) {
      $errors[] = "Password cannot be blank.";
    } elseif (!has_length($provider['password'], array('min' => 12))) {
      $errors[] = "Password must contain 12 or more characters";
    } elseif (!preg_match('/[A-Z]/', $provider['password'])) {
      $errors[] = "Password must contain at least 1 uppercase letter";
    } elseif (!preg_match('/[a-z]/', $provider['password'])) {
      $errors[] = "Password must contain at least 1 lowercase letter";
    } elseif (!preg_match('/[0-9]/', $provider['password'])) {
      $errors[] = "Password must contain at least 1 number";
    } elseif (!preg_match('/[^A-Za-z0-9\s]/', $provider['password'])) {
      $errors[] = "Password must contain at least 1 symbol";
    }

    // if (is_blank($user['confirm_password'])) {
    //   $errors[] = "Confirm password cannot be blank.";
    // } elseif ($user['password'] !== $user['confirm_password']) {
    //   $errors[] = "Password and confirm password must match.";
    // }
  }
  return $errors;
}

function insert_provider($provider)
{
  global $db;

  $errors = validate_provider($provider);
  if (!empty($errors)) {
    return $errors;
  }

  $hashed_password = password_hash($provider['password'], PASSWORD_BCRYPT);

  $sql = "INSERT INTO providers ";
  $sql .= "(first_name, last_name, phone_number, email, hashed_password, business_name, street, city, province, postal_code, profession, preferred_area, available, price_per_hour) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $provider['first_name']) . "',";
  $sql .= "'" . db_escape($db, $provider['last_name']) . "',";
  $sql .= "'" . db_escape($db, $provider['phone_number']) . "',";
  $sql .= "'" . db_escape($db, $provider['email']) . "',";
  $sql .= "'" . db_escape($db, $hashed_password) . "',";
  $sql .= "'" . db_escape($db, $provider['business_name']) . "',";
  $sql .= "'" . db_escape($db, $provider['street']) . "',";
  $sql .= "'" . db_escape($db, $provider['city']) . "',";
  $sql .= "'" . db_escape($db, $provider['province']) . "',";
  $sql .= "'" . db_escape($db, $provider['postal_code']) . "',";
  $sql .= "'" . db_escape($db, $provider['profession']) . "',";
  $sql .= "'" . db_escape($db, $provider['preferred_area']) . "',";
  $sql .= "'" . db_escape($db, $provider['available']) . "',";
  $sql .= "'" . db_escape($db, $provider['price_per_hour']) . "'";

  $sql .= ")";
  $result = mysqli_query($db, $sql);

  // For INSERT statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_provider($provider)
{
  global $db;

  $password_sent = !is_blank($provider['password']);

  $errors = validate_user($provider, ['password_required' => $password_sent]);
  if (!empty($errors)) {
    return $errors;
  }

  $hashed_password = password_hash($provider['password'], PASSWORD_BCRYPT);

  $sql = "UPDATE providers SET ";
  $sql .= "first_name='" . db_escape($db, $provider['first_name']) . "', ";
  $sql .= "last_name='" . db_escape($db, $provider['last_name']) . "', ";
  $sql .= "phone_number='" . db_escape($db, $provider['phone_number']) . "', ";
  $sql .= "email='" . db_escape($db, $provider['email']) . "', ";
  if ($password_sent) {
    $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
  }
  $sql .= "business_name='" . db_escape($db, $provider['business_name']) . "', ";
  $sql .= "street='" . db_escape($db, $provider['street']) . "', ";
  $sql .= "city='" . db_escape($db, $provider['city']) . "', ";
  $sql .= "province='" . db_escape($db, $provider['province']) . "', ";
  $sql .= "postal_code='" . db_escape($db, $provider['postal_code']) . "', ";
  $sql .= "profession='" . db_escape($db, $provider['profession']) . "', ";
  $sql .= "preferred_area='" . db_escape($db, $provider['preferred_area']) . "', ";
  $sql .= "available='" . db_escape($db, $provider['available']) . "', ";
  $sql .= "price_per_hour='" . db_escape($db, $provider['price_per_hour']) . "' ";
  $sql .= "WHERE id='" . db_escape($db, $provider['id']) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);

  // For UPDATE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function find_booking_by_id($id)
{
  global $db;

  $sql = "SELECT * FROM bookings ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $booking = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $booking; // returns an assoc. array
}

function validate_booking($booking)
{
  $errors = [];

  // menu_name
  if (is_blank($booking['user_id'])) {
    $errors[] = "Login.";
  } elseif (!has_length($booking['user_id'], ['min' => 2, 'max' => 255])) {
    $errors[] = "Login.";
  }
  if (is_blank($booking['provider_id'])) {
    $errors[] = "Login.";
  } elseif (!has_length($booking['provider_id'], ['min' => 2, 'max' => 255])) {
    $errors[] = "Login.";
  }
  if (is_blank($booking['date'])) {
    $errors[] = "Pick a date.";
  } elseif (!has_length($booking['date'], ['min' => 2, 'max' => 255])) {
    $errors[] = "Pick a valid date.";
  }
  if (is_blank($booking['time'])) {
    $errors[] = "Choose a time.";
  } elseif (!has_length($booking['time'], ['min' => 2, 'max' => 255])) {
    $errors[] = "Choose a valid time.";
  }


  return $errors;
}


function insert_booking($booking)
{
  global $db;

  // $errors = validate_booking($booking);
  // if (!empty($errors)) {
  //   return $errors;
  // }

  $sql = "INSERT INTO bookings ";
  $sql .= "(user_id, provider_id, date, time) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $booking['user_id']) . "',";
  $sql .= "'" . db_escape($db, $booking['provider_id']) . "',";
  $sql .= "'" . db_escape($db, $booking['date']) . "',";
  $sql .= "'" . db_escape($db, $booking['time']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function find_booked_time($date)
{
  // global $db;

  // $stmt = $db->prepare("SELECT * FROM bookings WHERE date = ?");
  // $stmt->bind_param('s', $date);
  // $bookings = array();
  // if ($stmt->execute()) {
  //   $result = $stmt->get_result();
  //   return $result;
  // }
  global $db;

  $sql = "SELECT * FROM bookings ";
  $sql .= "WHERE date='" . db_escape($db, $date) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}


function find_user_bookings($user_id)
{
  global $db;

  $sql = "SELECT * FROM bookings ";
  $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result; // returns an assoc. array
}

function find_bookings($user_id, $provider_id)
{
  global $db;

  $sql = "SELECT * FROM bookings ";
  $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' AND ";
  $sql .= "provider_id='" . db_escape($db, $provider_id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result; // returns an assoc. array
}

function find_provider_bookings($id)
{
  global $db;

  $sql = "SELECT * FROM bookings ";
  $sql .= "WHERE provider_id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result; // returns an assoc. array
}

function delete_booking($booking)
{
  global $db;

  $sql = "DELETE FROM bookings ";
  $sql .= "WHERE id='" . db_escape($db, $booking['id']) . "' ";
  $sql .= "LIMIT 1;";
  $result = mysqli_query($db, $sql);

  // For DELETE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // DELETE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
