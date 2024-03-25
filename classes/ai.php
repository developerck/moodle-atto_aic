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


namespace atto_aic;

use moodle_exception;

/**
 * PAI class for chatgpt
 *
 * @copyright  2023 DeveloperCK <developerck@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ai {

    /**
     * API url
     * @return API URL for chat gpt
     */
    public const API = 'https://api.openai.com/v1/completions';

    /**
     *  Generate text based on input
     * @param string $text
     * @return string
     */
    public static function generate_text($text) {
        global $CFG;
        $message = [["role" => "user", "content" => $text]];
        $temperature = get_config('atto_aic', 'temperature');
        $maxlength = get_config('atto_aic', 'maxlength');
        $topp = get_config('atto_aic', 'topp');
        $choice = get_config('atto_aic', 'choice');
        $frequency = get_config('atto_aic', 'frequency');
        $presence = 1;
        $apikey = get_config('atto_aic', 'apikey');
        $apiurl = self::API;
        $curlbody = [
            "model" => get_config('atto_aic', 'model'),
            "prompt" => $text,
            "temperature" => (float) $temperature,
            "max_tokens" => (int) $maxlength,
            "top_p" => (float) $topp,
            "n" => (int)$choice,
            "frequency_penalty" => (float) $frequency,
            "presence_penalty" => (float) $presence,

        ];
        require_once $CFG->libdir.'/filelib.php';
        $curl = new \curl();
        $curl->setopt(array(
            'CURLOPT_HTTPHEADER' => array(
                'Authorization: Bearer ' . $apikey,
                'Content-Type: application/json'
            ),
        ));
        $response = $curl->post($apiurl, json_encode($curlbody));
        $response = json_decode($response, true);
        if (isset($response['error'])) {
            throw new \moodle_exception("error");
        }
        return self::format_response($response,  $choice);
    }

    /**
     * format response
     * @param array $response
     * @param int $choice
     * @return string $html
     */
    private static function format_response($response,  $choice) {
        $tab = [];
        $content = [];
        for ($i = 1; $i <= $choice; $i++) {
            $text = $response["choices"][$i - 1]["text"];
            $tab[] = '<li class="nav-item"><a class="nav-link' . ($i == 1 ? 'active' : '')
            . ' " id="text' . $i . '-tab" data-toggle="tab" href="#text' . $i . '" role="tab" aria-controls="text' . $i
            . '" aria-selected="true">Draft ' . $i . '</a></li>';
            $content[] = ' <div class="tab-pane fade show ' . ($i == 1 ? 'active' : '') . '" id="text' . $i
            .'" role="tabpanel" aria-labelledby="text' . $i . '-tab"><div class="response">' . $text . '</div>
            <br/> <br/> <button class="btn btn-primary" type="button"  id="inserttext' . $i . '" class="inserttext' . $i
            . '"> ' . get_string('add_to_editor', 'atto_aic') . '</button>
            </div>';
        }

        $html = '<div class="mx-3">
    <ul class="nav nav-tabs" id="texttabs" role="tablist">
        ' . implode(" ", $tab) . '
    </ul>
<div class="tab-content" id="aiccontent">
 ' . implode(" ", $content) . '
</div></div>';
        return $html;
    }

}
