<?php

namespace GFPDF\Plugins\DeveloperToolkit\Legacy;

use GFPDF\Helper\Helper_Interface_Actions;

/**
 * @package     Gravity PDF Developer Toolkit
 * @copyright   Copyright (c) 2018, Blue Liquid Designs
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
    This file is part of Gravity PDF Developer Toolkit.

    Copyright (c) 2018, Blue Liquid Designs

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


class Deactivate implements Helper_Interface_Actions {

	/**
	 * @since 1.0
	 */
	public function init() {
		$this->add_actions();
	}

	/**
	 * @since 1.0
	 */
	public function add_actions() {
		add_action( 'admin_init', [ $this, 'maybe_deactivate_legacy_plugin' ] );
	}

	/**
	 * Deactivate our Tier 2 plugin (if it exists) as the Dev Toolkit is a drop-in replacement
	 *
	 * @since 1.0
	 */
	public function maybe_deactivate_legacy_plugin() {
		$legacy_plugin = 'gravity-pdf-tier-2/plus.php';

		if ( is_plugin_active( $legacy_plugin ) ) {
			deactivate_plugins( 'gravity-pdf-tier-2/plus.php' );
		}
	}

}