<?php
//https://www.phpclasses.org/browse/package/6663/download/zip.html

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


/** @see FLY_TagBuilder_RenderMode */
require_once 'FLY/TagBuilder/RenderMode.php';


/**
 * This generates HTML tags programmatically.
 *
 * This class composes the definition of an HTML tag, its attributes,
 * CSS styles and tag content. Once defined, the class can return the
 * HTML for the specified tag.
 *
 * @package FLY
 */
class FLY_TagBuilder
{
    /**
     * The tag name.
     * @var string
     */
    protected $_tagName = '';

    /**
     * The inner content.
     * @var string
     */
    protected $_innerHtml = '';

    /**
     * The attributes of the tag.
     * @see getAttributes()
     * @var array
     */
    protected $_attributes = array();

    /**
     * The list of inline tags known.
     * @var string[]
     */
    protected $_inlineTags = array (
        'meta', 'link', 'img', 'br', 'input', 'hr'
    );

    /**
     * Gets the tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->_tagName;
    }

    /**
     * Gets all the attributes of the tag.
     *
     * The returned array may look like this: <pre>
     * array(
     * &nbsp;&nbsp;&nbsp;&nbsp;'attributeName 1' => 'value 1',
     * &nbsp;&nbsp;&nbsp;&nbsp;'attributeName 2' => 'value 2',
     * &nbsp;&nbsp;&nbsp;&nbsp;...
     * )
     *</pre>
     * @return array Returns an empty array there are no attributes.
     * </pre>
     */
    public function getAttributes()
    {
        return $this->_attributes;
    }

    /**
     * Sets the inner content of the tag.
     *
     * @param string $content
     * @return FLY_TagBuilder
     */
    public function setInnerHtml($content)
    {
        $this->_innerHtml = (string) $content;

        return $this;
    }

    /**
     * Creates a new tag.
     *
     * @param string $tagName The name of the tag. <p>
     * $tagName must start with a letter and possibly be followed by one
     * or several alphanumerics.
     * </p>
     * @return void
     * @throws InvalidArgumentException if the tag name is not correct.
     */
    public function __construct($tagName)
    {
        if ( ! preg_match("/^[a-z][a-z0-9]*$/i", $tagName))
        {
            throw new InvalidArgumentException("'".$tagName."' is not a valid tag name");
        }

        $this->_tagName = strtolower($tagName);
    }

    /**
     * Static method for initialization.
     *
     * @see __construct()
     * @param string $tagName The tag name.
     * @return FLY_TagBuilder
     */
    public static function CreateTagBuilder($tagName)
    {
        return new self($tagName);
    }

    /**
     * Returns the HTML for the given tag.
     *
     * Note: Use this method instead of __toString() which should not be
     * implemented in order to distinguish this object from PHP string.
     *
     * @param int $renderMode [optional] The way the tag should be rendered.
     * $renderMode must be a value of {@link FLY_TagBuilder_RenderMode}.
     * <p>
     * The default value is <code>FLY_TagBuilder_RenderMode::NORMAL</code>.
     * If $renderMode is not a value of {@link FLY_TagBuilder_RenderMode},
     * an exception will be thrown.
     * </p>
     * @return string
     * @throws InvalidArgumentException if $renderMode is not in a correct render mode.
     */
    public function toString($renderMode = FLY_TagBuilder_RenderMode::NORMAL)
    {
        $result = '<' . $this->_tagName . $this->_buildAttributes();

        switch ($renderMode)
        {
            case FLY_TagBuilder_RenderMode::END_TAG:
                $result = '</' . $this->_tagName . '>';
                break;

            case FLY_TagBuilder_RenderMode::SELF_CLOSING:
                $result .= ' />';
                break;

            case FLY_TagBuilder_RenderMode::START_TAG:
                $result .= '>';
                break;

            case FLY_TagBuilder_RenderMode::NORMAL:
                $result .= $this->_isInlineTag()
                           ? ' />'
                           : sprintf('>%s</%s>', $this->_innerHtml, $this->_tagName);
                break;

            default:
                throw new InvalidArgumentException(
                    '$renderMode ' . "should be a value of class 'FLY_TagBuilder_RenderMode'");
        }

        return $result;
    }

    /**
     * Checks if the current tag is an inline tag.
     *
     * @return bool Returns true the tag is inline; false otherwise.
     */
    protected function _isInlineTag()
    {
        return in_array($this->_tagName, $this->_inlineTags);
    }

    /**
     * Returns a formatted string of the attributes list of the tag.
     * Example: id="logo" href="#" title="Home Page"
     *
     * @return string
     */
    protected function _buildAttributes()
    {
        if (0 == count($this->_attributes))
        {
            return '';
        }

        // TODO: Find another way of building attributes, including
        // the correct order of elements for the specified tag.

        $result = '';

        if ($this->hasAttribute('id'))
        {
            $result .= sprintf(' id="%s"', $this->_attributes['id']);
        }
        if ($this->hasAttribute('class'))
        {
            $result .= sprintf(' class="%s"', $this->_attributes['class']);
        }

        $this->removeAttribute(array('id', 'class'));

        foreach ($this->_attributes as $name => $value)
        {
            $result .= sprintf(' %s="%s"', $name, $value);
        }

        return $result;
    }

