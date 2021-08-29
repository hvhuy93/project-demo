<?php
return
[
    [
        'label' => 'Dashboard',
        'route' => 'admin',
        'icon' => 'fa-home'
    ],
  [
      'label' => 'Category',
      'route' => 'category.index',
      'icon' => 'fa-bars',
      'item' => [
          [
              'label' => 'All Category',
              'route' => 'category.index'
          ],
          [
              'label' => 'Add Category',
              'route' => 'category.create'
          ]
      ]
  ],
    [
        'label' => 'Product',
        'route' => 'product.index',
        'icon' => 'fa-box',
        'item' => [
            [
                'label' => 'All Product',
                'route' => 'product.index'
            ],
            [
                'label' => 'Add Product',
                'route' => 'product.create'
            ]
        ]
    ],
    [
        'label' => 'Slider',
        'route' => 'slide.index',
        'icon' => 'fa-image',
        'item' => [
            [
                'label' => 'List slide',
                'route' => 'slide.index'
            ],
            [
                'label' => 'Add slide',
                'route' => 'slide.create'
            ]
        ]
    ],
    [
        'label' => 'Cart',
        'route' => 'cart.index',
        'icon' => 'fa-shopping-cart'
    ]
];
