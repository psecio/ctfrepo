<?php

class Data
{
    /**
     * Generate some test data
     * 
     * @return array Set of test data and labels
     */
    public function generate()
    {
        $labels = [];
        for ($i = 1; $i <= 5; $i++) {
            $rand = mt_rand(0, 10);

            $labels[] = $rand;
            $data[] = $rand;
        }
        return [$labels, $data];
    }
    
    /**
     * Handle the serialized data
     *
     * @param string $data Input data string
     */
    public function handle($data)
    {
        $data = unserialize($data);
        if ($data == false) {
            list($labels, $data) = $this->generate();
        } else {
            $labels = array_keys($data);
            $data = array_values($data);
        }

        return [$labels, $data];
    }
}