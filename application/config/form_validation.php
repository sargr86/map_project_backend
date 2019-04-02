<?php
$config = [
    'add_tour' => [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ],
        [
            'field' => 'lat',
            'label' => 'Latitude',
            'rules' => 'required'
        ],
        [
            'field' => 'lng',
            'label' => 'Longitude',
            'rules' => 'required'
        ],
        [
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'required'
        ],
        [
            'field' => 'tours_type_id',
            'label' => 'Tours type',
            'rules' => 'required'
        ],
        [
            'field' => 'partner_id',
            'label' => 'Partner',
            'rules' => 'required'
        ],

    ],
    'add_ferry' => [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ],
        [
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required'
        ],
        [
            'field' => 'type',
            'label' => 'Type',
            'rules' => 'required'
        ],
        [
            'field' => 'max_people',
            'label' => 'Max people',
            'rules' => 'required'
        ],
        [
            'field' => 'min_people',
            'label' => 'Min people',
            'rules' => 'required'
        ],
        [
            'field' => 'partner_id',
            'label' => 'Partner',
            'rules' => 'required'
        ]
    ],
    'add_partner' => [
        [
            'field' => 'first_name',
            'label' => ' First Name',
            'rules' => 'required'
        ],
    ]
];