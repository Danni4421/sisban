<?php

namespace App\Livewire\Admin\Charts;

use Livewire\Component;

class BarChart extends Component
{
    /**
     * @var array<int, string>
     */
    public array $labels;

    public array $datasets;

    public function setLabels(array $labels)
    {
        $this->labels = $labels;
    }

    public function setDataset(array $datasets)
    {
        $this->datasets = $datasets;
    }

    public function render()
    {
        return view('livewire.admin.charts.bar-chart')
            ->with('labels', $this->labels)
            ->with('datasets', $this->datasets);
    }
}
