<?php 
function timeAgo($time_ago) {
    $cur_time = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
    $returnable = "";
// Seconds
    if ($seconds <= 60) {
        $returnable = "$seconds seconds ago";
    }
//Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            $returnable = "one minute ago";
        } else {
            $returnable = "$minutes minutes ago";
        }
    }
//Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            $returnable = "an hour ago";
        } else {
            $returnable = "$hours hours ago";
        }
    }
//Days
    else if ($days <= 7) {
        if ($days == 1) {
            $returnable = "yesterday";
        } else {
            $returnable = "$days days ago";
        }
    }
//Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            $returnable = "a week ago";
        } else {
            $returnable = "$weeks weeks ago";
        }
    }
//Months
    else if ($months <= 12) {
        if ($months == 1) {
            $returnable = "a month ago";
        } else {
            $returnable = "$months months ago";
        }
    }
//Years
    else {
        if ($years == 1) {
            $returnable = "one year ago";
        } else {
            $returnable = "$years years ago";
        }
    }
    return $returnable;
}
?>
