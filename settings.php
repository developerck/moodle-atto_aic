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
 * Plugin administration pages are defined here.
 *
 * @package     atto_aic
 * @category    admin
 * @copyright   2023 DeveloperCK <developerck@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    if ($ADMIN->fulltree) {


        $settings->add(new admin_setting_configtext(
            'atto_aic/apikey',
            get_string('apikey', 'atto_aic'),
            get_string('apikeydesc', 'atto_aic'),
            '',
            PARAM_TEXT
        ));

        // Get roles at system level.
        $roles = get_all_roles(\context_system::instance());
        foreach ($roles as $role) {
            $roles[$role->id] = $role->shortname;
        }
        $settings->add(new admin_setting_pickroles(
            'atto_aic/allowed_role',
            new lang_string('allowed_role', 'atto_aic'),
            new lang_string('allowed_role_desc', 'atto_aic'),
            '',
            $roles
        ));


        $settings->add(new admin_setting_configselect(
            'atto_aic/choice',
            get_string('choice', 'atto_aic'),
            get_string('choice_desc', 'atto_aic'),
            '1',
            [

                '1' => '1',
                '2' => '2',
                '3' => '3',

            ]
        ));
        // Advanced Settings.

        $settings->add(new admin_setting_heading(
            'atto_aic/advanced',
            get_string('advanced', 'atto_aic'),
            get_string('advanceddesc', 'atto_aic')
        ));

        $settings->add(new admin_setting_configselect(
            'atto_aic/model',
            get_string('model', 'atto_aic'),
            get_string('modeldesc', 'atto_aic'),
            'text-davinci-003',
            [

                'text-davinci-003' => 'text-davinci-003',

            ]
        ));

        $settings->add(new admin_setting_configtext(
            'atto_aic/temperature',
            get_string('temperature', 'atto_aic'),
            get_string('temperaturedesc', 'atto_aic'),
            0.5,
            PARAM_FLOAT
        ));

        $settings->add(new admin_setting_configtext(
            'atto_aic/maxlength',
            get_string('maxlength', 'atto_aic'),
            get_string('maxlengthdesc', 'atto_aic'),
            200,
            PARAM_INT
        ));

        $settings->add(new admin_setting_configtext(
            'atto_aic/topp',
            get_string('topp', 'atto_aic'),
            get_string('toppdesc', 'atto_aic'),
            1,
            PARAM_FLOAT
        ));

        $settings->add(new admin_setting_configtext(
            'atto_aic/frequency',
            get_string('frequency', 'atto_aic'),
            get_string('frequencydesc', 'atto_aic'),
            1,
            PARAM_FLOAT
        ));

        $settings->add(new admin_setting_configtext(
            'atto_aic/presence',
            get_string('presence', 'atto_aic'),
            get_string('presencedesc', 'atto_aic'),
            1,
            PARAM_FLOAT
        ));
    }
}
