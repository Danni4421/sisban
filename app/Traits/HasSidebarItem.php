<?php

namespace App\Traits;

trait HasSidebarItem
{
    /**
     * Menu untuk role RT
     * 
     * @var array<object, object>
     */
    public $NAVIGATION_ITEM;

    public function init(string $level)
    {
        if ($level == "rt") {
            $this->NAVIGATION_ITEM = (object) [
                'menu' => (object) [
                    'label' => 'MENU',
                    'func' => 'root',
                    'children' => (object) [
                        'beranda' => (object) [
                            'label' => 'Beranda',
                            'href' => '/',
                            'active' => ['rt'],
                            'func' => 'nav-item',
                            'icon' => 'fa-solid fa-calendar',
                            'with_level' => true
                        ],
                        'keluarga' => (object) [
                            'label' => 'Keluarga',
                            'href' => 'keluarga',
                            'icon' => 'fa-solid fa-house',
                            'active' => [
                                'rt/keluarga'
                            ],
                            'with_level' => true
                        ],
                        'pengajuan' => (object) [
                            'label' => 'Pengajuan',
                            'href' => 'pengajuan',
                            'icon' => 'fa-solid fa-envelope',
                            'with_level' => true,
                            'active' => [
                                'rt/pengajuan',
                                'rt/pengajuan/masuk',
                                'rt/pengajuan/disetujui'
                            ],
                            'children' => (object) [
                                'dataMasuk' => (object) [
                                    'label' => 'Data Masuk',
                                    'href' => 'pengajuan/masuk',
                                    'func' => 'nav-item',
                                    'icon' => 'far fa-circle',
                                    'with_level' => true
                                ],
                                'dataDisetujui' => (object) [
                                    'label' => 'Data Disetujui',
                                    'href' => 'pengajuan/disetujui',
                                    'func' => 'nav-item',
                                    'icon' => 'far fa-circle',
                                    'with_level' => true
                                ],
                            ]
                        ],
                        'kandidat' => (object) [
                            'label' => 'Kandidat',
                            'href' => 'kandidat',
                            'icon' => 'fa-solid fa-users',
                            'active' => [
                                'rt/kandidat'
                            ],
                            'with_level' => true
                        ],
                        'bansos' => (object) [
                            'label' => 'Bansos',
                            'href' => 'bansos',
                            'icon' => 'fa-solid fa-book',
                            'active' => [
                                'rt/bansos',
                                'rt/bansos/jenis',
                                'rt/bansos/penerima'
                            ],
                            'with_level' => true,
                            'children' => (object) [
                                'jenis' => (object) [
                                    'label' => 'Jenis',
                                    'href' => 'bansos/jenis',
                                    'func' => 'nav-item',
                                    'icon' => 'far fa-circle',
                                    'with_level' => true
                                ],
                                'penerima' => (object) [
                                    'label' => 'Penerima',
                                    'href' => 'bansos/penerima',
                                    'func' => 'nav-item',
                                    'icon' => 'far fa-circle',
                                    'with_level' => true
                                ],
                            ],
                        ],
                    ],
                ],
                'other' => (object) [
                    'label' => 'OTHER',
                    'func' => 'root',
                    'children' => (object) [
                        'pengaturan' => (object) [
                            'label' => 'Pengaturan',
                            'href' => 'pengaturan',
                            'func' => 'nav-item',
                            'icon' => 'fa-solid fa-gear',
                            'active' => ['pengaturan'],
                            'with_level' => false,
                        ],
                        'faq' => (object) [
                            'label' => 'Bantuan & Pertanyaan',
                            'href' => 'faq',
                            'func' => 'nav-item',
                            'icon' => 'far fa-question-circle',
                            'active' => ['faq'],
                            'with_level' => false,
                        ]
                    ]
                ]
            ];
        }

        if ($level == "rw") {
            $this->NAVIGATION_ITEM = (object) [
                'menu' => (object) [
                    'label' => 'MENU',
                    'func' => 'root',
                    'children' => (object) [
                        'beranda' => (object) [
                            'label' => 'Beranda',
                            'href' => '',
                            'func' => 'nav-item',
                            'icon' => 'far fa-calendar-alt',
                            'active' => ['rw'],
                            'with_level' => true,
                        ],
                        'data-rt' => (object) [
                            'label' => 'Data RT',
                            'href' => 'data-rt',
                            'func' => 'nav-item',
                            'icon' => 'fas fa-users',
                            'active' => ['rw/data-rt'],
                            'with_level' => true,
                        ],
                        'pemohon' => (object) [
                            'label' => 'Pemohon',
                            'href' => 'pemohon',
                            'icon' => 'far fa-envelope',
                            'active' => [
                                'rw/pemohon',
                            ],
                            'with_level' => true,
                        ],
                        'bansos' => (object) [
                            'label' => 'Bansos',
                            'href' => 'bansos/jenis',
                            'icon' => 'fas fa-boxes',
                            'with_level' => true,
                            'active' => [
                                'rw/bansos',
                                'rw/bansos/jenis'
                            ],
                        ],
                        'penerima' => (object) [
                            'label' => 'Data Penerima',
                            'href' => 'bansos/penerima',
                            'icon' => 'fas fa-book',
                            'with_level' => true,
                            'active' => [
                                'rw/bansos',
                                'rw/bansos/penerima'
                            ],
                        ]
                    ],
                ],
                'other' => (object) [
                    'label' => 'OTHER',
                    'func' => 'root',
                    'children' => (object) [
                        'pengaturan' => (object) [
                            'label' => 'Pengaturan',
                            'href' => 'pengaturan',
                            'func' => 'nav-item',
                            'icon' => 'fas fa-cog',
                            'active' => ['pengaturan'],
                            'with_level' => false,
                        ],
                        'faq' => (object) [
                            'label' => 'Bantuan & Pertanyaan',
                            'href' => 'faq',
                            'func' => 'nav-item',
                            'icon' => 'far fa-question-circle',
                            'active' => ['faq'],
                            'with_level' => false,
                        ]
                    ]
                ]
            ];
        }

        if ($level == "admin") {
            $this->NAVIGATION_ITEM = (object) [
                'menu' => (object) [
                    'label' => 'MENU',
                    'func' => 'root',
                    'children' => (object) [
                        'data-rw' => (object) [
                            'label' => 'Data RW',
                            'href' => 'data-rw',
                            'active' => ['admin/data-rw'],
                            'func' => 'nav-item',
                            'icon' => 'far fa-folder',
                            'with_level' => true,
                        ],
                        'data-rt' => (object) [
                            'label' => 'Data RT',
                            'href' => 'data-rt',
                            'active' => ['admin/data-rt'],
                            'func' => 'nav-item',
                            'icon' => 'fas fa-newspaper',
                            'with_level' => true,
                        ],
                        'pemohon' => (object) [
                            'label' => 'Pemohon',
                            'href' => 'pemohon',
                            'icon' => 'far fa-envelope',
                            'active' => ['admin/pemohon'],
                            'with_level' => true,
                        ],
                        'bansos' => (object) [
                            'label' => 'Bansos',
                            'href' => 'bansos/penerima',
                            'icon' => 'fas fa-book',
                            'active' => [
                                'admin/bansos',
                                'admin/bansos/jenis',
                                'admin/bansos/penerima'
                            ],
                            'children' => (object) [
                                'jenis' => (object) [
                                    'label' => 'Jenis',
                                    'href' => 'bansos/jenis',
                                    'func' => 'nav-item',
                                    'icon' => 'far fa-circle',
                                    'with_level' => true
                                ],
                                'penerima' => (object) [
                                    'label' => 'Penerima',
                                    'href' => 'bansos/penerima',
                                    'func' => 'nav-item',
                                    'icon' => 'far fa-circle',
                                    'with_level' => true
                                ],
                            ]
                        ],
                    ],
                ],
                'other' => (object) [
                    'label' => 'OTHER',
                    'func' => 'root',
                    'children' => (object) [
                        'pertanyaan' => (object) [
                            'label' => 'Pertanyaan',
                            'href' => 'pertanyaan',
                            'active' => ['admin/pertanyaan'],
                            'func' => 'nav-item',
                            'icon' => 'far fa-folder',
                            'with_level' => true,
                        ],
                    ],
                ],
            ];
        }
    }
}
