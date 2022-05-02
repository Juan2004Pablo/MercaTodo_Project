<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class Resource extends Enum
{
    //Admin User
    public const USER_INDEX = 'user.index';
    public const USER_UPDATE = 'user.update';
    public const USER_SHOW = 'user.show';
    public const USER_DISABLE = 'user.disable';

    //Admin Role
    public const ROLE_INDEX = 'role.index';
    public const ROLE_CREATE = 'role.create';
    public const ROLE_UPDATE = 'role.update';
    public const ROLE_SHOW = 'role.show';
    public const ROLE_DISABLE = 'role.disable';

    //Admin Category
    public const CATEGORY_INDEX = 'category.index';
    public const CATEGORY_CREATE = 'category.create';
    public const CATEGORY_SHOW = 'category.show';
    public const CATEGORY_UPDATE = 'category.update';
    public const CATEGORY_DISABLE = 'category.disable';

    //Admin Product
    public const PRODUCT_INDEX = 'product.index';
    public const PRODUCT_CREATE = 'product.create';
    public const PRODUCT_SHOW = 'product.show';
    public const PRODUCT_UPDATE = 'product.update';
    public const PRODUCT_DISABLE = 'product.disable';

    //Admin Show product in home
    public const SHOW_PRODUCT = 'show.product';

    //Shopping Cart
    public const CART_SHOW = 'cart.show';
    public const CART_ADD = 'cart.add';
    public const CART_DELETE = 'cart.delete';
    public const CART_TRASH = 'cart.trash';
    public const CART_UPDATE = 'cart.update';

    //Detail
    public const DETAIL_INDEX = 'detail.index';

    //Order
    public const ORDER_INDEX = 'order.index';
    public const ORDER_SHOW = 'order.show';

    //Pay
    public const PAY_CREATE = 'pay.create';
    public const PAY_REDIRECTION = 'pay.redirection';
    public const PAY_DATAOFORDER = 'pay.dataOfOrder';
    public const PAY_CONSULTPAYMENT = 'pay.consultPayment';
    public const PAY_UPDATEDATA = 'pay.updateData';
    public const PAY_SHOW = 'pay.Show';
    public const PAY_UPDATEORDER = 'pay.updateOrder';
    public const PAY_SHOWALL = 'pay.showAll';
    public const PAY_RETRY = 'pay.retry';

    //Import roles
    public const ROLES_IMPORT = 'roles.import';

    //Import categories
    public const CATEGORIES_IMPORT = 'categories.import';

    //Export roles
    public const ROLES_EXPORT = 'roles.export';

    //Export products
    public const PRODUCTS_EXPORT = 'products.export';

    //Export categories
    public const CATEGORIES_EXPORT = 'categories.export';

    //Export users
    public const USERS_EXPORT = 'users.export';

    //Home
    public const HOME_INDEX = 'home.index';

    public static function supported(): array
    {
        return collect(static::toArray())->values()->toArray();
    }
}
