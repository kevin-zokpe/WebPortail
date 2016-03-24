<?php
    class FlashMessages {
        const INFO    = 'i';
        const SUCCESS = 's';
        const WARNING = 'w';
        const ERROR   = 'e';
        const defaultType = self::INFO;

        protected $msgTypes = [
            self::ERROR   => 'error',
            self::WARNING => 'warning', 
            self::SUCCESS => 'success', 
            self::INFO    => 'info', 
        ];
        
        protected $msgWrapper = "<div class='%s'><div class='container'>%s</div></div>\n"; 
        
        protected $msgBefore = '';  
        protected $msgAfter  = ''; 
        
        protected $closeBtn  = '
            <button type="button" class="close"
                data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        ';
        
        protected $stickyCssClass = 'sticky';
        protected $msgCssClass = 'alert dismissable';
        protected $cssClassMap = [ 
            self::INFO    => 'alert-info',
            self::SUCCESS => 'alert-success',
            self::WARNING => 'alert-warning',
            self::ERROR   => 'alert-danger',
        ];

        protected $redirectUrl = null;
        protected $msgId;

        public function __construct() {
            $this->msgId = sha1(uniqid());

            if (!array_key_exists('flash_messages', $_SESSION)) {
                $_SESSION['flash_messages'] = [];
            }
        }

        public function info($message, $redirectUrl=null, $sticky=false) {
            return $this->add($message, self::INFO, $redirectUrl, $sticky);
        }

        public function success($message, $redirectUrl=null, $sticky=false) {
            return $this->add($message, self::SUCCESS, $redirectUrl, $sticky);
        }

        public function warning($message, $redirectUrl=null, $sticky=false) {
            return $this->add($message, self::WARNING, $redirectUrl, $sticky);
        }

        public function error($message, $redirectUrl=null, $sticky=false) {
            return $this->add($message, self::ERROR, $redirectUrl, $sticky);
        }

        public function sticky($message=true, $redirectUrl=null, $type=self::defaultType) {   
            return $this->add($message, $type, $redirectUrl, true);
        }

        public function add($message, $type=self::defaultType, $redirectUrl=null, $sticky=false) {
            if (!isset($message[0])) {
                return false;
            }

            if (strlen(trim($type)) > 1) {
                $type = strtolower($type[0]);
            }

            if (!array_key_exists($type, $this->msgTypes)) {
                $type = $this->defaultType;
            }
            
            if (!array_key_exists( $type, $_SESSION['flash_messages'] )) $_SESSION['flash_messages'][$type] = array();
            $_SESSION['flash_messages'][$type][] = ['sticky' => $sticky, 'message' => $message];

            if (!is_null($redirectUrl)) $this->redirectUrl = $redirectUrl;
            $this->doRedirect();
            
            return $this;
        }

        public function display($types=null, $print=true) {
            if (!isset($_SESSION['flash_messages'])) {
                return false;
            }

            $output = '';

            if (is_null($types) || !$types || (is_array($types) && empty($types)) ) {
                $types = array_keys($this->msgTypes);

            }

            elseif (is_array($types) && !empty($types)) {
                $theTypes = $types;
                $types = [];
                foreach($theTypes as $type) {
                    $types[] = strtolower($type[0]);
                }

            }

            else {
                $types = [strtolower($types[0])];
            }

            foreach ($types as $type) {
                if (!isset($_SESSION['flash_messages'][$type]) || empty($_SESSION['flash_messages'][$type]) ) continue;
                foreach( $_SESSION['flash_messages'][$type] as $msgData ) {
                    $output .= $this->formatMessage($msgData, $type);
                }
                $this->clear($type);            
            }

            
            if ($print) { 
                echo $output; 
            }

            else { 
                return $output; 
            }
        }

        public function hasErrors() {
            return empty($_SESSION['flash_messages'][self::ERROR]) ? false : true;  
        }

        public function hasMessages($type=null) {
            if (!is_null($type)) {
                if (!empty($_SESSION['flash_messages'][$type])) return $_SESSION['flash_messages'][$type]; 
            } else {
                foreach (array_keys($this->msgTypes) as $type) {
                    if (isset($_SESSION['flash_messages'][$type]) && !empty($_SESSION['flash_messages'][$type])) return $_SESSION['flash_messages'][$type]; 
                }
            }
            return false;
        }

        protected function formatMessage($msgDataArray, $type) {
            $msgType = isset($this->msgTypes[$type]) ? $type : $this->defaultType;
            $cssClass = $this->msgCssClass . ' ' . $this->cssClassMap[$type];
            $msgBefore = $this->msgBefore;

            if ($msgDataArray['sticky']) {
                $cssClass .= ' ' . $this->stickyCssClass;

            }

            else {
                $msgBefore = $this->closeBtn . $msgBefore;
            }

            $formattedMessage = $msgBefore . $msgDataArray['message'] . $this->msgAfter; 

            return sprintf(
                $this->msgWrapper, 
                $cssClass, 
                $formattedMessage
            );
        }

        protected function doRedirect() {   
            if ($this->redirectUrl) {
                header('Location: ' . $this->redirectUrl);
                exit();
            }
            return $this;
        }

        protected function clear($types=[]) { 
            if ((is_array($types) && empty($types)) || is_null($types) || !$types) {
                unset($_SESSION['flash_messages']);
            } elseif (!is_array($types)) {
                $types = [$types];
            }

            foreach ($types as $type) {
                unset($_SESSION['flash_messages'][$type]);
            }

            return $this;
        }

        public function setMsgWrapper($msgWrapper='') {
            $this->msgWrapper = $msgWrapper;
            return $this;
        }

        public function setMsgBefore($msgBefore='') {
            $this->msgBefore = $msgBefore;
            return $this;
        }

        public function setMsgAfter($msgAfter='') {
            $this->msgAfter = $msgAfter;
            return $this;
        }

        public function setCloseBtn($closeBtn='') {
            $this->closeBtn = $closeBtn;
            return $this;
        }

        public function setStickyCssClass($stickyCssClass='') {
            $this->stickyCssClass = $stickyCssClass;
            return $this;
        }

        public function setMsgCssClass($msgCssClass='') {
            $this->msgCssClass = $msgCssClass;
            return $this;
        }

        public function setCssClassMap($msgType, $cssClass=null) {

            if (!is_array($msgType) ) {
                if (is_null($cssClass)) return $this;
                $msgType = [$msgType => $cssClass];
            }

            foreach ($msgType as $type => $cssClass) {
                $this->cssClassMap[$type] = $cssClass;
            }

            return $this;
        }
    }
?>