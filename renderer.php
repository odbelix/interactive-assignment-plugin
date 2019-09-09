<?php
defined('MOODLE_INTERNAL') || die();

class mod_interassign_renderer extends \plugin_renderer_base {


    // /**
    // * Show button for access to edit.php
    // * @param string $id interassign id
    // * @param string $course course/cm id
    // * @return html_writer::image
    // */
    // public function progassing_show_edit_option($id,$course){
    //     $url = new moodle_url('edit.php', array('interassign' => $id, 'course' => $course));
    //     return html_writer::image($url, get_string('editstatements', 'interassign'),
    //                 array('title'=> get_string('editstatements', 'interassign'),'class' => 'btn btn-secondary'));
    // }
    //


    /**
    * Create group of button elements
    * @param array $buttons array of buttons (moodle_url + btn class)
    * @return string
    */
    public function interassign_group_button($buttons){
      $out = '';
      $out .= html_writer::start_tag('div',array('class'=>'btn-group center'));
      foreach ($buttons as $bt) {
        $out .= $bt;
      }
      $out .= html_writer::end_tag('div');
      return $out;
    }
    //
    // /**
    // * Create a Link. This link looks like a label
    // * @param  array() $params      array of parameters for links
    // * @param  string  $url         URL for create the link
    // * @param  string  $message     Message of Button Link
    // * @return html_writer::link
    // */
    // public function interassign_url_link_label($params,$url,$message){
    //     $link = new moodle_url($url, $params);
    //     $output = html_writer::start_span('label label-info') . html_writer::link($link, $message) . html_writer::end_span();
    //     return $output;
    // }
    //
    /**
    * Create a Link. This link looks like a button
    * @param  array() $params      array of parameters for links
    * @param  string  $url         URL for create the link
    * @param  string  $message     Message of Button Link
    * @return html_writer::link
    */
    public function interassign_url_link_button($params,$url,$message){
        $link = new moodle_url($url, $params);
        return html_writer::link($link, $message,array('title'=> $message,'class' => 'btn'));
    }

    /**
    * Create a Link. This link looks like a button.
    *
    * @param  array() $params      array of parameters for links
    * @param  string  $url         URL for create the link
    * @param  string  $message     Message of Button Link
    * @param  image  $image        Images
    * @return html_writer::link
    */
    public function interassign_url_link_button_image($params,$url,$message,$image){
        $link = new moodle_url($url, $params);
        return html_writer::link($link,$image,array('title'=> $message));
    }


    /**
    * Create icon buttons options for questions
    * @param stdClass $question Class of specific question
    * @param array()  $paths Array with the paths of specific files for create the buttons links.
    * @return array();
    */
    public function interassign_array_iconoptions($question,$paths) {
      $view     = html_writer::tag('img', '', array('alt' => get_string('image_view','interassign'), 'src' => "pix/view.svg",'class' => 'btn'));
      $edit     = html_writer::tag('img', '', array('alt' => get_string('image_edit','interassign'), 'src' => "pix/edit.svg",'class' => 'btn'));
      $delete   = html_writer::tag('img', '', array('alt' => get_string('image_delete','interassign'), 'src' => "pix/delete.svg",'class' => 'btn'));
      $active   = html_writer::tag('img', '', array('alt' => get_string('image_active','interassign'), 'src' => "pix/active.svg",'class' => 'btn'));
      $inactive = html_writer::tag('img', '', array('alt' => get_string('image_inactive','interassign'), 'src' => "pix/inactive.svg",'class' => 'btn'));

      $arraybuttons = array();
      array_push($arraybuttons,$this->interassign_url_link_button_image(array('id'=>$question->id,'interassign'=>$question->interassignid),$paths['view'],get_string('image_view','interassign'),$view));
      array_push($arraybuttons,$this->interassign_url_link_button_image(array('id'=>$question->id,'interassign'=>$question->interassignid),$paths['edit'],get_string('image_edit','interassign'),$edit));
      array_push($arraybuttons,$this->interassign_url_link_button_image(array('id'=>$question->id,'interassign'=>$question->interassignid),$paths['delete'],get_string('image_delete','interassign'),$delete));
      if ($question->active == 1 )
        array_push($arraybuttons,$this->interassign_url_link_button_image(array('id'=>$question->id,'interassign'=>$question->interassignid),$paths['state'],get_string('image_inactive','interassign'),$active));
      else
        array_push($arraybuttons,$this->interassign_url_link_button_image(array('id'=>$question->id,'interassign'=>$question->interassignid),$paths['state'],get_string('image_active','interassign'),$inactive));

      return $arraybuttons;
    }









