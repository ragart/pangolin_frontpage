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
 * Javascript.
 *
 * @package    local_pangolin
 * @copyright  2021 Salvador Banderas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import $ from 'jquery';
import Templates from 'core/templates';

export const init = (data) => {
    switch (document.body.id) {
        case 'page-site-index':
            if (Array.isArray(data) && data.length) {
                Templates.render('pangolin_frontpage/course_list', {'courses': data})
                .then(function(html) {
                    $('#maincontent').after(html);
                    return true;
                })
                .catch();
            }
        break;
        default:
    }
};
