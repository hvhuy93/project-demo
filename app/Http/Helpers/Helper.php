<?php


namespace App\Http\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>
                            <a href="' . $menu->thumb . '" target="_blank">
                                <img src="' . $menu->thumb . '" width="70px">
                            </a>

                        </td>
                        <td> ' . self::active($menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/fashion/admin/category/edit/' . $menu->id . '">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm"
                                onclick="removeRow(' . $menu->id . ', \'/fashion/admin/category/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '|--');
            }
        }

        return $html;
    }

    public static function active($active = 0)
    {
        return $active == 0 ? '<span class="btn btn-xs btn-danger">No</span>' : '<span class="btn btn-xs btn-success">Yes</span>';
    }


    //show to page home shopping
    public static function menus($menus, $parent_id = 0): string
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li>
                            <a href="/fashion/category/'.$menu ->id.'-'. Str::slug($menu->name, '-') . '.html">
                            ' . $menu->name . '
                            </a>';
                unset($menus[$key]);
                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }
                $html .= ' </li>';

            }
        }
        return $html;
    }

    //check child category
    public static function isChild($menus, $id): bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }
        return false;
    }

    public static function price($price = 0, $price_sale = 0)
    {
        if ( $price_sale != 0)  return number_format( $price_sale);
        if ($price != 0) return  number_format($price);
        return '<a href="/lien-he.html">Liên Hệ</a>';

    }
}
