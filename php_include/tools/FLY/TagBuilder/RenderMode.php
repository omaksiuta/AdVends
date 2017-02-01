<?php

/* =======================================================================

FLY PHP Package
Copyright (C) 2011  Yves Feupi Lepatio

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

======================================================================= */


/**
 * This is used as enumeration to define render modes of a tag.
 * 
 * @package FLY
 * @subpackage TagBuilder
 */
class FLY_TagBuilder_RenderMode
{
    /**
     * @var int
     */
    const END_TAG = 0;

    /**
     * @var int
     */
    const NORMAL = 1;

    /**
     * @var int
     */
    const SELF_CLOSING = 2;

    /**
     * @var int
     */
    const START_TAG = 3;

    /**
     * Deny to create an instance of this class.
     */
    private function  __construct()
    {}
}
