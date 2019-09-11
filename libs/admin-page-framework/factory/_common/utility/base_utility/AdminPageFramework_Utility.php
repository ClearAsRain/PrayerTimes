<?php 
/**
	Admin Page Framework v3.8.20 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/LazyCoalaCodes>
	Copyright (c) 2013-2019, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
abstract class LazyCoala_AdminPageFramework_Utility_Deprecated {
    static public function minifyCSS($sCSSRules) {
        LazyCoala_AdminPageFramework_Utility::showDeprecationNotice(__FUNCTION__, 'getCSSMinified()');
        return LazyCoala_AdminPageFramework_Utility_String::getCSSMinified($sCSSRules);
    }
    static public function sanitizeLength($sLength, $sUnit = 'px') {
        LazyCoala_AdminPageFramework_Utility::showDeprecationNotice(__FUNCTION__, 'getLengthSanitized()');
        return LazyCoala_AdminPageFramework_Utility_String::getLengthSanitized($sLength, $sUnit);
    }
    public static function getCorrespondingArrayValue($vSubject, $sKey, $sDefault = '', $bBlankToDefault = false) {
        LazyCoala_AdminPageFramework_Utility::showDeprecationNotice(__FUNCTION__, 'getElement()');
        if (!isset($vSubject)) {
            return $sDefault;
        }
        if ($bBlankToDefault && $vSubject == '') {
            return $sDefault;
        }
        if (!is_array($vSubject)) {
            return ( string )$vSubject;
        }
        if (isset($vSubject[$sKey])) {
            return $vSubject[$sKey];
        }
        return $sDefault;
    }
    static public function isAssociativeArray(array $aArray) {
        LazyCoala_AdminPageFramework_Utility::showDeprecationNotice(__FUNCTION__);
        return ( bool )count(array_filter(array_keys($aArray), 'is_string'));
    }
    public static function getArrayDimension($array) {
        LazyCoala_AdminPageFramework_Utility::showDeprecationNotice(__FUNCTION__);
        return (is_array(reset($array))) ? self::getArrayDimension(reset($array)) + 1 : 1;
    }
    protected function getFieldElementByKey($asElement, $sKey, $asDefault = '') {
        LazyCoala_AdminPageFramework_Utility::showDeprecationNotice(__FUNCTION__, 'getElement()');
        if (!is_array($asElement) || !isset($sKey)) {
            return $asElement;
        }
        $aElements = & $asElement;
        return isset($aElements[$sKey]) ? $aElements[$sKey] : $asDefault;
    }
    static public function shiftTillTrue(array $aArray) {
        LazyCoala_AdminPageFramework_Utility::showDeprecationNotice(__FUNCTION__);
        foreach ($aArray as & $vElem) {
            if ($vElem) {
                break;
            }
            unset($vElem);
        }
        return array_values($aArray);
    }
    static public function getAttributes(array $aAttributes) {
        LazyCoala_AdminPageFramework_Utility::showDeprecationNotice(__METHOD__, 'LazyCoala_AdminPageFramework_WPUtility::getAttributes()');
        $_sQuoteCharactor = "'";
        $_aOutput = array();
        foreach ($aAttributes as $sAttribute => $sProperty) {
            if (in_array(gettype($sProperty), array('array', 'object'))) {
                continue;
            }
            $_aOutput[] = "{$sAttribute}={$_sQuoteCharactor}{$sProperty}{$_sQuoteCharactor}";
        }
        return implode(' ', $_aOutput);
    }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_VariableType extends LazyCoala_AdminPageFramework_Utility_Deprecated {
        static public function isResourcePath($sPathOrURL) {
            if (defined('PHP_MAXPATHLEN') && strlen($sPathOrURL) > PHP_MAXPATHLEN) {
                return ( boolean )filter_var($sPathOrURL, FILTER_VALIDATE_URL);
            }
            if (file_exists($sPathOrURL)) {
                return true;
            }
            return ( boolean )filter_var($sPathOrURL, FILTER_VALIDATE_URL);
        }
        static public function isNotNull($mValue = null) {
            return !is_null($mValue);
        }
        static public function isNumericInteger($mValue) {
            return is_numeric($mValue) && is_int($mValue + 0);
        }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_String extends LazyCoala_AdminPageFramework_Utility_VariableType {
        static public function getLengthSanitized($sLength, $sUnit = 'px') {
            $sLength = $sLength ? $sLength : 0;
            return is_numeric($sLength) ? $sLength . $sUnit : $sLength;
        }
        public static function sanitizeSlug($sSlug) {
            return is_null($sSlug) ? null : preg_replace('/[^a-zA-Z0-9_\x7f-\xff]/', '_', trim($sSlug));
        }
        public static function sanitizeString($sString) {
            return is_null($sString) ? null : preg_replace('/[^a-zA-Z0-9_\x7f-\xff\-]/', '_', $sString);
        }
        static public function getNumberFixed($nToFix, $nDefault, $nMin = '', $nMax = '') {
            if (!is_numeric(trim($nToFix))) {
                return $nDefault;
            }
            if ($nMin !== '' && $nToFix < $nMin) {
                return $nMin;
            }
            if ($nMax !== '' && $nToFix > $nMax) {
                return $nMax;
            }
            return $nToFix;
        }
        static public function fixNumber($nToFix, $nDefault, $nMin = '', $nMax = '') {
            return self::getNumberFixed($nToFix, $nDefault, $nMin, $nMax);
        }
        static public function getCSSMinified($sCSSRules) {
            return str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $sCSSRules));
        }
        static public function getStringLength($sString) {
            return function_exists('mb_strlen') ? mb_strlen($sString) : strlen($sString);
        }
        static public function getNumberOfReadableSize($nSize) {
            $_nReturn = substr($nSize, 0, -1);
            switch (strtoupper(substr($nSize, -1))) {
                case 'P':
                    $_nReturn*= 1024;
                case 'T':
                    $_nReturn*= 1024;
                case 'G':
                    $_nReturn*= 1024;
                case 'M':
                    $_nReturn*= 1024;
                case 'K':
                    $_nReturn*= 1024;
            }
            return $_nReturn;
        }
        static public function getReadableBytes($nBytes) {
            $_aUnits = array(0 => 'B', 1 => 'KB', 2 => 'MB', 3 => 'GB');
            $_nLog = log($nBytes, 1024);
            $_iPower = ( int )$_nLog;
            $_iSize = pow(1024, $_nLog - $_iPower);
            return $_iSize . $_aUnits[$_iPower];
        }
        static public function getPrefixRemoved($sString, $sPrefix) {
            return self::hasPrefix($sPrefix, $sString) ? substr($sString, strlen($sPrefix)) : $sString;
        }
        static public function getSuffixRemoved($sString, $sSuffix) {
            return self::hasSuffix($sSuffix, $sString) ? substr($sString, 0, strlen($sSuffix) * -1) : $sString;
        }
        static public function hasPrefix($sNeedle, $sHaystack) {
            return ( string )$sNeedle === substr($sHaystack, 0, strlen(( string )$sNeedle));
        }
        static public function hasSuffix($sNeedle, $sHaystack) {
            $_iLength = strlen(( string )$sNeedle);
            if (0 === $_iLength) {
                return true;
            }
            return substr($sHaystack, -$_iLength) === $sNeedle;
        }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_Array extends LazyCoala_AdminPageFramework_Utility_String {
        static public function getUnusedNumericIndex($aArray, $nIndex, $iOffset = 1) {
            if (!isset($aArray[$nIndex])) {
                return $nIndex;
            }
            return self::getUnusedNumericIndex($aArray, $nIndex + $iOffset, $iOffset);
        }
        static public function isAssociative(array $aArray) {
            return array_keys($aArray) !== range(0, count($aArray) - 1);
        }
        static public function isLastElement(array $aArray, $sKey) {
            end($aArray);
            return $sKey === key($aArray);
        }
        static public function isFirstElement(array $aArray, $sKey) {
            reset($aArray);
            return $sKey === key($aArray);
        }
        static public function getReadableListOfArray(array $aArray) {
            $_aOutput = array();
            foreach ($aArray as $_sKey => $_vValue) {
                $_aOutput[] = self::getReadableArrayContents($_sKey, $_vValue, 32) . PHP_EOL;
            }
            return implode(PHP_EOL, $_aOutput);
        }
        static public function getReadableArrayContents($sKey, $vValue, $sLabelCharLengths = 16, $iOffset = 0) {
            $_aOutput = array();
            $_aOutput[] = ($iOffset ? str_pad(' ', $iOffset) : '') . ($sKey ? '[' . $sKey . ']' : '');
            if (!in_array(gettype($vValue), array('array', 'object'))) {
                $_aOutput[] = $vValue;
                return implode(PHP_EOL, $_aOutput);
            }
            foreach ($vValue as $_sTitle => $_asDescription) {
                if (!in_array(gettype($_asDescription), array('array', 'object'))) {
                    $_aOutput[] = str_pad(' ', $iOffset) . $_sTitle . str_pad(':', $sLabelCharLengths - self::getStringLength($_sTitle)) . $_asDescription;
                    continue;
                }
                $_aOutput[] = str_pad(' ', $iOffset) . $_sTitle . ": {" . self::getReadableArrayContents('', $_asDescription, 16, $iOffset + 4) . PHP_EOL . str_pad(' ', $iOffset) . "}";
            }
            return implode(PHP_EOL, $_aOutput);
        }
        static public function getReadableListOfArrayAsHTML(array $aArray) {
            $_aOutput = array();
            foreach ($aArray as $_sKey => $_vValue) {
                $_aOutput[] = "<ul class='array-contents'>" . self::getReadableArrayContentsHTML($_sKey, $_vValue) . "</ul>" . PHP_EOL;
            }
            return implode(PHP_EOL, $_aOutput);
        }
        static public function getReadableArrayContentsHTML($sKey, $vValue) {
            $_aOutput = array();
            $_aOutput[] = $sKey ? "<h3 class='array-key'>" . $sKey . "</h3>" : "";
            if (!in_array(gettype($vValue), array('array', 'object'))) {
                $_aOutput[] = "<div class='array-value'>" . html_entity_decode(nl2br(str_replace(' ', '&nbsp;', $vValue)), ENT_QUOTES) . "</div>";
                return "<li>" . implode(PHP_EOL, $_aOutput) . "</li>";
            }
            foreach ($vValue as $_sKey => $_vValue) {
                $_aOutput[] = "<ul class='array-contents'>" . self::getReadableArrayContentsHTML($_sKey, $_vValue) . "</ul>";
            }
            return implode(PHP_EOL, $_aOutput);
        }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_ArrayGetter extends LazyCoala_AdminPageFramework_Utility_Array {
        static public function getFirstElement(array $aArray) {
            foreach ($aArray as $_mElement) {
                return $_mElement;
            }
        }
        static public function getElement($aSubject, $aisKey, $mDefault = null, $asToDefault = array(null)) {
            $_aToDefault = is_null($asToDefault) ? array(null) : self::getAsArray($asToDefault, true);
            $_mValue = self::getArrayValueByArrayKeys($aSubject, self::getAsArray($aisKey, true), $mDefault);
            return in_array($_mValue, $_aToDefault, true) ? $mDefault : $_mValue;
        }
        static public function getElementAsArray($aSubject, $aisKey, $mDefault = null, $asToDefault = array(null)) {
            return self::getAsArray(self::getElement($aSubject, $aisKey, $mDefault, $asToDefault), true);
        }
        static public function getIntegerKeyElements(array $aParse) {
            foreach ($aParse as $_isKey => $_v) {
                if (!is_numeric($_isKey)) {
                    unset($aParse[$_isKey]);
                    continue;
                }
                $_isKey = $_isKey + 0;
                if (!is_int($_isKey)) {
                    unset($aParse[$_isKey]);
                }
            }
            return $aParse;
        }
        static public function getNonIntegerKeyElements(array $aParse) {
            foreach ($aParse as $_isKey => $_v) {
                if (is_numeric($_isKey) && is_int($_isKey + 0)) {
                    unset($aParse[$_isKey]);
                }
            }
            return $aParse;
        }
        static public function getArrayValueByArrayKeys($aArray, $aKeys, $vDefault = null) {
            $_sKey = array_shift($aKeys);
            if (isset($aArray[$_sKey])) {
                if (empty($aKeys)) {
                    return $aArray[$_sKey];
                }
                if (is_array($aArray[$_sKey])) {
                    return self::getArrayValueByArrayKeys($aArray[$_sKey], $aKeys, $vDefault);
                }
                return $vDefault;
            }
            return $vDefault;
        }
        static public function getAsArray($mValue, $bPreserveEmpty = false) {
            if (is_array($mValue)) {
                return $mValue;
            }
            if ($bPreserveEmpty) {
                return ( array )$mValue;
            }
            if (empty($mValue)) {
                return array();
            }
            return ( array )$mValue;
        }
        static public function getArrayElementsByKeys(array $aSubject, array $aKeys) {
            return array_intersect_key($aSubject, array_flip($aKeys));
        }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_ArraySetter extends LazyCoala_AdminPageFramework_Utility_ArrayGetter {
        static public function sortArrayByKey($a, $b, $sKey = 'order') {
            return isset($a[$sKey], $b[$sKey]) ? $a[$sKey] - $b[$sKey] : 1;
        }
        static public function unsetDimensionalArrayElement(&$mSubject, array $aKeys) {
            $_sKey = array_shift($aKeys);
            if (!empty($aKeys)) {
                if (isset($mSubject[$_sKey]) && is_array($mSubject[$_sKey])) {
                    self::unsetDimensionalArrayElement($mSubject[$_sKey], $aKeys);
                }
                return;
            }
            if (is_array($mSubject)) {
                unset($mSubject[$_sKey]);
            }
        }
        static public function setMultiDimensionalArray(&$mSubject, array $aKeys, $mValue) {
            $_sKey = array_shift($aKeys);
            if (!empty($aKeys)) {
                if (!isset($mSubject[$_sKey]) || !is_array($mSubject[$_sKey])) {
                    $mSubject[$_sKey] = array();
                }
                self::setMultiDimensionalArray($mSubject[$_sKey], $aKeys, $mValue);
                return;
            }
            $mSubject[$_sKey] = $mValue;
        }
        static public function numerizeElements(array $aSubject) {
            $_aNumeric = self::getIntegerKeyElements($aSubject);
            $_aAssociative = self::invertCastArrayContents($aSubject, $_aNumeric);
            foreach ($_aNumeric as & $_aElem) {
                $_aElem = self::uniteArrays($_aElem, $_aAssociative);
            }
            if (!empty($_aAssociative)) {
                array_unshift($_aNumeric, $_aAssociative);
            }
            return $_aNumeric;
        }
        public static function castArrayContents(array $aModel, array $aSubject) {
            $_aCast = array();
            foreach ($aModel as $_isKey => $_v) {
                $_aCast[$_isKey] = self::getElement($aSubject, $_isKey, null);
            }
            return $_aCast;
        }
        public static function invertCastArrayContents(array $aModel, array $aSubject) {
            $_aInvert = array();
            foreach ($aModel as $_isKey => $_v) {
                if (array_key_exists($_isKey, $aSubject)) {
                    continue;
                }
                $_aInvert[$_isKey] = $_v;
            }
            return $_aInvert;
        }
        public static function uniteArrays() {
            $_aArray = array();
            foreach (array_reverse(func_get_args()) as $_aArg) {
                $_aArray = self::uniteArraysRecursive(self::getAsArray($_aArg), $_aArray);
            }
            return $_aArray;
        }
        public static function uniteArraysRecursive($aPrecedence, $aDefault) {
            if (is_null($aPrecedence)) {
                $aPrecedence = array();
            }
            if (!is_array($aDefault) || !is_array($aPrecedence)) {
                return $aPrecedence;
            }
            if (is_callable($aPrecedence)) {
                return $aPrecedence;
            }
            foreach ($aDefault as $sKey => $v) {
                if (!array_key_exists($sKey, $aPrecedence) || is_null($aPrecedence[$sKey])) {
                    $aPrecedence[$sKey] = $v;
                } else {
                    if (is_array($aPrecedence[$sKey]) && is_array($v)) {
                        $aPrecedence[$sKey] = self::uniteArraysRecursive($aPrecedence[$sKey], $v);
                    }
                }
            }
            return $aPrecedence;
        }
        static public function dropElementsByType(array $aArray, $aTypes = array('array')) {
            foreach ($aArray as $isKey => $vValue) {
                if (in_array(gettype($vValue), $aTypes)) {
                    unset($aArray[$isKey]);
                }
            }
            return $aArray;
        }
        static public function dropElementByValue(array $aArray, $vValue) {
            foreach (self::getAsArray($vValue, true) as $_vValue) {
                $_sKey = array_search($_vValue, $aArray, true);
                if ($_sKey === false) {
                    continue;
                }
                unset($aArray[$_sKey]);
            }
            return $aArray;
        }
        static public function dropElementsByKey(array $aArray, $asKeys) {
            foreach (self::getAsArray($asKeys, true) as $_isKey) {
                unset($aArray[$_isKey]);
            }
            return $aArray;
        }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_Path extends LazyCoala_AdminPageFramework_Utility_ArraySetter {
        static public function getRelativePath($from, $to) {
            $from = is_dir($from) ? rtrim($from, '\/') . '/' : $from;
            $to = is_dir($to) ? rtrim($to, '\/') . '/' : $to;
            $from = str_replace('\\', '/', $from);
            $to = str_replace('\\', '/', $to);
            $from = explode('/', $from);
            $to = explode('/', $to);
            $relPath = $to;
            foreach ($from as $depth => $dir) {
                if ($dir === $to[$depth]) {
                    array_shift($relPath);
                } else {
                    $remaining = count($from) - $depth;
                    if ($remaining > 1) {
                        $padLength = (count($relPath) + $remaining - 1) * -1;
                        $relPath = array_pad($relPath, $padLength, '..');
                        break;
                    } else {
                        $relPath[0] = './' . $relPath[0];
                    }
                }
            }
            return implode('/', $relPath);
        }
        static public function getCallerScriptPath($sRedirectedFilePath) {
            $_aRedirectedFilePaths = array($sRedirectedFilePath, __FILE__);
            $_sCallerFilePath = '';
            $_aBackTrace = call_user_func_array('debug_backtrace', self::_getDebugBacktraceArguments());
            foreach ($_aBackTrace as $_aDebugInfo) {
                $_sCallerFilePath = $_aDebugInfo['file'];
                if (in_array($_sCallerFilePath, $_aRedirectedFilePaths)) {
                    continue;
                }
                break;
            }
            return $_sCallerFilePath;
        }
        static private function _getDebugBacktraceArguments() {
            $_aArguments = array(defined('DEBUG_BACKTRACE_IGNORE_ARGS') ? DEBUG_BACKTRACE_IGNORE_ARGS : false, 6,);
            if (version_compare(PHP_VERSION, '5.4.0', '<')) {
                unset($_aArguments[1]);
            }
            return $_aArguments;
        }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_URL extends LazyCoala_AdminPageFramework_Utility_Path {
        static public function getQueryValueInURLByKey($sURL, $sQueryKey) {
            $_aURL = parse_url($sURL) + array('query' => '');
            parse_str($_aURL['query'], $aQuery);
            return self::getElement($aQuery, $sQueryKey, null);
        }
        static public function getCurrentURL() {
            $_bSSL = self::isSSL();
            $_sServerProtocol = strtolower($_SERVER['SERVER_PROTOCOL']);
            $_aProrocolSuffix = array(0 => '', 1 => 's',);
            $_sProtocol = substr($_sServerProtocol, 0, strpos($_sServerProtocol, '/')) . $_aProrocolSuffix[( int )$_bSSL];
            $_sPort = self::_getURLPortSuffix($_bSSL);
            $_sHost = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);
            return $_sProtocol . '://' . $_sHost . $_sPort . $_SERVER['REQUEST_URI'];
        }
        static private function _getURLPortSuffix($_bSSL) {
            $_sPort = isset($_SERVER['SERVER_PORT']) ? ( string )$_SERVER['SERVER_PORT'] : '';
            $_aPort = array(0 => ':' . $_sPort, 1 => '',);
            $_bPortSet = (!$_bSSL && '80' === $_sPort) || ($_bSSL && '443' === $_sPort);
            return $_aPort[( int )$_bPortSet];
        }
        static public function isSSL() {
            return array_key_exists('HTTPS', $_SERVER) && 'on' === $_SERVER['HTTPS'];
        }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_File extends LazyCoala_AdminPageFramework_Utility_URL {
        static public function getFileTailContents($asPath = array(), $iLines = 1) {
            $_sPath = self::_getFirstItem($asPath);
            if (!@is_readable($_sPath)) {
                return '';
            }
            return trim(implode('', array_slice(file($_sPath), -$iLines)));
        }
        static private function _getFirstItem($asItems) {
            $_aItems = is_array($asItems) ? $asItems : array($asItems);
            $_aItems = array_values($_aItems);
            return ( string )array_shift($_aItems);
        }
        static public function sanitizeFileName($sFileName, $sReplacement = '_') {
            $sFileName = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])", $sReplacement, $sFileName);
            return preg_replace("([\.]{2,})", '', $sFileName);
        }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_SystemInformation extends LazyCoala_AdminPageFramework_Utility_File {
        static private $_aPHPInfo;
        static public function getPHPInfo() {
            if (isset(self::$_aPHPInfo)) {
                return self::$_aPHPInfo;
            }
            ob_start();
            phpinfo(-1);
            $_sOutput = preg_replace(array('#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms', '#<h1>Configuration</h1>#', "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#', "#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%', '#<tr>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>' . '<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#', '#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#', '#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#', "# +#", '#<tr>#', '#</tr>#'), array('$1', '', '', '', '</$1>' . "\n", '<', ' ', ' ', ' ', '', ' ', '<h2>PHP Configuration</h2>' . "\n" . '<tr><td>PHP Version</td><td>$2</td></tr>' . "\n" . '<tr><td>PHP Egg</td><td>$1</td></tr>', '<tr><td>PHP Credits Egg</td><td>$1</td></tr>', '<tr><td>Zend Engine</td><td>$2</td></tr>' . "\n" . '<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'), ob_get_clean());
            $_aSections = explode('<h2>', strip_tags($_sOutput, '<h2><th><td>'));
            unset($_aSections[0]);
            $_aOutput = array();
            foreach ($_aSections as $_sSection) {
                $_iIndex = substr($_sSection, 0, strpos($_sSection, '</h2>'));
                preg_match_all('#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#', $_sSection, $_aAskApache, PREG_SET_ORDER);
                foreach ($_aAskApache as $_aMatches) {
                    if (!isset($_aMatches[1], $_aMatches[2])) {
                        array_slice($_aMatches, 2);
                        continue;
                    }
                    $_aOutput[$_iIndex][$_aMatches[1]] = !isset($_aMatches[3]) || $_aMatches[2] == $_aMatches[3] ? $_aMatches[2] : array_slice($_aMatches, 2);
                }
            }
            self::$_aPHPInfo = $_aOutput;
            return self::$_aPHPInfo;
        }
        static public function getDefinedConstants($asCategories = null, $asRemovingCategories = null) {
            $_aCategories = is_array($asCategories) ? $asCategories : array($asCategories);
            $_aCategories = array_filter($_aCategories);
            $_aRemovingCategories = is_array($asRemovingCategories) ? $asRemovingCategories : array($asRemovingCategories);
            $_aRemovingCategories = array_filter($_aRemovingCategories);
            $_aConstants = get_defined_constants(true);
            if (empty($_aCategories)) {
                return self::dropElementsByKey($_aConstants, $_aRemovingCategories);
            }
            return self::dropElementsByKey(array_intersect_key($_aConstants, array_flip($_aCategories)), $_aRemovingCategories);
        }
        static public function getPHPErrorLogPath() {
            $_aPHPInfo = self::getPHPInfo();
            return isset($_aPHPInfo['PHP Core']['error_log']) ? $_aPHPInfo['PHP Core']['error_log'] : '';
        }
        static public function getPHPErrorLog($iLines = 1) {
            $_sLog = self::getFileTailContents(self::getPHPErrorLogPath(), $iLines);
            return $_sLog ? $_sLog : print_r(@error_get_last(), true);
        }
    }
    abstract class LazyCoala_AdminPageFramework_Utility_HTMLAttribute extends LazyCoala_AdminPageFramework_Utility_SystemInformation {
        static public function getInlineCSS(array $aCSSRules) {
            $_aOutput = array();
            foreach ($aCSSRules as $_sProperty => $_sValue) {
                if (is_null($_sValue)) {
                    continue;
                }
                $_aOutput[] = $_sProperty . ': ' . $_sValue;
            }
            return implode('; ', $_aOutput);
        }
        static public function generateInlineCSS(array $aCSSRules) {
            return self::getInlineCSS($aCSSRules);
        }
        static public function getStyleAttribute($asInlineCSSes) {
            $_aCSSRules = array();
            foreach (array_reverse(func_get_args()) as $_asCSSRules) {
                if (is_array($_asCSSRules)) {
                    $_aCSSRules = array_merge($_asCSSRules, $_aCSSRules);
                    continue;
                }
                $__aCSSRules = explode(';', $_asCSSRules);
                foreach ($__aCSSRules as $_sPair) {
                    $_aCSSPair = explode(':', $_sPair);
                    if (!isset($_aCSSPair[0], $_aCSSPair[1])) {
                        continue;
                    }
                    $_aCSSRules[$_aCSSPair[0]] = $_aCSSPair[1];
                }
            }
            return self::getInlineCSS(array_unique($_aCSSRules));
        }
        static public function generateStyleAttribute($asInlineCSSes) {
            self::getStyleAttribute($asInlineCSSes);
        }
        static public function getClassAttribute() {
            $_aClasses = array();
            foreach (func_get_args() as $_asClasses) {
                if (!in_array(gettype($_asClasses), array('array', 'string'))) {
                    continue;
                }
                $_aClasses = array_merge($_aClasses, is_array($_asClasses) ? $_asClasses : explode(' ', $_asClasses));
            }
            $_aClasses = array_unique(array_filter($_aClasses));
            return trim(implode(' ', $_aClasses));
        }
        static public function generateClassAttribute() {
            $_aParams = func_get_args();
            return call_user_func_array(array(__CLASS__, 'getClassAttribute'), $_aParams);
        }
        static public function getDataAttributeArray(array $aArray) {
            $_aNewArray = array();
            foreach ($aArray as $sKey => $v) {
                if (in_array(gettype($v), array('object', 'NULL'))) {
                    continue;
                }
                if (is_array($v)) {
                    $v = json_encode($v);
                }
                $_sKey = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $sKey));
                if ('' === $v) {
                    $_aNewArray["data-{$_sKey}"] = '';
                    continue;
                }
                $_aNewArray["data-{$_sKey}"] = $v ? $v : '0';
            }
            return $_aNewArray;
        }
    }
    class LazyCoala_AdminPageFramework_Utility extends LazyCoala_AdminPageFramework_Utility_HTMLAttribute {
        static public function showDeprecationNotice($sDeprecated, $sAlternative = '', $sProgramName = 'Admin Page Framework') {
            trigger_error($sProgramName . ': ' . sprintf($sAlternative ? '<code>%1$s</code> has been deprecated. Use <code>%2$s</code> instead.' : '<code>%1$s</code> has been deprecated.', $sDeprecated, $sAlternative), E_USER_NOTICE);
        }
        public function callBack($oCallable, $asParameters = array()) {
            $_aParameters = self::getAsArray($asParameters, true);
            $_mDefaultValue = self::getElement($_aParameters, 0);
            return is_callable($oCallable) ? call_user_func_array($oCallable, $_aParameters) : $_mDefaultValue;
        }
        static public function hasBeenCalled($sID) {
            if (isset(self::$_aCallStack[$sID])) {
                return true;
            }
            self::$_aCallStack[$sID] = true;
            return false;
        }
        static private $_aCallStack = array();
        static public function getOutputBuffer($oCallable, array $aParameters = array()) {
            ob_start();
            echo call_user_func_array($oCallable, $aParameters);
            $_sContent = ob_get_contents();
            ob_end_clean();
            return $_sContent;
        }
        static public function getObjectInfo($oInstance) {
            $_iCount = count(get_object_vars($oInstance));
            $_sClassName = get_class($oInstance);
            return '(object) ' . $_sClassName . ': ' . $_iCount . ' properties.';
        }
        static public function getAOrB($mValue, $mTrue = null, $mFalse = null) {
            return $mValue ? $mTrue : $mFalse;
        }
    }
    