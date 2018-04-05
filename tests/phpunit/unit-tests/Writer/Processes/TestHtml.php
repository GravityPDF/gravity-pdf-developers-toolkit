<?php

namespace GFPDF\Tests\Writer\Processes;

use GFPDF\Plugins\DeveloperToolkit\Writer\Processes\Html;
use WP_UnitTestCase;
use mPDF;

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

    Copyright (C) 2018, Blue Liquid Designs

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

/**
 * Class TestHtml
 *
 * @package GFPDF\Tests\Writer\Processes
 *
 * @group   writer
 */
class TestHtml extends WP_UnitTestCase {

	/**
	 * @var Ellipse
	 * @since 1.0
	 */
	private $class;

	/**
	 * @since 1.0
	 */
	public function setUp() {
		$this->class = new Html();
		$this->class->set_mpdf( new mPDF() );
	}

	/**
	 * @since 1.0
	 */
	public function testHtml() {
		$this->assertTrue( method_exists( $this->class, 'addHtml' ) );
	}
}
