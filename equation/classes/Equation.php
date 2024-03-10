<?php

declare(strict_types=1);

class Equation
{
    protected Validation $validate;
    protected StdClass $response;

    public function __construct(Validation $validate, StdClass $response)
    {
        $this->validate = $validate;
        $this->response = $response;
    }

    /**
     * @throws dml_exception
     * @throws Exception
     */
    public function solveTheEquation(array $data): string
    {
        global $DB;

        $this->validate->isQuadraticEquation($data['a']);

        $this->response->a = (float)$data['a'];
        $this->response->b = (float)$data['b'];
        $this->response->c = (float)$data['c'];

        $discriminant = $data['b'] ** 2 - 4 * $data['a'] * $data['c'];
        if ($discriminant > 0) {
            $x1 = (-$data['b'] + sqrt($discriminant)) / (2 * $data['a']);
            $x2 = (-$data['b'] - sqrt($discriminant)) / (2 * $data['a']);
            $this->response->x1 = (string)$x1;
            $this->response->x2 = (string)$x2;
            $DB->insert_record('block_equation', $this->response);
            return " x1 = $x1, x2 = $x2";
        } elseif ($discriminant == 0) {
            $x = -$data['b'] / (2 * $data['a']);
            $this->response->x1 = (string)$x;
            $this->response->x2 = (string)$x;
            $DB->insert_record('block_equation', $this->response);
            return "x1 = $x, x2 = $x";
        } else {
            $sqrtD = sqrt(-$discriminant) . 'i';
            $x = -$data['b'] / (2 * $data['a']);
            $this->response->x1 = "($data[b] + $sqrtD)/(2*$data[a])";
            $this->response->x2 = "($data[b] - $sqrtD)/(2*$data[a])";
            $DB->insert_record('block_equation', $this->response);
            return "x1 = $x + $sqrtD, x2 = $x - $sqrtD";
        }
    }
}