    //

    // /**
    // * Create a Link.
    // *
    // * @param  array() $params      array of parameters for links
    // * @param  string  $url         URL for create the link
    // * @param  string  $message     Message of Link
    // * @param  string  $title       Title of Link
    // * @return html_writer::link
    // */
    // public function interassign_url_image($params,$url,$message,$title){
    //     $link = new moodle_url($url, $params);
    //     return html_writer::link($link,$message,array('title'=> $title));
    // }
    //
    // /**
    // * Translate result->response to html_writer::start_span
    // * @param  string $response  xml/text response from the judge
    // * @return string
    // */
    // public function interassign_response_translate($response) {
    //
    //   $meanigns = array(
    //     "error_runtime_excecution_error" => array('code' => get_string('error_runtime_excecution_error','interassign'),'detail' => get_string('error_runtime_excecution_error_help','interassign'),'class' => 'important'),
    //     "error_time_limit_exceeded" => array('code' => get_string('error_time_limit_exceeded','interassign'),'detail' => get_string('error_time_limit_exceeded_help','interassign'),'class' => 'important'),
    //     "error_output_format_error" => array('code' => get_string('error_output_format_error','interassign'),'detail' => get_string('error_output_format_error_help','interassign'),'class' => 'important'),
    //     "error_wrong_answer" => array('code' => get_string('error_wrong_answer','interassign'),'detail' => get_string('error_wrong_answer_help','interassign'),'class' => 'important'),
    //     "correct" => array('code' => get_string('correct','interassign'),'detail' => get_string('correct_help','interassign'),'class' => 'success'),
    //     "correct" => array('code' => get_string('correct','interassign'),'detail' => get_string('correct_help','interassign'),'class' => 'success'),
    //   );
    //
    //   $result = '';
    //   $arrResult = $arrayData = explode("|",$response);
    //   foreach ($arrResult as $data) {
    //       if ( strlen($data) > 4 ) {
    //           $arrData = explode(":",$data);
    //           $result .= get_string('case','interassign')." ".$arrData[0].": ";
    //           $index = "error_".strtolower($arrData[1]);
    //           $result .= html_writer::start_span('label label-'.$meanigns[$index]['class']) . $meanigns[$index]['code'] . html_writer::end_span();
    //           $result .= "<br>";
    //       }
    //   }
    //   return $result;
    // }
    //
    // /**
    // * Show list of meanigns for result translate
    // * @return string
    // */
    // public function interassign_list_meanings() {
    //
    //   $meanigns = array(
    //     array('code' => get_string('noresult','interassign'),'detail' => get_string('noresult_help','interassign'),'class' => 'warning'),
    //     array('code' => get_string('noresponse','interassign'),'detail' => get_string('noresponse_help','interassign'),'class' => 'warning'),
    //     array('code' => get_string('compilation','interassign'),'detail' => get_string('compilation_help','interassign'),'class' => 'important'),
    //     array('code' => get_string('error_runtime_excecution_error','interassign'),'detail' => get_string('error_runtime_excecution_error_help','interassign'),'class' => 'important'),
    //     array('code' => get_string('error_time_limit_exceeded','interassign'),'detail' => get_string('error_time_limit_exceeded_help','interassign'),'class' => 'important'),
    //     array('code' => get_string('error_output_format_error','interassign'),'detail' => get_string('error_output_format_error_help','interassign'),'class' => 'important'),
    //     array('code' => get_string('error_wrong_answer','interassign'),'detail' => get_string('error_wrong_answer_help','interassign'),'class' => 'important'),
    //     array('code' => get_string('correct','interassign'),'detail' => get_string('correct_help','interassign'),'class' => 'success'),
    //   );
    //
    //   $out = null;
    //   $out .= html_writer::start_tag('ul',array('class'=>'unstyled'));
    //   foreach ($meanigns as $data) {
    //     $out .= html_writer::start_tag('li');
    //     $out .= html_writer::start_span('label label-'.$data['class']) . $data['code'] . html_writer::end_span().' = '.$data['detail'];
    //     $out .= html_writer::end_tag('li');
    //   }
    //   $out .= html_writer::end_tag('ul');
    //   return $out;
    // }
    //
    // /**
    // * Show table with whole assignments
    // * @param array() $statements Array of Statements
    // * @param array() $students Array of Students
    // * @return html_writer::table
    // */
    // public function interassign_assignments_table($statements,$students) {
    //   global $DB;
    //   $table = new html_table();
    //   $table->attributes['class'] = 'generaltable table-striped table-bordered';
    //
    //   //Creating array for header of Table;
    //   $header = array();
    //   array_push($header,get_string('students','interassign'));
    //   foreach ($statements as $st) {
    //     array_push($header,$st->title);
    //   }
    //   $table->head = $header;
    //
    //   $tableRows = array();
    //   foreach ($students as $student) {
    //       $stResult = array();
    //       array_push($stResult,$student->firstname.' '.$student->lastname);
    //       foreach ($statements as $st) {
    //         $result = $DB->get_record('interassign_result', array('interassignid' => $st->interassignid, 'statementid' => $st->id,'userid' => $student->id));
    //         if (!$result) {
    //           $message = html_writer::start_span('label label-warning') . get_string('noresult','interassign') . html_writer::end_span();
    //           array_push($stResult,$message);
    //         }
    //         else {
    //           if (!$result->response) {
    //             $message = html_writer::start_span('label label-warning') . get_string('noresult','interassign') . html_writer::end_span();
    //             array_push($stResult,$message);
    //           }
    //           else {
    //             if ( strcmp('correct',strtolower(trim($result->response))) == 0) {
    //               $message = html_writer::start_span('label label-success') . get_string('correct','interassign') . html_writer::end_span();
    //               array_push($stResult,$message);
    //             }
    //             else {
    //                 if ( $result->iscorrect == 1) {
    //                     $message = html_writer::start_span('label label-success') . get_string('correct','interassign') . html_writer::end_span();
    //                 }
    //                 else {
    //                     if ( strcmp($result->response,'compilation') == 0 )
    //                         $message = html_writer::start_span('label label-important') . get_string('compilation','interassign') . html_writer::end_span();
    //                     if ( strcmp($result->response,'noresponse') == 0 )
    //                         $message = html_writer::start_span('label label-warning') . get_string('noresponse','interassign') . html_writer::end_span();
    //                     else
    //                         $message = $this->interassign_response_translate($result->response);
    //                 }
    //                 //View the source
    //                 $view   = html_writer::tag('img', '', array('alt' => get_string('image_view','interassign'), 'src' => "pix/view.svg",'class' => 'btn'));
    //                 $message .= "&nbsp;".$this->interassign_url_link_button_image(array('statement'=>$st->id,'interassign'=>$st->interassignid,'user'=>$student->id,'result'=>$result->id),
    //                   'source.php',get_string('image_view','interassign'),$view)."<br>";
    //                 //$message .= $this->interassign_url_link_label(array('statement'=>$st->id,'interassign'=>$st->interassignid,'user'=>$student->id,'result'=>$result->id),
    //                   //'source.php',get_string('showcode','interassign'));
    //                 array_push($stResult,$message);
    //             }
    //           }
    //         }
    //       }
    //       array_push($tableRows,$stResult);
    //   }
    //   $table->data = $tableRows;
    //
    //   return html_writer::table($table);
    // }
    //
    // /**
    // * Show table with result from the Judge for one code.
    // * @param stdClass $result
    // * @return html_writer::table
    // */
    // public function interassign_result_table($result) {
    //   $table = new html_table();
    //   $table->attributes['class'] = 'generaltable table-striped table-bordered';
    //   $table->head = array(
    //         get_string('filename','interassign'),
    //         get_string('fileversion','interassign'),
    //         get_string('requestid','interassign'),
    //         get_string('response','interassign')
    //         );
    //
    //   $response = '';
    //   if ( $result->iscorrect == 1 ) {
    //       $response = html_writer::start_span('label label-success') . get_string('correct','interassign') . html_writer::end_span();
    //   }
    //   else {
    //       if ( strcmp($result->response,'compilation') == 0 ) {
    //           $response = html_writer::start_span('label label-important') . get_string('compilation','interassign') . html_writer::end_span();
    //       }
    //       elseif ( strcmp($result->response,'noresponse') == 0 ) {
    //           $response = html_writer::start_span('label label-warning') . get_string('noresponse','interassign') . html_writer::end_span();
    //       }
    //       else {
    //           $response = $this->interassign_response_translate($result->response);
    //       }
    //   }
    //
    //   $table->data = array(array(
    //     $result->filename,
    //     $result->fileversion,
    //     $result->requestid,
    //     $response
    //   ));
    //   return html_writer::table($table);
    // }
    //
    /**
    * Show table with whole interassign information
    * @param stdClass $interassign
    * @param stdClass $short
    * @param stdClass $trueorfalse
    * @param stdClass $multiple
    * @return html_writer::table
    */
    public function interassign_to_table($interassign,$short,$trueorfalse,$multiple){

      $allow = get_string('allowsubmissionsfromdate', 'interassign');
      $duedate = get_string('duedate', 'interassign');
      $qshort = get_string('questionshort','interassign');
      $qtrueorfalse = get_string('questiontrueorfalse','interassign');
      $qmultiplechoice = get_string('questionmultiplechoice','interassign');
      $participants = get_string('participants','interassign');
      $totalstudents = get_string('totalstudents','interassign');

      $table = new html_table();
      $table->attributes['class'] = 'generaltable table-striped table-bordered';
      $table->head = array(get_string('detail','interassign'), $interassign->intro);
      $table->data = array(
        array($participants,$interassign->participants),
        array($totalstudents,$interassign->totalstudents),
        array($allow, userdate($interassign->allowsubmissionsfromdate)),
        array($duedate, userdate($interassign->duedate)),
        array($qshort, count($short)),
        array($qtrueorfalse, count($trueorfalse)),
        array($qmultiplechoice, count($multiple)),
      );
      return html_writer::table($table);
    }

