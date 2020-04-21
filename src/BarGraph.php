<?php

namespace CherryAudio\BarMetrics;

use Illuminate\Support\Str;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

abstract class BarGraph extends Partition
{
    public $component = 'bar-graph-metric';

    public function result(array $value)
    {
        return new PartitionResult($value);
    }

    public function shortenLabel($name, $manufacturer)
    {
        if ($name === 'Voltage Ignite Upgrade to Core + Electro Drums') {
            $name = 'VM Ignite ⇪';
        }
        if ($name === 'Voltage Module Designer') {
            $name = 'MD';
        }
        if (Str::startsWith($name, 'Voltage Modular')) {
            $name = str_replace('Voltage Modular', 'VM', $name);
        }
        if (Str::startsWith($name, 'VM Core')) {
            $name = str_replace(' Core', 'C', $name);
        }
        if (Str::contains($name, 'Electro Drums')) {
            $name = str_replace('Electro Drums', 'ED', $name);
        }
        if (Str::contains($name, 'Sixteen')) {
            $name = str_replace('Sixteen', '16', $name);
        }
        if (Str::contains($name, 'Sequencer')) {
            $name = str_replace('Sequencer', 'Seq.', $name);
        }
        if (Str::contains($name, 'Voltage-Controlled')) {
            $name = str_replace('Voltage-Controlled', 'VC', $name);
        }
        if (Str::contains($name, 'Oscillator')) {
            $name = str_replace('Oscillator', 'Osc', $name);
        }
        if (Str::startsWith($name, $manufacturer)) {
            $name = str_replace($manufacturer . ' ', '', $name);
        }
        if (Str::startsWith($name, 'PSP') || Str::startsWith($name, "Andrew Macaulay's")) {
            $name = str_replace(['PSP ', "Andrew Macaulay's "], '', $name);
        }

        return $name;
    }
}
