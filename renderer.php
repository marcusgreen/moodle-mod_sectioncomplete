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
 *
 * @package
 * @copyright Copyright (c)  Chartered College of Teaching. (http://www.charterd.college)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot . '/mod/sectioncomplete/lib.php');

defined('MOODLE_INTERNAL') || die();

class mod_sectioncomplete_renderer extends \plugin_renderer_base {

    public function display_content(\cm_info $cm) {
        global $CFG, $DB, $USER;

        $title = $cm->name;
        if(sectioncomplete_completionstate($cm->get_course())) {
            $button = $CFG->wwwroot ."/mod/sectioncomplete/pix/completed.svg";
        } else {
            $button = $CFG->wwwroot ."/mod/sectioncomplete/pix/tocomplete.svg";
        }

        $data = [
                'formaction' => new moodle_url('/course/togglecompletion.php'),
                'title' => $title,
                'module' => $cm->id,
                'sessionkey' => sesskey(),
                'content' => format_module_intro('sectioncomplete', $cm->customdata, $cm->id),
                'buttonimage' => $button,
                'completionstate' => 1,
                'tocompleteurl' => $CFG->wwwroot ."/mod/sectioncomplete/pix/tocomplete.svg",
                'completedurl' => $CFG->wwwroot ."/mod/sectioncomplete/pix/completed.svg"
        ];

        return $this->render_from_template('mod_sectioncomplete/content', $data);
    }

}