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
                            'active' => ['rt.dashboard'],
                            'func' => 'nav-item',
                            'icon' => 'fa-solid fa-calendar',
                            'with_level' => true
                        ],
                        'keluarga' => (object) [
                            'label' => 'Keluarga',
                            'href' => 'keluarga',
                            'icon' => 'fa-solid fa-house',
                            'active' => [
                                'rt.keluarga',
                                'rt.keluarga.create',
                                'rt.keluarga.edit'
                            ],
                            'with_level' => true
                        ],
                        'pengajuan' => (object) [
                            'label' => 'Pengajuan',
                            'href' => 'pengajuan',
                            'icon' => 'fa-solid fa-envelope',
                            'with_level' => true,
                            'active' => [
                                'rt.pengajuan.incoming',
                                'rt.pengajuan.approved',
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
                                'rt.kandidat',
                                'rt.kandidat.add',
                            ],
                            'with_level' => true
                        ],
                        'bansos' => (object) [
                            'label' => 'Bansos',
                            'href' => 'bansos',
                            'icon' => 'fa-solid fa-book',
                            'active' => [
                                'rt.bansos',
                                'topsis.index',
                                'rt.bansos.alternative',
                                'rt.bansos.fuzzy',
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
                            'active' => ['general.pengaturan'],
                            'with_level' => false,
                        ],
                        'faq' => (object) [
                            'label' => 'Bantuan & Pertanyaan',
                            'href' => 'faq',
                            'func' => 'nav-item',
                            'icon' => 'far fa-question-circle',
                            'active' => ['general.faq'],
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
                            'active' => ['rw.dashboard'],
                            'with_level' => true,
                        ],
                        'data-rt' => (object) [
                            'label' => 'Data RT',
                            'href' => 'data-rt',
                            'func' => 'nav-item',
                            'icon' => 'fas fa-users',
                            'active' => [
                                'rw.data-rt',
                                'rw.data-rt.create',
                                'rw.data-rt.edit'
                            ],
                            'with_level' => true,
                        ],
                        'pemohon' => (object) [
                            'label' => 'Pemohon',
                            'href' => 'pemohon',
                            'icon' => 'far fa-envelope',
                            'active' => [
                                'rw.aplicant.approved',
                            ],
                            'with_level' => true,
                        ],
                        'bansos' => (object) [
                            'label' => 'Bansos',
                            'href' => 'bansos/jenis',
                            'icon' => 'fas fa-boxes',
                            'with_level' => true,
                            'active' => [
                                'rw.bansos',
                                'rw.bansos.create',
                                'rw.bansos.edit'
                            ],
                        ],
                        'penerima' => (object) [
                            'label' => 'Data Penerima',
                            'href' => 'bansos/penerima',
                            'icon' => 'fas fa-book',
                            'with_level' => true,
                            'active' => [
                                'rw.penerima.bansos',
                                'rw.penerima.bansos.add',
                                'rw.page.edit.bansos.recipient'
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
                            'active' => ['general.pengaturan'],
                            'with_level' => false,
                        ],
                        'faq' => (object) [
                            'label' => 'Bantuan & Pertanyaan',
                            'href' => 'faq',
                            'func' => 'nav-item',
                            'icon' => 'far fa-question-circle',
                            'active' => ['general.faq'],
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
                            'active' => [
                                'admin.data-rw',
                            ],
                            'func' => 'nav-item',
                            'icon' => 'far fa-folder',
                            'with_level' => true,
                        ],
                        'data-rt' => (object) [
                            'label' => 'Data RT',
                            'href' => 'data-rt',
                            'active' => [
                                'admin.data-rt.index',
                                'admin.data-rt.create',
                                'admin.data-rt.edit'
                            ],
                            'func' => 'nav-item',
                            'icon' => 'fas fa-newspaper',
                            'with_level' => true,
                        ],
                        'pemohon' => (object) [
                            'label' => 'Pemohon',
                            'href' => 'pemohon',
                            'icon' => 'far fa-envelope',
                            'active' => [
                                'admin.aplicant.index',
                            ],
                            'with_level' => true,
                        ],
                        'bansos' => (object) [
                            'label' => 'Bansos',
                            'href' => 'bansos/penerima',
                            'icon' => 'fas fa-book',
                            'active' => [
                                'admin.bansos.index',
                                'admin.bansos.create',
                                'admin.bansos.edit',
                                'admin.recipient.index',
                                'admin.recipient.add'
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
                            'active' => [
                                'admin.faq.index'
                            ],
                            'func' => 'nav-item',
                            'icon' => 'far fa-folder',
                            'with_level' => true,
                        ],
                        'logs' => (object) [
                            'label' => 'Logs',
                            'href' => 'view-logs',
                            'active' => [
                                'admin.view.logs'
                            ],
                            'func' => 'nav-item',
                            'icon' => 'fa-solid fa-list',
                            'with_level' => true
                        ],
                    ],
                ],
            ];
        }
    }
}
