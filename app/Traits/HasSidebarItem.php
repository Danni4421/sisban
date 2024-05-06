<?php

namespace App\Traits;

trait HasSidebarItem
{
    public function init()
    {
        $this->NAVIGATION_RT = (object) [
            'menu' => (object) [
                'label' => 'MENU',
                'func' => 'root',
                'children' => (object) [
                    'beranda' => (object) [
                        'label' => 'Beranda',
                        'href' => '',
                        'active' => ['/'],
                        'func' => 'nav-item',
                        'icon' => 'far fa-calendar-alt',
                        'with_level' => true,
                    ],
                    'pengajuan' => (object) [
                        'label' => 'Pengajuan',
                        'href' => 'pengajuan',
                        'icon' => 'far fa-envelope',
                        'with_level' => true,
                        'active' => [
                            '/pengajuan',
                            '/pengajuan/masuk',
                            '/pengajuan/disetujui'
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
                    'bansos' => (object) [
                        'label' => 'Bansos',
                        'href' => 'bansos',
                        'icon' => 'fas fa-book',
                        'active' => [
                            '/bansos',
                            '/bansos/jenis',
                            '/bansos/penerima'
                        ],
                        'with_level' => true,
                        'children' => (object) [
                            'jenis' => (object) [
                                'label' => 'Jenis',
                                'href' => 'bansos/jenis',
                                'func' => 'nav-item',
                                'icon' => 'far fa-circle',
                                'with_level' => true,
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
                    'notifikasi' => (object) [
                        'label' => 'Notifikasi',
                        'href' => 'notifikasi',
                        'func' => 'nav-item',
                        'icon' => 'far fa-bell',
                        'active' => ['/notifikasi'],
                        'with_level' => true,
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
                        'active' => ['/pengaturan'],
                        'with_level' => false,
                    ],
                    'faq' => (object) [
                        'label' => 'Bantuan & Pertanyaan',
                        'href' => 'faq',
                        'func' => 'nav-item',
                        'icon' => 'far fa-question-circle',
                        'active' => ['/faq'],
                        'with_level' => false,
                    ]
                ]
            ]
        ];

        $this->NAVIGATION_RW = (object) [
            'menu' => (object) [
                'label' => 'MENU',
                'func' => 'root',
                'children' => (object) [
                    'beranda' => (object) [
                        'label' => 'Beranda',
                        'href' => '',
                        'func' => 'nav-item',
                        'icon' => 'far fa-calendar-alt',
                        'active' => ['/'],
                        'with_level' => true,
                    ],
                    'data-rt' => (object) [
                        'label' => 'Data RT',
                        'href' => 'data-rt',
                        'func' => 'nav-item',
                        'icon' => 'fas fa-users',
                        'active' => ['/rt'],
                        'with_level' => true,
                    ],
                    'pengajuan' => (object) [
                        'label' => 'Pengajuan',
                        'href' => 'pengajuan',
                        'icon' => 'far fa-envelope',
                        'active' => (object) [
                            '/pengajuan',
                            '/pengajuan/masuk',
                            '/pengajuan/disetujui'
                        ],
                        'with_level' => true,
                        'children' => (object) [
                            'dataMasuk' => (object) [
                                'label' => 'Data Masuk',
                                'href' => 'pengajuan/masuk',
                                'func' => 'nav-item',
                                'icon' => 'far fa-circle'
                            ],
                            'dataDisetujui' => (object) [
                                'label' => 'Data Disetujui',
                                'href' => 'pengajuan/disetujui',
                                'func' => 'nav-item',
                                'icon' => 'far fa-circle'
                            ],
                        ]
                    ],
                    'penerima' => (object) [
                        'label' => 'Data Penerima',
                        'href' => 'bansos/penerima',
                        'icon' => 'fas fa-book',
                        'with_level' => true,
                        'active' => [
                            '/bansos',
                            '/bansos/penerima'
                        ],
                    ],
                    'notifikasi' => (object) [
                        'label' => 'Notifikasi',
                        'href' => 'notifikasi',
                        'func' => 'nav-item',
                        'icon' => 'far fa-bell',
                        'active' => ['/notifikasi'],
                        'with_level' => true,
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
                        'active' => ['/pengaturan'],
                        'with_level' => false,
                    ],
                    'faq' => (object) [
                        'label' => 'Bantuan & Pertanyaan',
                        'href' => 'faq',
                        'func' => 'nav-item',
                        'icon' => 'far fa-question-circle',
                        'active' => ['/faq'],
                        'with_level' => false,
                    ]
                ]
            ]
        ];

        $this->NAVIGATION_ADMIN = (object) [
            'menu' => (object) [
                'label' => 'MENU',
                'func' => 'root',
                'children' => (object) [
                    'data-rw' => (object) [
                        'label' => 'Data RW',
                        'href' => 'data-rw',
                        'active' => ['/data-rw'],
                        'func' => 'nav-item',
                        'icon' => 'far fa-folder',
                        'with_level' => true,
                    ],
                    'data-rt' => (object) [
                        'label' => 'Data RT',
                        'href' => 'data-rt',
                        'active' => ['/data-rt'],
                        'func' => 'nav-item',
                        'icon' => 'fas fa-newspaper',
                        'with_level' => true,
                    ],
                    'pemohon' => (object) [
                        'label' => 'Pemohon',
                        'href' => 'pemohon',
                        'icon' => 'far fa-envelope',
                        'active' => ['/pemohon'],
                        'with_level' => true,
                    ],
                    'bansos' => (object) [
                        'label' => 'Bansos',
                        'href' => 'bansos/penerima',
                        'icon' => 'fas fa-book',
                        'active' => [
                            '/bansos',
                            '/bansos/jenis',
                            '/bansos/penerima'
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
        ];
    }
}
