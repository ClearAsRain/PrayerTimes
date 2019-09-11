<?php 
/**
	Admin Page Framework v3.8.20 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/LazyCoalaCodes>
	Copyright (c) 2013-2019, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class LazyCoala_AdminPageFramework_Form_View___CSS_Field extends LazyCoala_AdminPageFramework_Form_View___CSS_Base {
    protected function _get() {
        return $this->_getFormFieldRules();
    }
    static private function _getFormFieldRules() {
        return "td.LazyCoalaCodes-field-td-no-title {padding-left: 0;padding-right: 0;}.LazyCoalaCodes-fields {display: table; width: 100%;table-layout: fixed;}.LazyCoalaCodes-field input[type='number'] {text-align: right;} .LazyCoalaCodes-fields .disabled,.LazyCoalaCodes-fields .disabled input,.LazyCoalaCodes-fields .disabled textarea,.LazyCoalaCodes-fields .disabled select,.LazyCoalaCodes-fields .disabled option {color: #BBB;}.LazyCoalaCodes-fields hr {border: 0; height: 0;border-top: 1px solid #dfdfdf; }.LazyCoalaCodes-fields .delimiter {display: inline;}.LazyCoalaCodes-fields-description {margin-bottom: 0;}.LazyCoalaCodes-field {float: left;clear: both;display: inline-block;margin: 1px 0;}.LazyCoalaCodes-field label {display: inline-block; width: 100%;}@media screen and (max-width: 782px) {.form-table fieldset > label {display: inline-block;}}.LazyCoalaCodes-field .LazyCoalaCodes-input-label-container {margin-bottom: 0.25em;}@media only screen and ( max-width: 780px ) { .LazyCoalaCodes-field .LazyCoalaCodes-input-label-container {margin-top: 0.5em; margin-bottom: 0.5em;}} .LazyCoalaCodes-field .LazyCoalaCodes-input-label-string {padding-right: 1em; vertical-align: middle; display: inline-block; }.LazyCoalaCodes-field .LazyCoalaCodes-input-button-container {padding-right: 1em; }.LazyCoalaCodes-field .LazyCoalaCodes-input-container {display: inline-block;vertical-align: middle;}.LazyCoalaCodes-field-image .LazyCoalaCodes-input-label-container { vertical-align: middle;}.LazyCoalaCodes-field .LazyCoalaCodes-input-label-container {display: inline-block; vertical-align: middle; } .repeatable .LazyCoalaCodes-field {clear: both;display: block;}.LazyCoalaCodes-repeatable-field-buttons {float: right; margin: 0.1em 0 0.5em 0.3em;vertical-align: middle;}.LazyCoalaCodes-repeatable-field-buttons .repeatable-field-button {margin: 0 0.1em;font-weight: normal;vertical-align: middle;text-align: center;}@media only screen and (max-width: 960px) {.LazyCoalaCodes-repeatable-field-buttons {margin-top: 0;}}.LazyCoalaCodes-sections.sortable-section > .LazyCoalaCodes-section,.sortable > .LazyCoalaCodes-field {clear: both;float: left;display: inline-block;padding: 1em 1.32em 1em;margin: 1px 0 0 0;border-top-width: 1px;border-bottom-width: 1px;border-bottom-style: solid;-webkit-user-select: none;-moz-user-select: none;user-select: none; text-shadow: #fff 0 1px 0;-webkit-box-shadow: 0 1px 0 #fff;box-shadow: 0 1px 0 #fff;-webkit-box-shadow: inset 0 1px 0 #fff;box-shadow: inset 0 1px 0 #fff;-webkit-border-radius: 3px;border-radius: 3px;background: #f1f1f1;background-image: -webkit-gradient(linear, left bottom, left top, from(#ececec), to(#f9f9f9));background-image: -webkit-linear-gradient(bottom, #ececec, #f9f9f9);background-image: -moz-linear-gradient(bottom, #ececec, #f9f9f9);background-image: -o-linear-gradient(bottom, #ececec, #f9f9f9);background-image: linear-gradient(to top, #ececec, #f9f9f9);border: 1px solid #CCC;background: #F6F6F6;} .LazyCoalaCodes-fields.sortable {margin-bottom: 1.2em; } .LazyCoalaCodes-field .button.button-small {width: auto;} .font-lighter {font-weight: lighter;} .LazyCoalaCodes-field .button.button-small.dashicons {font-size: 1.2em;padding-left: 0.2em;padding-right: 0.22em;min-width: 1em; }@media screen and (max-width: 782px) {.LazyCoalaCodes-field .button.button-small.dashicons {min-width: 1.8em; }}.LazyCoalaCodes-field .button.button-small.dashicons:before {position: relative;top: 7.2%;}@media screen and (max-width: 782px) {.LazyCoalaCodes-field .button.button-small.dashicons:before {top: 8.2%;}}.LazyCoalaCodes-field-title {font-weight: 600;min-width: 80px;margin-right: 1em;}.LazyCoalaCodes-fieldset {font-weight: normal;}.LazyCoalaCodes-input-label-container,.LazyCoalaCodes-input-label-string{min-width: 140px;}";
    }
    protected function _getVersionSpecific() {
        $_sCSSRules = '';
        if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
            $_sCSSRules.= ".LazyCoalaCodes-field .remove_value.button.button-small {line-height: 1.5em; }";
        }
        if (version_compare($GLOBALS['wp_version'], '3.8', '>=')) {
            $_sCSSRules.= ".LazyCoalaCodes-repeatable-field-buttons {margin: 2px 0 0 0.3em;}.LazyCoalaCodes-repeatable-field-buttons.disabled > .repeatable-field-button {color: #edd;border-color: #edd;} @media screen and ( max-width: 782px ) {.LazyCoalaCodes-fieldset {overflow-x: hidden;}}";
        }
        return $_sCSSRules;
    }
    }
    