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
        return false;
    }

    /**
     * Sets the list of parameters passed to AMD
     *
     * @return array
     */
    public static function get_parameters()
    {
        return [];
    }

}
