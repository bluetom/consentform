<?php
// This file is part of mod_organizer for Moodle - http://moodle.org/
//
// It is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// It is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * event/agreement_disagree.php
 *
 * @package   mod_confidential
 * @author    Thomas Niedermaier (thomas.niedermaier@meduniwien.ac.at)
 * @copyright 2018 Academic Moodle Cooperation {@link http://www.academic-moodle-cooperation.org}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_confidential\event;
defined('MOODLE_INTERNAL') || die();
/**
 * The agreement_disagree event class.
 **/
class agreement_disagree extends \core\event\base
{
    protected function init() {
        $this->data['crud'] = 'u'; // Options: c (reate), r (ead), u (pdate), d (elete).
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'grade_grades';
    }

    public static function get_name() {
        return get_string('eventagreementdisagree', 'mod_confidential');
    }

    public function get_description() {
        $a = new \stdClass();
        $a->userid = $this->userid;
        $a->contextinstanceid = $this->contextinstanceid;
        return get_string('eventagreementdisagreedesc', 'mod_confidential', $a);
    }

    public function get_url() {
        return new \moodle_url('/mod/confidential/view.php', array('id' => $this->objectid));
    }

    public function get_legacy_logdata() {
        // Override if you are migrating an add_to_log() call.
        return array($this->courseid, 'mod_confidential', 'add',
            $this->objectid, $this->contextinstanceid);
    }
}