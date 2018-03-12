<?php
declare(strict_types=1);

namespace jens1o\airport;

class Airport extends Point {

    protected $data;

    public function __construct(array $data) {
        $this->data = $data['tags'];

        parent::__construct($data['lat'], $data['lon']);
    }

    public function __get(string $key) {
        return $this->data[$key];
    }

    public function getName(): string {
        return $this->data['name'];
    }

}