    /**
    * Show table with whole interassign information
    * @param stdClass $short
    * @return html_writer::table
    */
    public function interassign_active_shortanswerquestions_to_table($short){

      $allow = get_string('allowsubmissionsfromdate', 'interassign');
      $duedate = get_string('duedate', 'interassign');
      $qshort = get_string('questionshort','interassign');
      $qtrueorfalse = get_string('questiontrueorfalse','interassign');
      $qmultiplechoice = get_string('questionmultiplechoice','interassign');
      $participants = get_string('participants','interassign');
      $totalstudents = get_string('totalstudents','interassign');

      $table = new html_table();
      $table->attributes['class'] = 'generaltable table-striped table-bordered';

      if ( count($short) != 0 ) {
        $table->head = array('#',get_string('questionshort','interassign'),get_string('options','interassign'));
        $data = array();
        $row = 1;

        $arrayPaths = array();
        $arrayPaths['edit'] = 'editshortanswer.php';
        $arrayPaths['view'] = 'viewshortanswer.php';
        $arrayPaths['delete'] = 'deleteshortanswer.php';
        $arrayPaths['state'] = 'stateshortanswer.php';

        foreach ($short as $question) {
          # code...
          $arrOptions = $this->interassign_array_iconoptions($question,$arrayPaths);
          $options = $this->interassign_group_button($arrOptions);
          $questionrow = array($row,$question->title,$options);

          $row+=1;
          array_push($data,$questionrow);
        }
        $table->data = $data;
      }
      return html_writer::table($table);
    }

