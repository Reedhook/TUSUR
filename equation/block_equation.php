<?php

declare(strict_types=1);
global $CFG;

require_once($CFG->dirroot . '/blocks/equation/classes/Equation.php');
require_once($CFG->dirroot . '/blocks/equation/classes/Validation.php');

class block_equation extends block_base
{
    public function init(): void
    {
        $this->title = get_string('equation', 'block_equation');
        $this->version = 2004111200;
    }

    /**
     * @throws dml_exception|coding_exception
     */
    public function get_content(): stdClass
    {
        $this->page->requires->css(new moodle_url('/blocks/equation/style.css'));

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->text = '';

        $this->content->text .= '
        <form id="quadraticForm" action="" method="POST">
            <label for="a">Введите коэффициент a:</label>
            <input type="number" id="a" name="a" required><br><br>

            <label for="b">Введите коэффициент b:</label>
            <input type="number" id="b" name="b" required><br><br>

            <label for="c">Введите коэффициент c:</label>
            <input type="number" id="c" name="c" required><br><br>

            <input type="submit" value="Решить уравнение">
        </form>';
        $this->content->text .= 'Ответ: <br>' ;
        if ($data = $this->get_data()) {
            $solver = new Equation(new Validation, new StdClass);
            $request = [
                'a' => (float)$data->a,
                'b' => (float)$data->b,
                'c' => (float)$data->c,
            ];
            $this->content->text .= $solver->solveTheEquation(($request));
        }
        $this->content->text .= '<br> <a href="/moodle/blocks/equation/result.php">Результаты</a>';

        return $this->content;
    }

    public function get_data(): bool|object
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return (object)$_POST;
        }
        return false;
    }
}