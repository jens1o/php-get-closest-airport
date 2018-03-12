<?php
declare(strict_types=1);

namespace jens1o\airport;

class AirportListFactory {

    protected $filePath;

    public function __construct(string $filePath = './../src/data.json') {
        if (!\file_exists($filePath)) {
            throw new \InvalidArgumentException('The file given does not exist!');
        }

        $this->filePath = $filePath;
    }

    /**
     * @return Airport[]
     */
    public function getDecoratedList(): array {
        $airports = [];
        foreach ($this->getList() as $airportData) {
            $airports[] = new Airport($airportData);
        }

        return $airports;
    }

    public function getList(): array {
        return \json_decode($this->getFileSource(), true)['elements'];
    }

    protected function getFileSource(): string {
        return \file_get_contents($this->filePath);
    }

}