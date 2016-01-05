<?php

/**
 * Advanced, robust set of sales and support modules.
 * @package Advanced OpenSales for SugarCRM
 * @copyright SalesAgility Ltd http://www.salesagility.com
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author Greg Soper <greg.soper@salesagility.com>
 */
 
$manifest = array(
    'acceptable_sugar_versions' => array (
      'regex_matches' => array (
		0 => "6.*",
		1 => "5.*",
      ),
    ),
    'acceptable_sugar_flavors' => array (
		0 => 'CE',
    ),
    'name'				=> 'Advanced OpenPurchase',
    'description'		=> 'Purchase order, Supplier invoice',
    'author'			=> 'jmlm',
    'published_date'	=> '2012-06-07',
    'version'			=> '5.1.2',
    'type'				=> 'module',
    'icon'				=> '',
    'is_uninstallable'	=> true,
    'remove_tables'		=> 'prompt',
);

$installdefs = array (
  'id' => 'AdvancedOpenPurchase',
  'beans' => 
  array (
    0 => 
    array (
      'module' => 'AOS_SI',
      'class' => 'AOS_SI',
      'path' => 'modules/AOS_SI/AOS_SI.php',
      'tab' => true,
    ),
    1 => 
    array (
      'module' => 'AOS_ProductsPO',
      'class' => 'AOS_ProductsPO',
      'path' => 'modules/AOS_ProductsPO/AOS_ProductsPO.php',
      'tab' => true,
    ),
    2 => 
    array (
      'module' => 'AOS_Products_PO',
      'class' => 'AOS_Products_PO',
      'path' => 'modules/AOS_Products_PO/AOS_Products_PO.php',
      'tab' => false,
    ),
    3 => 
    array (
      'module' => 'AOS_PO',
      'class' => 'AOS_PO',
      'path' => 'modules/AOS_PO/AOS_PO.php',
      'tab' => true,
    ),
  ),
  'layoutdefs' => 
  'relationships' => 
  array (
    0 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/aos_quotes_projectMetaData.php',
    ),
    1 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/aos_quotes_aos_invoicesMetaData.php',
    ),
    2 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/aos_quotes_aos_contractsMetaData.php',
    ),
  ),
  'image_dir' => '<basepath>/icons',
  'copy' => 
  array (
    1 => 
    array (
      'from' => '<basepath>/SugarModules/modules/AOS_SI',
      'to' => 'modules/AOS_SI',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/modules/AOS_ProductsPO',
      'to' => 'modules/AOS_ProductsPO',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/modules/AOS_Products_PO',
      'to' => 'modules/AOS_Products_PO',
    ),
    4 => 
    array (
      'from' => '<basepath>/SugarModules/modules/AOS_PO',
      'to' => 'modules/AOS_PO',
    ),
  ),
  'language' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
      'to_module' => 'application',
      'language' => 'en_us',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/language/application/es_es.lang.php',
      'to_module' => 'application',
      'language' => 'es_es',
    ),
  ),
  'vardefs' => 
);


