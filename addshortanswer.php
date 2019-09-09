<?php
// This file is part of mod_interassign - http://moodle.org/
//
// mod_interassign is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// mod_interassign is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with mod_interassign.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Prints a particular instance of interassign
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    mod_interassign
 * @copyright  2016 Manuel Moscoso Dominguez <manuel.moscoso.d@gmail>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Replace interassign with the name of your module and remove this line.
//require_once(dirname(__FILE__).'classes/statement_form.php');
require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');
require_once(dirname(__FILE__).'/locallib.php');
require_once($CFG->dirroot . '/mod/interassign/classes/shortanswerform.php');

$param_interassign = optional_param('interassign', 0, PARAM_INT);


if($param_interassign) {
  $interassign  = $DB->get_record('interassign', array('id' => $param_interassign), '*', MUST_EXIST);
  $course     = $DB->get_record('course', array('id' => $interassign->course), '*', MUST_EXIST);
  $cm         = get_coursemodule_from_instance('interassign', $interassign->id, $course->id, false, MUST_EXIST);
} else {
  error('You must specify a course_module ID or an instance ID');
}


require_login($course, true, $cm);

$event = \mod_interassign\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $interassign);
$event->trigger();

// Print the page header.
$PAGE->set_url('/mod/interassign/edit.php');
$PAGE->set_title(format_string($interassign->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_cacheable(false);


$output = $PAGE->get_renderer('mod_interassign');
// Output starts here.

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('questionshort','interassign'));
echo $OUTPUT->heading("<hr>");


$showOption = 0;
// Initialise the form class
$action = new moodle_url('/mod/interassign/addshortanswer.php',array('interassign' => $param_interassign));
$mform = new interassign_shortanswer_form($action,
  array('interassignid'=>$param_interassign)
    );

// if ( $interassign ) {
//     $mform->set_data($interassign);
// }

if ($mform->is_cancelled()) {
    $cm         = get_coursemodule_from_instance('interassign', $interassign->id, $interassign->course, false, MUST_EXIST);
    $returnurl = new moodle_url('view.php',
      array('id' => $cm->id));
    redirect($returnurl);
}

if ($data = $mform->get_data() ){

  $short = new stdClass();
  $short->interassignid = $data->interassignid;
  $short->title        = $data->title;
  $short->detail       = $data->detail;
  $short->suggestion   = $data->suggestion;

  if(interassign_shortanswer_add_instance($short)){
    echo $output->notification_success(get_string('addshortanswerssuccess','interassign'));
    echo $OUTPUT->continue_button(new moodle_url('view.php', array('id' => $cm->id)));
    $showOption = 1;
  }
}

if ($showOption == 0)
  $mform->display();

echo '<hr>';
echo $OUTPUT->footer();