    /**
    * Show table with whole interassign information
    * @param stdClass $trueorfalse
    * @return html_writer::table
    */
    public function interassign_active_trueorfalsequestions_to_table($trueorfalse){

      $table = new html_table();
      $table->attributes['class'] = 'generaltable table-striped table-bordered';

      if ( count($trueorfalse) != 0 ) {
        $table->head = array('#',get_string('questiontrueorfalse','interassign'),get_string('options','interassign'));
        $data = array();
        $row = 1;
        foreach ($trueorfalse as $question) {
          # code...
          $questionrow = array($row,$question->title,'Options');
          $row+=1;
          array_push($data,$questionrow);
        }
        $table->data = $data;
      }
      return html_writer::table($table);
    }

    /**
    * Show table with whole interassign information
    * @param stdClass $multiple
    * @return html_writer::table
    */
    public function interassign_active_multiplechoicequestions_to_table($multiple){

      $table = new html_table();
      $table->attributes['class'] = 'generaltable table-striped table-bordered';

      if ( count($multiple) != 0 ) {
        $table->head = array('#',get_string('questionmultiplechoice','interassign'),get_string('options','interassign'));
        $data = array();
        $row = 1;
        foreach ($multiple as $question) {
          # code...
          $questionrow = array($row,$question->title,'Options');
          $row+=1;
          array_push($data,$questionrow);
        }
        $table->data = $data;
      }
      return html_writer::table($table);
    }