    /**
     * Removes the attribute(s).
     *
     * @param string|string[] $name The attribute name(s).
     * @return FLY_TagBuilder
     */
    public function removeAttribute($data)
    {
        if (is_string($data))
        {
            $data = array($data);
        }
        if ( ! is_array($data))
        {
            throw new InvalidArgumentException(
                'Expected parameter $data to be string or string[]: "'.gettype($data).'" given');
        }
        foreach ($data as $name)
        {
            $name = strtolower($name);
            if ($this->hasAttribute($name))
            {
                unset($this->_attributes[$name]);
            }
        }

        return $this;
    }

    /**
     * Checks if the tag has the attribute.
     *
     * @param string $name The attribute name.
     * @return bool Returns true if the tag has the attribute; false otherwise.
     */
    public function hasAttribute($name)
    {
        return array_key_exists(strtolower($name), $this->_attributes);
    }

    /**
     * Removes all attributes of the tag.
     *
     * @return FLY_TagBuilder
     */
    public function removeAllAttributes()
    {
        $this->_attributes = array();

        return $this;
    }

    /**
     * Merges the attributes.
     *
     * @param array $attributes The attribute names. See {@link getAttributes()} for more
     * details on the structure of elements.
     * @param bool $replaceExisting Replace existing attribute or not.
     * @return FLY_TagBuilder
     */
    public function mergeAttributes(array $attributes, $replaceExisting = true)
    {
        foreach ($attributes as $name => $value)
        {
            $this->mergeAttribute($name, $value, $replaceExisting);
        }

        return $this;
    }

    /**
     * Merges the attribute.
     *
     * @param string $name The attribute name.
     * Note:
     * - $name must start with a letter followed by alphanumerics.
     * - $name is stored in lower case.
     * @param string $value The attribute value.
     * @param bool $replaceExisting Replace existing attribute or not.
     * @return FLY_TagBuilder
     * @throws InvalidArgumentException if the attribute name is malformed
     */
    public function mergeAttribute($name, $value, $replaceExisting = true)
    {
        if ( ! preg_match("/^[a-z][a-z0-9]+$/i", $name))
        {
            throw new InvalidArgumentException("The attribute name '".$name."' is not well-named");
        }

        $name  = strtolower($name);
        $value = trim($value);

        // Call the appropriate method for the attribute 'class'
        // if we want to add it a value.
        if (($name == 'class') && ! $replaceExisting)
        {
            $this->addCssClass($value);
            return $this;
        }

        // Set/Overwrite the attribute if it doesn't yet exist
        // or if we have been asked to overwrite it.
        if ($replaceExisting || ! $this->hasAttribute($name))
        {
            $this->_attributes[$name] = $value;
        }

        return $this;
    }

    /**
     * Adds CSS value.
     *
     * @param string $value The value to add. <p>
     * $value can have several CSS classes separated by a space.
     * Example: <code>$value = 'sub-navigation options left'</code>
     * </p>
     * <p>
     * Note: If you add a CSS class that already exists,
     * the method will add it, not skip or overwrite!
     * </p>
     * @return FLY_TagBuilder
     */
    public function addCssClass($value)
    {
        // Reduce multiple spaces.
        $value = preg_replace("/ {2,}/", ' ', trim($value));

        if ($value == '')
        {
            return $this;
        }

        if ($this->hasAttribute('class'))
        {
            // Split the string into individual CSS class and cycle through them.
            foreach (explode(' ', $value) as $cssClass)
            {
                // Add the class.
                $this->_attributes['class'] .= ' ' . $cssClass;
            }
        }
        else
        {
            // Set the attribute of CSS classes with the given value.
            $this->_attributes['class'] = $value;
        }

        return $this;
    }

    /**
     * Removes CSS class if exists.
     *
     * @param string $value The value to remove. <p>
     * $value can have several CSS classes to remove separated by a space.
     * Example: <code>$value = 'sub-navigation options left'</code>
     * </p>
     * <p>
     * Note: Case is insensitive. So there is no difference between removing
     * 'currentnote' and 'currentNote'.
     * </p>
     * @return FLY_TagBuilder
     */
    public function removeCssClass($value)
    {
        // Reduce multiple spaces.
        $value = preg_replace("/ {2,}/", ' ', trim($value));

        if ($value == '')
        {
            return $this;
        }
        if ( ! $this->hasAttribute('class'))
        {
            return $this;
        }
        
        $cssValue = $this->_attributes['class'];

        // Split the string into individual CSS class and cycle through them.
        foreach (explode(' ', $value) as $cssClass)
        {
            // If the CSS class exists, then we remove it.
            if (false !== strpos($cssValue, $cssClass))
            {
                $cssValue = preg_replace("/ ?".$cssClass." ?/i", ' ', $cssValue);
            }
        }
        // Save the modification.
        $this->_attributes['class'] = trim($cssValue);

        return $this;
    }
}
