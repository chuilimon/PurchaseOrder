<?php
/**
 * Products, Quotations & sis modules.
 * Extensions to SugarCRM
 * @package Advanced OpenSales for SugarCRM
 * @subpackage Products
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
 * @author Salesagility Ltd <support@salesagility.com>
 */
	require_once('modules/AOS_pos/AOS_PO.php');
	require_once('modules/AOS_si/AOS_SI.php');
	require_once('modules/AOS_Products_PO/AOS_Products_PO.php');
	
	global $timedate;
	//Setting values in pos
	$po = new AOS_PO();
	$po->retrieve($_REQUEST['record']);
	$po->si_status = 'sid';
	$po->total_amt = format_number($po->total_amt);
	$po->discount_amount = format_number($po->discount_amount);
	$po->subtotal_amount = format_number($po->subtotal_amount);
	$po->tax_amount = format_number($po->tax_amount);
	if($po->shipping_amount != null)
	{
		$po->shipping_amount = format_number($po->shipping_amount);
	}
	$po->total_amount = format_number($po->total_amount);
	$po->save();
	
	//Setting si Values
	$si = new AOS_si();
	$rawRow = $po->fetched_row;
	$rawRow['id'] = '';
	$rawRow['template_ddown_c'] = ' ';
	$rawRow['po_number'] = $rawRow['number'];
	$rawRow['number'] = '';
	$dt = explode(' ',$rawRow['date_entered']);
	$rawRow['po_date'] = $dt[0];
	$rawRow['si_date'] = date('Y-m-d');
	$rawRow['total_amt'] = format_number($rawRow['total_amt']);
	$rawRow['discount_amount'] = format_number($rawRow['discount_amount']);
	$rawRow['subtotal_amount'] = format_number($rawRow['subtotal_amount']);
	$rawRow['tax_amount'] = format_number($rawRow['tax_amount']);
	$rawRow['date_entered'] = '';
	$rawRow['date_modified'] = '';
	if($rawRow['shipping_amount'] != null)
	{
		$rawRow['shipping_amount'] = format_number($rawRow['shipping_amount']);
	}
	$rawRow['total_amount'] = format_number($rawRow['total_amount']);
	$si->populateFromRow($rawRow);
	$si->process_save_dates =false;
	$si->save();
	
	//Setting si po relationship
	require_once('modules/Relationships/Relationship.php');
	$key = Relationship::retrieve_by_modules('AOS_pos', 'AOS_si', $GLOBALS['db']);
	if (!empty($key)) {
		$po->load_relationship($key);
		$po->$key->add($si->id);
	} 
	
	//Setting Line Items
	$sql = "SELECT * FROM aos_products_po WHERE parent_type = 'AOS_po' AND parent_id = '".$po->id."' AND deleted = 0";
  	$result = $this->bean->db->query($sql);
	while ($row = $this->bean->db->fetchByAssoc($result)) {
		$row['id'] = '';
		$row['parent_id'] = $si->id;
		$row['parent_type'] = 'AOS_si';
		if($row['product_cost_price'] != null)
		{
			$row['product_cost_price'] = format_number($row['product_cost_price']);
		}
		$row['product_list_price'] = format_number($row['product_list_price']);
		if($row['product_discount'] != null)
		{
			$row['product_discount'] = format_number($row['product_discount']);
			$row['product_discount_amount'] = format_number($row['product_discount_amount']);
		}
		$row['product_unit_price'] = format_number($row['product_unit_price']);
		$row['vat_amt'] = format_number($row['vat_amt']);
		$row['product_total_price'] = format_number($row['product_total_price']);
		$row['product_qty'] = format_number($row['product_qty']);
		$prod_si = new AOS_Products_po();
		$prod_si->populateFromRow($row);
		$prod_si->save();
	}
	ob_clean();
	header('Location: index.php?module=AOS_si&action=EditView&record='.$si->id);
?>