    //
    // /**
    // * Show table with whole statements
    // * @param stdClass $statements
    // * @return html_writer::table
    // */
    // public function interassign_statements_table($statements){
    //   $row = 1;
    //   $table = new html_table();
    //   $table->attributes['class'] = 'generaltable table-striped table-bordered';
    //   $table->head = array('#',
    //     get_string('statementformtitle','interassign'),
    //     get_string('statementformlanguage','interassign'),
    //     get_string('statementformdescription','interassign'),
    //     get_string('options','interassign'));
    //   $datarows = array();
    //   foreach ($statements as $st) {
    //     # code...
    //     if (strlen($st->description)> 40 ){
    //       $description = substr($st->description,0,60)." ...";
    //     }
    //     else {
    //       $description = $st->description;
    //     }
    //     //ROW to url
    //     $link = $this->interassign_url_image(array('statement'=>$st->id,'interassign'=>$st->interassignid),
    //     'show.php',$row,get_string('lookdetail','interassign'));
    //
    //     $view   = html_writer::tag('img', '', array('alt' => get_string('image_view','interassign'), 'src' => "pix/view.svg",'class' => 'btn'));
    //     $edit   = html_writer::tag('img', '', array('alt' => get_string('image_edit','interassign'), 'src' => "pix/edit.svg",'class' => 'btn'));
    //     $cases  = html_writer::tag('img', '', array('alt' => get_string('image_cases','interassign'), 'src' => "pix/cases.svg",'class' => 'btn'));
    //     $delete = html_writer::tag('img', '', array('alt' => get_string('image_delete','interassign'), 'src' => "pix/delete.svg",'class' => 'btn'));
    //
    //     $arraybuttons = array(
    //       $this->interassign_url_link_button_image(array('statement'=>$st->id,'interassign'=>$st->interassignid),
    //         'show.php',get_string('image_view','interassign'),$view),
    //       $this->interassign_url_link_button_image(array('statement'=>$st->id,'interassign'=>$st->interassignid),
    //         'editstatement.php',get_string('image_edit','interassign'),$edit),
    //       $this->interassign_url_link_button_image(array('statement'=>$st->id,'interassign'=>$st->interassignid),
    //       'deletestatement.php',get_string('image_delete','interassign'),$delete),
    //       $this->interassign_url_link_button_image(array('statement'=>$st->id,'interassign'=>$st->interassignid),
    //       'cases.php',get_string('image_cases','interassign'),$cases),
    //     );
    //     $options = $this->interassign_group_button($arraybuttons);
    //     $data = array($link,$st->title,$this->interassign_language_to_string($st->language),$description,$options);
    //     array_push($datarows,$data);
    //     $row = $row + 1;
    //   }
    //   $table->data = $datarows;
    //   return html_writer::table($table);
    // }
    //
    // /**
    // * Show table for one statement
    // * @param stdClass $statements
    // * @return html_writer::table
    // */
    // public function interassign_statement_table($statement){
    //   $row = 1;
    //   $table = new html_table();
    //   $table->attributes['class'] = 'table table-striped table-bordered';
    //   $table->data = array(
    //     array(get_string('statementformtitle','interassign'),$statement->title),
    //     array(get_string('statementformdescription','interassign'),$statement->description),
    //     array(get_string('statementformlanguage','interassign'),$this->interassign_language_to_string($statement->language)),
    //     array(get_string('statementformtimelimit','interassign'),$statement->timelimit),
    //     array(get_string('caseforminput','interassign'),$statement->input),
    //     array(get_string('caseformoutput','interassign'),$statement->output),
    //     //array($duedate, userdate($interassign->duedate)),
    //   );
    //   return html_writer::table($table);
    // }
    //
    // /**
    // * Show table with whole cases
    // * @param stdClass $cases
    // * @return html_writer::table
    // */
    // public function interassign_cases_table($cases){
    //   $row = 1;
    //   $table = new html_table();
    //   $table->attributes['class'] = 'table table-striped table-bordered';
    //   $table->head = array('#',
    //     get_string('caseforminput','interassign'),
    //     get_string('caseformoutput','interassign'),
    //     get_string('caseformsuggestion','interassign'),
    //     get_string('options','interassign'));
    //   $datarows = array();
    //   foreach ($cases as $cs) {
    //     # code of options
    //
    //     $edit   = html_writer::tag('img', '', array('alt' => get_string('image_edit','interassign'), 'src' => "pix/edit.svg",'class' => 'btn'));
    //     $delete = html_writer::tag('img', '', array('alt' => get_string('image_delete','interassign'), 'src' => "pix/delete.svg",'class' => 'btn'));
    //
    //     $arraybuttons = array(
    //
    //       $this->interassign_url_link_button_image(array('case'=>$cs->id,'statement'=>$cs->statementid),
    //         'editcase.php',get_string('image_edit','interassign'),$edit),
    //       $this->interassign_url_link_button_image(array('case'=>$cs->id,'statement'=>$cs->statementid),
    //       'deletecase.php',get_string('image_delete','interassign'),$delete),
    //     );
    //     $options = $this->interassign_group_button($arraybuttons);
    //
    //     $data = array($row,$cs->inputdata,$cs->outputdata,$cs->suggestion,$options);
    //     array_push($datarows,$data);
    //     $row = $row + 1;
    //   }
    //   $table->data = $datarows;
    //   return html_writer::table($table);
    // }
    //
    // /**
    // * Show table with whole information about user and source code
    // * @param stdClass $user
    // * @return html_writer::table
    // */
    // public function interassign_user_table($user){
    //   $row = 1;
    //   $table = new html_table();
    //   $table->attributes['class'] = 'table table-striped table-bordered';
    //   $table->head = array(
    //     get_string('student','interassign'),
    //     get_string('studentemail','interassign')
    //     );
    //   $datarows = array();
    //   $data = array($user->firstname.' '.$user->lastname,$user->email);
    //   array_push($datarows,$data);
    //
    //   $table->data = $datarows;
    //   return html_writer::table($table);
    // }
    //
    // private function interassign_read_source_code($source) {
    //   //READ FILE AND FIXING C Programs
    //   $file = fopen($source, "r");
    //   $text = "";
    //   while(!feof($file)){
    //     $line = fgets($file);
    //     if ( strcmp($line,"include") !== false ) {
    //       $text .= str_replace("<","&lt;",$line);
    //     }
    //     else {
    //       $text .= $line;
    //     }
    //   }
    //   fclose($file);
    //   return $text;
    //   $data = array('<pre class="brush: '.$language.'">'.$text.'</pre>');
    // }
    //
    // /**
    // * Show table with the source code of the solution
    // * @param stdClass $result
    // * @return html_writer::table
    // */
    // public function interassign_user_source_code_table($result,$language){
    //   $row = 1;
    //   $table = new html_table();
    //   $table->attributes['class'] = 'table table-striped table-bordered';
    //
    //   $header  = get_string('filename','interassign');
    //   $header .= ' | '.get_string('fileversion','interassign');
    //   $header .= ' : '.$result->fileversion;
    //   $params = array('statement'=>$result->statementid,'interassign'=>$result->interassignid,'user'=>$result->userid);
    //   $header .= ' '.$this->interassign_url_link_button($params,'history.php',get_string('history','interassign'));
    //   $table->head = array(
    //       $header
    //     );
    //   $datarows = array();
    //   //READ FILE AND FIXING C Programs
    //   $text = $this->interassign_read_source_code($result->filepath);
    //   $data = array('<pre class="brush: '.$language.'">'.$text.'</pre>');
    //   array_push($datarows,$data);
    //
    //   $table->data = $datarows;
    //   return html_writer::table($table);
    // }
    //
    // /**
    // * Show table with the source code of the solution
    // * @param stdClass $result
    // * @return html_writer::table
    // */
    // public function interassign_user_history_code_table($result,$language){
    //   $row = 1;
    //   $table = new html_table();
    //   $table->attributes['class'] = 'table table-striped table-bordered';
    //
    //   $header  = get_string('filename','interassign');
    //   $header .= ' | '.get_string('fileversion','interassign');
    //   $header .= ' : '.$result->fileversion;
    //   $params = array('statement'=>$result->statementid,'interassign'=>$result->interassignid,'user'=>$result->userid);
    //   $table->head = array(
    //       $header
    //     );
    //   $datarows = array();
    //   //READ FILE AND FIXING C Programs
    //   $text = $this->interassign_read_source_code($result->filepath);
    //   $data = array('<pre class="brush: '.$language.'">'.$text.'</pre>');
    //   array_push($datarows,$data);
    //
    //   $table->data = $datarows;
    //   return html_writer::table($table);
    // }
    //
    // /**
    // * Show table with whole cases for student (Whitout edit options)
    // * @param stdClass $cases
    // * @return html_writer::table
    // */
    // public function interassign_cases_table_for_students($cases){
    //   $row = 1;
    //   $table = new html_table();
    //   $table->attributes['class'] = 'table table-striped table-bordered';
    //   $table->head = array('#',
    //     get_string('caseforminput','interassign'),
    //     get_string('caseformoutput','interassign'),
    //     get_string('caseformsuggestion','interassign')
    //     );
    //   $datarows = array();
    //   foreach ($cases as $cs) {
    //     $data = array($row,$cs->inputdata,$cs->outputdata,$cs->suggestion);
    //     array_push($datarows,$data);
    //     $row = $row + 1;
    //   }
    //   $table->data = $datarows;
    //   return html_writer::table($table);
    // }
    //
    /**
    * Show Success Notification
    * @param string $message
    * @return string
    */
    public function notification_success($message){
      $n = new \core\output\notification($message, \core\output\notification::NOTIFY_SUCCESS);
      return $this->render($n);

    }

    /**
    * Show Error Notification
    * @param string $message
    * @return string
    */
    public function notification_error($message){
      $n = new \core\output\notification($message, \core\output\notification::NOTIFY_ERROR);
      return $this->render($n);
    }

    /**
    * Show Information Notification
    * @param string $message
    * @return string
    */
    public function notification_info($message){
      $n = new \core\output\notification($message, \core\output\notification::NOTIFY_INFO);
      return $this->render($n);
    }
}
