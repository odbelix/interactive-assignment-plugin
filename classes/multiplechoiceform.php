<?php
/**
 * Defines the mod_progassign forum used to add random questions to the quiz.
 *
 * @package   mod_progassign
 * @copyright 2016 Manuel Alejandro Moscoso Dominguez
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir.'/formslib.php');

class interassign_participants_update_form extends moodleform {

    protected function definition() {
        global $CFG, $DB;
        $mform =& $this->_form;
        $mform->setDisableShortforms();

        //$contexts = $this->_customdata['contexts'];
        $id = $this->_customdata['id'];
        $participants = $this->_customdata['participants'];

        //Attributes for all text (input text)
        $attributes = array('size'=>'20');

        $mform->addElement('text', 'participants',
                get_string('participants', 'interassign'),$attributes,$participants);
        $mform->setType('participants', PARAM_RAW);
        $mform->addHelpButton('participants','participants','interassign');


        $buttonarray=array();
        $buttonarray[] =& $mform->createElement('submit', 'submitbutton', get_string('buttonupdate','interassign'));
        $buttonarray[] =& $mform->createElement('cancel', 'cancel', get_string('cancel'));
        $mform->addGroup($buttonarray, '', '', array(' '), false);


        //Adding hidden fields for the insertion
        $mform->addElement('hidden', 'interassign', $id);
        $mform->setType('interassign', PARAM_INT);
        if($id) {
          $mform->addElement('hidden', 'id', $id);
          $mform->setType('id', PARAM_INT);
        }

        //Rules for Form
        $mform->addRule('participants',get_string('noparticipants','interassign'), 'required', null, 'client');
    }

    public function validation($fromform, $files) {
        $errors = parent::validation($fromform, $files);

/*        if (!empty($fromform['newcategory']) && trim($fromform['name']) == '') {
            $errors['name'] = get_string('categorynamecantbeblank', 'question');
        }
*/
        return $errors;
    }


}
