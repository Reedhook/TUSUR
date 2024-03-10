<?php

require_once('../../config.php');

// Get global variables.
global $DB, $PAGE, $OUTPUT;

// Define constants.
$TABLE_NAME = 'block_equation';

// Set the page URL and context.
$PAGE->set_url('/blocks/equation/result.php');
$PAGE->set_context(context_system::instance());
$PAGE->requires->css(new moodle_url('/blocks/equation/style.css'));
// Get the records from the database.
$results = $DB->get_records($TABLE_NAME);

// Start the output.
echo $OUTPUT->header();
echo "<table>";
echo "<tr>
        <th>#</th>
        <th>a</th>
        <th>b</th>
        <th>c</th>
        <th>x1</th>
        <th>x2</th>
      </tr>";

$i = 0;
// Loop through the results and display them in a table.
foreach ($results as $result) {
    echo
    "<tr>
            <td>$i</td>
            <td>{$result->a}</td>
            <td>{$result->b}</td>
            <td>{$result->c}</td>
            <td>{$result->x1}</td>
            <td>{$result->x2}</td>
        </tr>";
    $i++;
}

// End the output.
echo "</table>";
echo $OUTPUT->footer();
