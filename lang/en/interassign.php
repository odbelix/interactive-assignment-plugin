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
 * English strings for interassign
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    mod_interassign
 * @copyright  2016 Your Name <your@email.address>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['modulename'] = 'Sesión Interactiva';
$string['modulenameplural'] = 'Sesiones Interactivas';
$string['modulename_help'] = 'El módulo permite realizar sesiones de clases interactiva con los Estudiantes. El módulo permite crear tres tipos de preguntas y que los estudiantes, mediante la utilización de una aplicación móvil, puedan responder. El Docente también obtendra información relacionada con las respuesta de los estudiantes.';
$string['interassign:addinstance'] = 'Agregar una nueva Sesión Interactiva';
$string['interassign:submit'] = 'Guardar una Sesión Interactiva';
$string['interassign:view'] = 'Ver Sesión Interactiva';
$string['interassigntitle'] = 'Título de la Sesión';
$string['interassigntitle_help'] = 'El título de la sesión te permite contextualizar las actividades que serán realizadas.';
$string['interassign'] = 'Sesión Interactiva';
$string['pluginadministration'] = 'Administración Sesión Interactiva';
$string['pluginname'] = 'Sesión Interactiva';


$string['availability'] = 'Disponibilidad';
$string['allowsubmissionsfromdate'] = 'Permitir entregas desde';
$string['allowsubmissionsfromdate_help'] = 'Si está habilitado, los estudiantes no podrán hacer entregas antes de esta fecha. Si está deshabilitado, los estudiantes podrán comenzar las entregas de inmediato.';
$string['duedate'] = 'Fecha de entrega';
$string['duedate_help'] = 'Esto es cuando la Tarea ya se ha entregado. Todavía se permiten envíos después de esta fecha pero las tareas entregadas después de esta fecha se marcan como "retrasada". Para impedir envíos después de cierta fecha - ajustar la fecha de entrega de la tarea.';


$string['order'] = 'Orden de las Preguntas';
$string['order_help'] = 'Si está habilitado, los estudiantes recibiran las preguntas en el orden creado. En caso contrario sera de manera aleatoria';

//alt Images
$string['image_view'] = 'Ver detalle';
$string['image_edit'] = 'Editar';
$string['image_delete'] = 'Eliminar';
$string['image_active'] = 'Activar';
$string['image_inactive'] = 'Desactivar';


//fields and names
$string['title'] = 'Título';
$string['title_help'] = 'Título de la actividad/pregunta';
$string['detail'] = 'Enunciado';
$string['detail_help'] = ' Enunciado de la actividad/pregunta. Aquí se debe redactar todo el enunciado que sera expuesto a los estudiantes.';
$string['suggestion'] = 'Sugerencia';
$string['suggestion_help'] = ' La sugerencia es un mensaje que el docente puede enviar a los estudiantes como ayuda para resolver la actividad.';
$string['participants'] = 'Participantes';
$string['participants_help'] = 'Cantidad de participantes presentes en la sesión para realizar la actividad';

//interassign table
$string['detail'] = 'Detalle/Descripción';
$string['options'] = 'Opciones';
$string['questionshort'] = 'Preguntas de respuesta corta';
$string['questiontrueorfalse'] = 'Preguntas de verdadero o Falso';
$string['questionmultiplechoice'] = 'Preguntas de Selección Multiple';
$string['totalstudents'] = 'Total de Estudiantes';


//buttons
$string['enrollmentupdate'] = 'Actualizar lista de estudiantes';
$string['participantsupdate'] = 'Actualizar participantes';
$string['buttonupdate'] = 'Actualizar';
$string['create'] = 'Crear';

//Notifications
$string['enrollmentsuccess'] = 'Se actualizo la lista total de estudiantes exitosamente';
$string['participantssuccess'] = 'Se actualizo la cantidad de estudiantes participando en la sesión';
$string['tomuchparticipants'] = 'La cantidad de participantes no puede ser superior al número total de Estudiantes del Curso.';
$string['outdatedstudents'] = 'La lista total de estudiantes no esta iniciada. Esto influye en el calculo de los resultados de la actividad';
$string['addshortanswerssuccess'] = 'La pregunta de respuesta corta fue creada con exito.';
//Rules
$string['noparticipants'] = 'Debes especificar el número de participantes. Esto influye en el calculo de los resultados de la actividad.';
$string['notitle'] = 'Debes especificar el título de la pregunta';
$string['nodetail'] = 'Debes escribir el enunciado de la pregunta.';

//Titles
$string['activequestions'] = 'Preguntas Activas para los estudiantes';
