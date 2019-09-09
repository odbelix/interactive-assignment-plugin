<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Prints a particular instance of interassign
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    mod_interassign
 * @copyright  2016 Your Name <your@email.address>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Replace interassign with the name of your module and remove this line.

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // ... interassign instance ID - it should be named as the first character of the module.
$enroll = optional_param('enroll', 0, PARAM_INT);
$participants =  optional_param('participants', 0, PARAM_INT);

if ($id) {
    $cm         = get_coursemodule_from_id('interassign', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $interassign  = $DB->get_record('interassign', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $interassign  = $DB->get_record('interassign', array('id' => $n), '*', MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $interassign->course), '*', MUST_EXIST);
    $cm         = get_coursemodule_from_instance('interassign', $interassign->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);



//Getting questions
$questionshort = $DB->get_records('interassign_shortanswer',array('interassignid' => $interassign->id));
$questiontrueorfalse = $DB->get_records('interassign_trueorfalse',array('interassignid' => $interassign->id));
$questionmultiplechoice = $DB->get_records('interassign_multiplechoice',array('interassignid' => $interassign->id));
$students = get_enrolled_users($PAGE->context, 'mod/interassign:view');
$totalstudents = count($students);



$event = \mod_interassign\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $interassign);
$event->trigger();

// Print the page header.

$PAGE->set_url('/mod/interassign/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($interassign->title));
$PAGE->set_heading(format_string($course->fullname));

/*
 * Other things you may want to set - remove if not needed.
 * $PAGE->set_cacheable(false);
 * $PAGE->set_focuscontrol('some-html-id');
 * $PAGE->add_body_class('interassign-'.$somevar);
 */

// Output starts here.
$output = $PAGE->get_renderer('mod_interassign');
echo $OUTPUT->header();

// Replace the following lines with you own code.
echo $OUTPUT->heading($interassign->name);
//Notifications

if ( $enroll ){
  if ( $enroll != 0 ) {
      $interassign->totalstudents = $totalstudents;
      if ( interassign_update_instance($interassign) ){
          echo $output->notification_success(get_string('enrollmentsuccess','interassign'));
      }
  }
}
if ( $participants ){
  if ( $participants != 0 ) {
      echo $output->notification_success(get_string('participantssuccess','interassign'));
  }
}

$buttons = array();


if ( $interassign->totalstudents != $totalstudents ) {
  echo $output->notification_error(get_string('outdatedstudents','interassign'));
  array_push($buttons,$output->interassign_url_link_button(array('interassign' => $interassign->id,'id' => $cm->id,'enroll' => 1),'view.php',get_string('enrollmentupdate', 'interassign')));
}

//buttons for Enrolment and update participants
array_push($buttons,$output->interassign_url_link_button(array('interassign' => $interassign->id,'id' => $cm->id, 'course' => $course->id,'participants' => 1),'editparticipants.php',get_string('participantsupdate', 'interassign')));


echo $output->interassign_group_button($buttons);
echo '<hr>';
echo $output->interassign_to_table($interassign,$questionshort,$questiontrueorfalse,$questionmultiplechoice);

//Question options
echo $output->interassign_url_link_button(array('interassign' => $interassign->id),'addshortanswer.php',get_string('create', 'interassign')." ".get_string('questionshort','interassign'));


//Active questions
echo '<hr>';
echo $OUTPUT->heading(get_string('activequestions','interassign'));
echo '<hr>';
//Table with active questions - title and options
if ( count($questionshort) != 0 ) {
  echo $output->interassign_active_shortanswerquestions_to_table($questionshort);
  echo '<br>';
}
if ( count($questiontrueorfalse) != 0 ) {
  echo $output->interassign_active_trueorfalsequestions_to_table($questiontrueorfalse);
  echo '<br>';
}
if ( count($questionmultiplechoice) != 0 ) {
  echo $output->interassign_active_multiplechoicequestions_to_table($questionmultiplechoice);
  echo '<br>';
}


// Finish the page.
echo $OUTPUT->footer();
