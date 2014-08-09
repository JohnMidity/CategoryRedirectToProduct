<?php

/*
 * Category redirect to product - a module for Prestashop v1.6
 * Copyright (C) kuzmany.biz/prestashop
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!defined('_PS_VERSION_'))
    exit;

class CategoryRedirectToProduct extends Module {

    public function __construct() {
        $this->name = 'categoryredirecttoproduct';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'kuzmany.biz/prestashop';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Category redirect to product detail');
        $this->description = $this->l('Redirect to product detail if category has only one product');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    /**
     * install
     */
    public function install() {

        if (!parent::install() ||
                !$this->registerHook('actionProductListModifier'))
            return false;
        return true;
    }

    /**
     * uninstall
     */
    public function uninstall() {
        if (!parent::uninstall())
            return false;
        return true;
    }

    public function hookActionProductListModifier($params) {
        if ($params['nb_products'] == 1)
            Tools::redirect($params['cat_products'][0]['link']);
    }

}

?>
