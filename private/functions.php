<?php

function url_for($script_path)
{
  // add the leading '/' if not present
  if ($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string = "")
{
  return urlencode($string);
}

function raw_u($string = "")
{
  return rawurlencode($string);
}

function h($string = "")
{
  return htmlspecialchars($string);
}

function error_404()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location)
{
  header("Location: " . $location);
  exit;
}

function is_post_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors = array())
{
  $output = '';
  if (!empty($errors)) {
    $output .= "<div class=\"alert alert-danger\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach ($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function get_and_clear_session_message()
{
  if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    return $msg;
  }
}

function display_session_message()
{
  $msg = get_and_clear_session_message();
  if (!is_blank($msg)) {
    return '<div id="message">' . h($msg) . '</div>';
  }
}

function build_calendar($month, $year, $id)
{



  $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

  $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

  $numberDays = date('t', $firstDayOfMonth);

  $dateComponents = getdate($firstDayOfMonth);

  $monthName = $dateComponents['month'];

  $dayOfWeek = $dateComponents['wday'];

  $dateToday = date('Y-m-d');

  $prev_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
  $prev_year = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
  $next_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
  $next_year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));

  $calendar = "<center><h2>$monthName $year</h2><center>";

  $calendar .= "<br><table class='table table-bordered'>";
  $calendar .= "<tr>";

  foreach ($daysOfWeek as $day) {
    $calendar .= "<th class'header'> $day</th>";
  }
  $calendar .= "</tr><tr>";

  $currentDay = 1;

  if ($dayOfWeek > 0) {
    for ($k = 0; $k < $dayOfWeek; $k++) {
      $calendar .= "<td></td>";
    }
  }

  $month = str_pad($month, 2, "0", STR_PAD_LEFT);

  while ($currentDay <= $numberDays) {


    if ($dayOfWeek == 7) {
      $dayOfWeek = 0;
      $calendar .= "</tr><tr>";
    }

    $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
    $date = "$year-$month-$currentDayRel";
    $dayName = strtolower(date('l', strtotime($date)));
    $today = ($date === date('Y-m-d')) ? 'today' : '';
    if ($date < $dateToday) {
      $calendar .= "<td class='$today'><h4>$currentDay </h4> <button class='btn btn-danger btn-xs'>N/A</button> </td>";
    } else {
      $calendar .= "<td class='$today'><h4>$currentDay </h4> <a href='time.php?id=" . h(u($id)) . "&date=" . h(u($date)) . "' class='btn btn-success btn-xs'>Book</a> </td>";
    }
    $currentDay++;
    $dayOfWeek++;
  }

  if ($dayOfWeek < 7) {
    $remainingDays = 7 - $dayOfWeek;

    for ($i = 0; $i < $remainingDays; $i++) {
      $calendar .= "<td class='empty'></td>";
    }
  }

  $calendar .= "</tr></table>";
  $calendar .= "<a class='btn btn-xs btn-primary mb-2 mr-4' href='?id=" . h(u($id)) . "&month=" . h(u($prev_month)) . "&year=" . h(u($prev_year)) . "'>Previous Month</a> ";

  $calendar .= "<a class='btn btn-xs btn-primary mb-2' href='?id=" . h(u($id)) . "&month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a> ";

  $calendar .= "<a class='btn btn-xs btn-primary mb-2 ml-4' href='?id=" . h(u($id)) . "&month=" . h(u($next_month)) . "&year=" . h(u($next_year)) . "'>Next Month</a><br/>";

  echo $calendar;
}



function timeslots($duration, $cleanup, $start, $end)
{
  $start = new DateTime($start);
  $end = new DateTime($end);
  $interval = new DateInterval("PT" . $duration . "M");
  $clean_up_interval = new DateInterval("PT" . $cleanup . "M");
  $slot = array();

  for ($int_start = $start; $int_start < $end; $int_start->add($interval)->add($clean_up_interval)) {
    $end_period = clone $int_start;
    $end_period->add($interval);
    if ($end_period > $end) {
      break;
    }

    $slots[] = $int_start->format("H:iA") . "-" . $end_period->format("H:iA");
  }
  return $slots;
}
