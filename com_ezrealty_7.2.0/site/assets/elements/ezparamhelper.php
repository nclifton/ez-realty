<?php

/**
 * ------------------------------------------------------------------------
 * configuration helper
 * ------------------------------------------------------------------------
 */

// Ensure this file is being included by a parent file
defined('_JEXEC') or die('Restricted access');

class JFormFieldEzparamhelper extends JFormField
{
    /**
     * Element name
     *
     * @access	protected
     * @var		string
     */
    protected $type = 'Ezparamhelper';


    /**
     *
     * process input params
     * @return string element param
     */
    protected function getInput() {

		$uri = str_replace( JPATH_SITE, JURI::base(), "" );
		JHTML::stylesheet($uri . '/components/com_ezrealty/assets/elements/assets/css/ezparamhelper.css');
        $func = (string) $this->element['function'] ? (string) $this->element['function'] : '';
        $value = $this->value ? $this->value : (string) $this->element['default'];

        if (substr($func, 0, 1) == '@') {
            $func = substr($func, 1);
            if (method_exists($this, $func)) {
                return $this->$func();
            }
        }
        return;
    }


    /**
     *
     * Get Label of element param
     * @return string label
     */
    function getLabel()
    {
        $func = (string) $this->element['function'] ? (string) $this->element['function'] : '';
        if (substr($func, 0, 1) == '@' || !isset($this->label) || !$this->label)
            return;
        else
            return parent::getLabel();
    }


    /**
     * Render the title
     * @return	string  title
     */
    function title() {

        $_title = (string) $this->element['label'];
        $_description = $this->description;

        if ($_title) {
            $_title = html_entity_decode(JText::_($_title));
        }

        if ($_description) {
            $_description = html_entity_decode(JText::_($_description));
        }

        $entryID = time() + rand();

            $html = '
				<div class="ezsection" id="' . $entryID . '">
					<span class="hasTip" title="' . htmlentities($_description) . '"><img src="'.JURI::root().'components/com_ezrealty/assets/elements/assets/images/alert.png" alt="Notice" />' . $_title . '</span>
		    	</div>';

        return $html;
    }


}

?>