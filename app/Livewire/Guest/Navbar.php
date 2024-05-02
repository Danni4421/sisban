<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class Navbar extends Component
{
    /**
     * @var array<object, object>
     */
    public $NAVIGATION_ITEMS;

    /** @var string */
    public $ACTIVE_ITEM;

    public function __construct()
    {
        $this->NAVIGATION_ITEMS = (object) [
            'beranda' => (object) [
                'label' => 'Beranda',
                'href' => '/',
                'active' => 'beranda'
            ],
            'jenis' => (object) [
                'label' => 'Jenis',
                'href' => '/#jenis-bansos',
                'active' => 'jenis',
            ],
            'panduan' => (object) [
                'label' => 'Panduan',
                'href' => '/#panduan-pengajuan',
                'active' => 'panduan'
            ],
            'pengajuan' => (object) [
                'label' => 'Pengajuan',
                'href' => '/#pengajuan',
                'active' => 'pengajuan'
            ],
            'denah' => (object) [
                'label' => 'Denah',
                'href' => '/#denah',
                'active' => 'denah'
            ],
            'informasi' => (object) [
                'label' => 'Informasi',
                'href' => '/informasi',
                'active' => 'informasi',
                'children' => (object) [
                    'pemohon' => (object) [
                        'label' => 'Pemohon',
                        'href' => '/informasi/pemohon',
                        'active' => 'informasi'
                    ],
                    'penerima' => (object) [
                        'label' => 'Penerima',
                        'href' => '/informasi/penerima',
                        'active' => 'informasi'
                    ],
                ]
            ],
        ];
    }

    public function updateActiveItem($activeItem)
    {
        $this->ACTIVE_ITEM = $activeItem;
    }

    public function render()
    {
        return view('livewire.guest.navbar');
    }
}
