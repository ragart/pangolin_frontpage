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
 * AMD plugin settings
 *
 * @package    pangolin_frontpage
 * @copyright  2021 Salvador Banderas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace pangolin_frontpage\pangolin;

use context_system;
use context_course;

defined('MOODLE_INTERNAL') || die();

/**
 * PANGOLIN Hello, World! amd class
 *
 * Returns information for loading site-wide Hello, World! JS.
 *
 * @package    pangolin_frontpage
 * @copyright  2021 Salvador Banderas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class amd implements \local_pangolin\interfaces\amd
{

    /**
     * Sets the list of restrictions for AMD to load
     *
     * @return bool
     */
    public static function load_is_allowed()
    {
        global $PAGE;
        return ($PAGE->bodyid == 'page-my-index'
            or $PAGE->bodyid == 'page-site-index');

    }

    /**
     * Sets the list of parameters passed to AMD
     *
     * @return array
     */
    public static function get_parameters()
    {
        global $DB, $PAGE, $OUTPUT;
        switch ($PAGE->bodyid) {
            case 'page-my-index':
                return [];
            break;
            case 'page-site-index':
                if (!$categories = get_config('pangolin_frontpage', 'course_categories')) {
                    return [];
                }
                $categories = array_map('trim', explode(',', $categories));
                sort($categories);
                list($insql, $inparams) = $DB->get_in_or_equal($categories);
                if (!$courses = $DB->get_records_sql('SELECT mc.id as courseid,
                                                             mc.fullname as coursename
                                                        FROM {course} mc
                                                  INNER JOIN {course_categories} mcc
                                                             ON mcc.id = mc.category
                                                       WHERE mc.category ' . $insql . '
                                                    ORDER BY mcc.sortorder ASC,
                                                             mc.fullname', $inparams)) {
                    return [];
                }
                if (!has_capability('moodle/site:config', context_system::instance())) {
                    $courses = array_filter($courses, function($course) {
                        return is_enrolled(context_course::instance($course->courseid));
                    });
                }
                return [
                    array_values($courses)
                ];
            break;
            default:
        }
        
    }

}
