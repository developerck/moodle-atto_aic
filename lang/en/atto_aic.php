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
 * @copyright   2023 DeveloperCK <developerck@gaicl.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aic:use'] = 'Can Use';
$string['pluginname'] = 'aic content generator';
$string['header'] = 'Create content through AI';
$string['apikey'] = 'OpenAI API Key';
$string['apikeydesc'] = 'The API Key for your OpenAI account';
$string['prompt'] = 'Completion prompt';
$string['promptdesc'] = 'The prompt the AI will be given before the conversation transcript';
$string['assistantname'] = 'Assistant name';
$string['assistantnamedesc'] = 'The name that the AI will use for itself internally';
$string['username'] = 'User name';
$string['usernamedesc'] = 'The name that the AI will use for the user internally';
$string['sourceoftruth'] = 'Source of truth';
$string['sourceoftruthdesc'] = 'Although the AI is very capable out-of-the-box, if it doesn\'t know the answer to a question, it is more likely to give incorrect information confidently than to refuse to answer. In this textbox, you can add common questions and their answers for the AI to pull from. Please put questions and answers in the following format: <pre>Q: Question 1<br />A: Answer 1<br /><br />Q: Question 2<br />A: Answer 2</pre>';
$string['showlabels'] = 'Show labels';
$string['advanced'] = 'Advanced';
$string['advanceddesc'] = 'Advanced arguments sent to OpenAI. Don\'t touch unless you know what you\'re doing!';
$string['model'] = 'Model';
$string['modeldesc'] = 'The model which will  generate the completion. Some models are suitable for natural language tasks, others specialize in code.';
$string['temperature'] = 'Temperature';
$string['temperaturedesc'] = 'Controls randomness: Lowering results in less random completions. As the temperature approaches zero, the model will become deterministic and repetitive.';
$string['maxlength'] = 'Maximum length';
$string['maxlengthdesc'] = 'The maximum number of token to generate. Requests can use up to 2,048 or 4,000 tokens shared between prompt and completion. The exact limit varies by model. (One token is roughly 4 characters for normal English text)';
$string['topp'] = 'Top P';
$string['toppdesc'] = 'Controls diversity via nucleus sampling: 0.5 means half of all likelihood-weighted options are considered.';
$string['frequency'] = 'Frequency penalty';
$string['frequencydesc'] = 'How much to penalize new tokens based on their existing frequency in the text so far. Decreases the model\'s likelihood to repeat the same line';
$string['allowed_role'] = 'Allowed role';
$string['allowed_role_desc'] = 'Users with role at system level, will be allowed to use this feature';
$string['choice'] = 'Number of draft';
$string['choice_desc'] = 'Number of draft to fetch';
$string['presence'] = 'Presence penalty';
$string['presencedesc'] = 'How much to penalize new tokens based on whether they appear in the text so far. Increases the model\'s likelihood to talk about new topics.';
$string['add_to_editor'] = 'Add to editor';
$string['placeholder'] = 'Write about digital education';
$string['buttonname'] = 'Generate Content';
$string['textlength'] = 'Please write more than 3 character and not more then 1000 character';
$string['error']  = 'We could not get content. You can try again!';
$string['help'] = 'You can use selection from editor or write in text area. 
Maximum 1000 character and minimum 3 character';
