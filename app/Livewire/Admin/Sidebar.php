<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Routing\Route;
use Livewire\Component;

class Sidebar extends Component
{
    /**
     * @var string
     */
    private $brand = 'Sisban';

    /**
     * @var User
     */
    private $user = null;

    /**
     * @var string
     */
    private $level = null;

    /**
     * Menu untuk role RT
     * 
     * @var array<object, object>
     */
    private $NAVIGATION_RT;

    /**
     * Menu untuk role RW
     * 
     * @var array<object, object>
     */
    private $NAVIGATION_RW;

    /**
     * Menu untuk role Admin
     * 
     * @var array<object, object>
     */
    private $NAVIGATION_ADMIN;
    
    public function __construct()
    {
        if (!is_null(auth()->user())) {
            $this->user = auth()->user();
            $this->level = $this->user->level;
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
                            'active' => (object) [
                                '/pengajuan',
                                '/pengajuan/masuk',
                                '/pengajuan/disetujui'
                            ],
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
                                    'icon' => 'far fa-circle'
                                ],
                                'penerima' => (object) [
                                    'label' => 'Penerima',
                                    'href' => 'bansos/penerima',
                                    'func' => 'nav-item',
                                    'icon' => 'far fa-circle'
                                ],
                            ],
                        ],
                        'notifikasi' => (object) [
                            'label' => 'Notifikasi',
                            'href' => 'notifikasi',
                            'func' => 'nav-item',
                            'icon' => 'far fa-bell',
                            'with_level' => false,
                        ]
                    ],
                ],
                'other' => (object) [
                    'label' => 'OTHER',
                    'func' => 'root',
                    'children' => (object) [
                        'pengaturan' => (object) [
                            'label' => 'Pengaturan',
                            'href' => 'settings',
                            'func' => 'nav-item',
                            'icon' => 'fas fa-cog',
                            'with_level' => false,
                        ],
                        'faq' => (object) [
                            'label' => 'Bantuan & Pertanyaan',
                            'href' => 'faq',
                            'func' => 'nav-item',
                            'icon' => 'far fa-question-circle',
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
                            'active' => ['/'],
                            'func' => 'nav-item',
                            'icon' => 'far fa-calendar-alt',
                            'with_level' => true,
                        ],
                        'data-rt' => (object) [
                            'label' => 'Data RT',
                            'href' => 'data-rt',
                            'active' => ['/rt'],
                            'func' => 'nav-item',
                            'icon' => 'fas fa-users',
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
                            'with_level' => false,
                        ]
                    ],
                ],
                'other' => (object) [
                    'label' => 'OTHER',
                    'func' => 'root',
                    'children' => (object) [
                        'pengaturan' => (object) [
                            'label' => 'Pengaturan',
                            'href' => 'settings',
                            'func' => 'nav-item',
                            'icon' => 'fas fa-cog',
                            'with_level' => false,
                        ],
                        'faq' => (object) [
                            'label' => 'Bantuan & Pertanyaan',
                            'href' => 'faq',
                            'func' => 'nav-item',
                            'icon' => 'far fa-question-circle',
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
                            'active' => ['/'],
                            'func' => 'nav-item',
                            'icon' => 'far fa-folder',
                            'with_level' => true,
                        ],
                        'data-rt' => (object) [
                            'label' => 'Data RT',
                            'href' => 'data-rt',
                            'active' => ['/rt'],
                            'func' => 'nav-item',
                            'icon' => 'fas fa-newspaper',
                            'with_level' => true,
                        ],
                        'pemohon' => (object) [
                            'label' => 'Pemohon',
                            'href' => 'pemohon',
                            'icon' => 'far fa-envelope',
                            'active' => (object) [
                                '/pengajuan',
                                '/pengajuan/masuk',
                                '/pengajuan/disetujui'
                            ],
                            'with_level' => true,
                        ],
                        'bansos' => (object) [
                            'label' => 'Bansos',
                            'href' => 'bansos/penerima',
                            'icon' => 'fas fa-book',
                            'with_level' => true,
                            'active' => [
                                'admin/bansos',
                                'admin/bansos/penerima'
                            ],
                            'children' => (object) [
                                'jenis' => (object) [
                                    'label' => 'Jenis',
                                    'href' => 'bansos/jenis',
                                    'func' => 'nav-item',
                                    'icon' => 'far fa-circle'
                                ],
                                'penerima' => (object) [
                                    'label' => 'Penerima',
                                    'href' => 'bansos/penerima',
                                    'func' => 'nav-item',
                                    'icon' => 'far fa-circle'
                                ],
                            ]
                        ],
                    ],
                ],
            ];
        }
    }

    public function render()
    {
        return view('livewire.admin.sidebar')->with([
            'level' => $this->level,
            'data' => $this->level === 'rt' ? $this->NAVIGATION_RT :
                      ($this->level === 'rw' ? $this->NAVIGATION_RW : $this->NAVIGATION_ADMIN)
        ]);
    }
}
