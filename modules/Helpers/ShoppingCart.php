<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 21/08/16
 * Time: 12:47 AM
 */

namespace Modules\Helpers;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class ShoppingCart
{
    public static function create($_data)
    {
        $data = json_encode($_data);

        $id = md5($data);

        if(!self::exist($id) && !is_null($data) && !is_null($_data))
        {
            /*Session::forget(Config::get('odavila.shopping_cart'));*/
            Session::put(Config::get('odavila.shopping_cart'), json_encode(['id' => $id, 'data' => $_data]) );
            Session::save();
        }

    }

    public static function createBookingID($_id){

        if(!is_null($_id))
        {
            if(!self::exist($_id))
            {
                Session::put(Config::get('odavila.bookig_cart'), json_encode(['id' => $_id]) );
                Session::save();
            }
        }
    }

    public static function get()
    {
        $cart = Session::get(Config::get('odavila.shopping_cart'));

        if(!is_null($cart))
        {
            $items = [];

            /*foreach ($cart as $item)
            {
                if(!is_null($item))
                    $items[] = json_decode( $item );
            }*/
            $items[] = json_decode( $cart );

            return $items;
        }
    }

    public static function getBookingID()
    {
        $cart = Session::get(Config::get('odavila.bookig_cart'));

        if(!is_null($cart))
        {
            $items = [];

            /*foreach ($cart as $item)
            {
                if(!is_null($item))
                    $items[] = json_decode( $item );
            }*/
            $items[] = json_decode( $cart );

            return $items;
        }
    }

    public static function items()
    {
        $_items = self::get();

        if(!is_null($_items))
        {
            return count($_items);
        }

        return null;
    }

    public static function clear()
    {
        Session::forget(Config::get('odavila.shopping_cart'));
    }

    public static function clearBookingID()
    {
        Session::forget(Config::get('odavila.bookig_cart'));
    }

    private static function exist($id)
    {
        $items = self::get();

        if(!is_null($items)) {
            foreach ($items as $item) {

                if ($item->id == $id)
                    return true;
            }
        }

        return false;
    }
}