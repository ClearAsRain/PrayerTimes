<?php 
/**
	Admin Page Framework v3.8.20 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/LazyCoalaCodes>
	Copyright (c) 2013-2019, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class LazyCoala_AdminPageFramework_FieldType__nested extends LazyCoala_AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('_nested');
    protected $aDefaultKeys = array();
    protected function getStyles() {
        return ".LazyCoalaCodes-fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field.with-nested-fields > .LazyCoalaCodes-fieldset.multiple-nesting {margin-left: 2em;}.LazyCoalaCodes-fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field.with-nested-fields > .LazyCoalaCodes-fieldset {margin-bottom: 1em;}.with-nested-fields > .LazyCoalaCodes-fieldset.child-fieldset > .LazyCoalaCodes-child-field-title {display: inline-block;padding: 0 0 0.4em 0;}.LazyCoalaCodes-fieldset.child-fieldset > label.LazyCoalaCodes-child-field-title {display: table-row; white-space: nowrap;}";
    }
    protected function getField($aField) {
        $_oCallerForm = $aField['_caller_object'];
        $_aInlineMixedOutput = array();
        foreach ($this->getAsArray($aField['content']) as $_aChildFieldset) {
            if (is_scalar($_aChildFieldset)) {
                continue;
            }
            if (!$this->isNormalPlacement($_aChildFieldset)) {
                continue;
            }
            $_aChildFieldset = $this->getFieldsetReformattedBySubFieldIndex($_aChildFieldset, ( integer )$aField['_index'], $aField['_is_multiple_fields'], $aField);
            $_oFieldset = new LazyCoala_AdminPageFramework_Form_View___Fieldset($_aChildFieldset, $_oCallerForm->aSavedData, $_oCallerForm->getFieldErrors(), $_oCallerForm->aFieldTypeDefinitions, $_oCallerForm->oMsg, $_oCallerForm->aCallbacks);
            $_aInlineMixedOutput[] = $_oFieldset->get();
        }
        return implode('', $_aInlineMixedOutput);
    }
    }
    class LazyCoala_AdminPageFramework_FieldType_inline_mixed extends LazyCoala_AdminPageFramework_FieldType__nested {
        public $aFieldTypeSlugs = array('inline_mixed');
        protected $aDefaultKeys = array('label_min_width' => '', 'show_debug_info' => false,);
        protected function getStyles() {
            return ".LazyCoalaCodes-field-inline_mixed {width: 98%;}.LazyCoalaCodes-field-inline_mixed > fieldset {display: inline-block;overflow-x: visible;padding-right: 0.4em;}.LazyCoalaCodes-field-inline_mixed > fieldset > .LazyCoalaCodes-fields{display: inline;width: auto;table-layout: auto;margin: 0;padding: 0;vertical-align: middle;white-space: nowrap;}.LazyCoalaCodes-field-inline_mixed > fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field {float: none;clear: none;width: 100%;display: inline-block;margin-right: auto;vertical-align: middle; }.with-mixed-fields > fieldset > label {width: auto;padding: 0;}.LazyCoalaCodes-field-inline_mixed > fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field .LazyCoalaCodes-input-label-string {padding: 0;}.LazyCoalaCodes-field-inline_mixed > fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field > .LazyCoalaCodes-input-label-container,.LazyCoalaCodes-field-inline_mixed > fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field > * > .LazyCoalaCodes-input-label-container{padding: 0;display: inline-block;width: 100%;}.LazyCoalaCodes-field-inline_mixed > fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field > .LazyCoalaCodes-input-label-container > label,.LazyCoalaCodes-field-inline_mixed > fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field > * > .LazyCoalaCodes-input-label-container > label{display: inline-block;}.LazyCoalaCodes-field-inline_mixed > fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field > .LazyCoalaCodes-input-label-container > label > input,.LazyCoalaCodes-field-inline_mixed > fieldset > .LazyCoalaCodes-fields > .LazyCoalaCodes-field > * > .LazyCoalaCodes-input-label-container > label > input{display: inline-block;min-width: 100%;margin-right: auto;margin-left: auto;}.LazyCoalaCodes-field-inline_mixed .LazyCoalaCodes-input-label-container,.LazyCoalaCodes-field-inline_mixed .LazyCoalaCodes-input-label-string{min-width: 0;}";
        }
    }
    