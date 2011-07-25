<?php
/**
 * Based on http://svn.mozilla.org/projects/mozilla.com/trunk/includes/email/forms.php
 */
require_once dirname(__FILE__) ."/responsys.php";
require_once dirname(__FILE__) ."/validation.php";

class PhonebookValidationException extends Exception {
    function __construct($code = '') {
        $this->code = $code;
    }
}

class PhonebookForm {
    var $campaign;
    var $data;
    var $error;

    function __construct($campaign, $data) {
        $this->campaign = $campaign;
        $this->data = $data;
    }

    function submitted() {
        return array_key_exists('submit', $this->data);
    }

    function validate() {
        $data = $this->data;

        if (!isset($data['email']) || !preg_match('/^([\w\-.+])+@([\w\-.])+\.[A-Za-z]{2,4}$/', $data['email'])) {
            throw new PhonebookValidationException('email');
        }
        
        if (!array_key_exists('privacy', $data)) {
            throw new PhonebookValidationException('privacy');
        }
        
        if (isset($data['country']) && !preg_match('/^[\w]{2}$/', $data['country'])) {
            throw new PhonebookValidationException('country');
        }
        
        return true;
    }

    function subscribe() {
        Responsys::subscribe($this->campaign, $this->data);
    }

    function save() {
        if ($this->submitted()) {
            try {
                $this->validate();
                $this->subscribe();
                return true;
            } catch (PhonebookValidationException $e) {
                $this->error = $e->getCode();
            }
        }
        return false;
    }

    function get($key, $default = '', $clean = true) {
        if (array_key_exists($key, $this->data)) {
            $val = $this->data[$key];
            return $clean ? htmlentities($val) : $val;
        }
        return $default;
    }
}