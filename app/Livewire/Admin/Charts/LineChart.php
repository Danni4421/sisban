<?php

namespace App\Livewire\Admin\Charts;

use Livewire\Component;

class LineChart extends Component
{
    /**
     * @var array<int, string>
     */
    public array $labels;

    public array $datasets;

    public string $title;
    public string $id;

    public function __construct($title, $id)
    {
        $this->title = $title;
        $this->id = $id;
    }

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
        return view('livewire.admin.charts.line-chart')
            ->with('labels', $this->labels)
            ->with('datasets', $this->datasets)
            ->with('title', $this->title)
            ->with('id', $this->id);
    }
}
