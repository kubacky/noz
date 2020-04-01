<?php
/*
 * Default config values to run the application
 * int slide_time - time to show single slide in seconds
 * image_width - pixel width of the image
 * image_height - pixel height of the image
 * int offer_launch_day - day of the week on which the offer should start (Sun = 0, Mon = 1,...)
 * int offer_duration_time - duration of the offer in days
 * bool offer_needs_approval - the addition of an offer must be accepted by the administrator
 */
$config = [
    'slide_time' => 10,
    'image_width' => 600,
    'image_height' => 500,
    'offer_launch_day' => 3,
    'offer_duration_time' => 7,
    'offer_needs_approval'=> false
];