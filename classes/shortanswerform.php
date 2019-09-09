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

class interassign_shortanswer_form extends moodleform {

    protected function definition() {
        global $CFG, $DB;
        $mform =& $this->_form;
        $mform->setDisableShortforms();

        //$contexts = $this->_customdata['contexts'];
        $id = null;
        if ( array_key_exists('id',$this->_customdata) ) {
            $id = $this->_customdata['id'];
        }

        $interassignid = $this->_customdata['interassignid'];
        //Attributes for all text (input text)
        $attributes = array('size'=>'60');

        $mform->addElement('text', 'title',
        get_string('title', 'interassign'),$attributes);
        $mform->setType('title', PARAM_RAW);
        $mform->addHelpButton('title','title','interassign');


        $mform->addElement('editor', 'detail',
        get_string('detail', 'interassign'),null);
        $mform->setType('detail', PARAM_RAW);

        $mform->addElement('textarea', 'suggestion',
        get_string('suggestion', 'interassign'),'wrap="virtual" rows="5" cols="70"');
        $mform->setType('suggestion', PARAM_RAW);

        $buttonarray=array();
        $buttonarray[] =& $mform->createElement('submit', 'submitbutton', get_string('buttonupdate','interassign'));
        $buttonarray[] =& $mform->createElement('cancel', 'cancel', get_string('cancel'));
        $mform->addGroup($buttonarray, '', '', array(' '), false);


        //Adding hidden fields for the insertion
        $mform->addElement('hidden', 'interassignid', $interassignid);
        $mform->setType('interassignid', PARAM_INT);
        if($id) {
          $mform->addElement('hidden', 'id', $id);
          $mform->setType('id', PARAM_INT);
        }

        //Rules for Form
        $mform->addRule('title',get_string('notitle','interassign'), 'required', null, 'client');
        $mform->addRule('detail',get_string('nodetail','interassign'), 'required', null, 'client');
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
