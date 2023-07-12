<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     atto_aic
 * @category    string
 * @copyright   2023 DeveloperCK <developerck@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

function atto_aic_params_for_js()
{
    global $USER;
    // check if openapi key is available
    $key = get_config("atto_aic", "apikey");
    $roles = get_config("atto_aic", "allowed_role");

    $params = [];
    $params['is_allowed'] = false;

    if ($key) {
        if (!empty($roles)) {
            $roles = explode(",", $roles);
            // get user role
            $user_roles = get_user_roles(\context_system::instance(), $USER->id);
            $user_role_ids  = array_map(function ($k) {
                return $k->roleid;
            }, $user_roles);
            foreach ($roles as $r) {
               
                if (in_array($r, $user_role_ids)) {
                    $params['is_allowed'] = true;
                    break;
                }
            }
        }
    }
    return $params;
}

function atto_aic_strings_for_js()
{
    global $PAGE;

    $PAGE->requires->strings_for_js(
        array(
            'header',
            'error',
            'placeholder',
            'buttonname',
            'help'
        ),
        'atto_aic'
    );
}
