<?php

/**
 * Form used to send emails to various departments of Mozilla for new,
 * interested contributors
 *
 * @package   Mozilla.org
 * @copyright 2011 silverorange Inc., Mozilla Inc.
 * @author    Michael Gauthier <mike@silverorange.com>
 * @license   http://www.mozilla.org/MPL/MPL-1.1.html Mozilla Public License
 */
class ContributeForm
{
    // {{{ protected properties

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $error;

    // }}}
    // {{{ public function __construct()

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // }}}
    // {{{ public function process()

    public function process()
    {
        if ($this->isSubmitted()) {
            if ($this->save()) {
                $this->redirect();
            }
        }
    }

    // }}}
    // {{{ public function getRaw()

    public function getRaw($key, $default = '')
    {
        return $this->get($key, $default, false);
    }

    // }}}
    // {{{ public function getClean()

    public function getClean($key, $default = '')
    {
        return $this->get($key, $default, true);
    }

    // }}}
    // {{{ public function getError()

    public function getError()
    {
        return $this->error;
    }

    // }}}
    // {{{ protected function save()

    protected function save()
    {
        $saved = false;

        try {
            $this->validate();
            $this->send();
            $this->sendAutoResponse();
            $saved = true;
        } catch (ContributeValidationException $e) {
            $this->error = $e->getMessage();
        }

        return $saved;
    }

    // }}}
    // {{{ protected function redirect()

    protected function redirect()
    {
        if (isset($_SERVER['SCRIPT_URL']) && isset($_SERVER['SCRIPT_URI'])) {
            $part   = $_SERVER['SCRIPT_URL'];
            $full   = $_SERVER['SCRIPT_URI'];
            $pos    = strpos($full, $part);
            $base   = substr($full, 0, $pos + 1);
            $thanks = $base . 'contribute/thanks.html';
        } else {
            $thanks = 'http://www.mozilla.org/contribute/thanks.html';
        }

        $thanks .= '?area=' . rawurlencode($this->getRaw('area'));

        header('Location: ' . $thanks);
    }

    // }}}
    // {{{ protected function isSubmitted()

    protected function isSubmitted()
    {
        return array_key_exists('submit', $this->data);
    }

    // }}}
    // {{{ protected function validate()

    protected function validate()
    {
        $data = $this->data;

        // check that the provided email address at least looks valid. this
        // is not strict checking (i.e. no dns check on domain portion) but
        // it should catch most false addresses.
        if (   !isset($data['address'])
            || !preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $data['address'])
        ) {
            throw new ContributeValidationException('email');
        }

        // 'robot' is a hidden text input, if it has been filled in then
        // it is surely the handiwork of a spambot so ignore the submission.
        if (isset($this->data['robot']) && $this->data['robot']) {
            throw new ContributeValidationException('robot');
        }

        if (!isset($this->data['area']) || $this->data['area'] == '') {
            throw new ContributeValidationException('area');
        }

        if (!isset($this->data['comments']) || $this->data['comments'] == '') {
            throw new ContributeValidationException('comments');
        }

        // very basic cross-domain prevention
        if (!stristr($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST'])) {
            throw new ContributeValidationException('referer');
        }
    }

    // }}}
    // {{{ protected function send()

    protected function send()
    {
        $data = $this->data;

        $map = array(
            'QA'             => 'qanoreply'        . '@' . 'mozilla.com',
            'Thunderbird'    => 'tb-kb'            . '@' . 'mozilla.com',
            'Students'       => 'studentreps'      . '@' . 'mozilla.com',
            'Research'       => 'diane+contribute' . '@' . 'mozilla.com',
            'Design'         => 'creative'         . '@' . 'mozilla.com',
            'Security'       => 'security'         . '@' . 'mozilla.com',
            'Docs'           => 'eshepherd'        . '@' . 'mozilla.com',
            'Drumbeat'       => 'drumbeat'         . '@' . 'mozilla.com',
            'Browser Choice' => 'isandu'           . '@' . 'mozilla.com',
	    'IT'     	     => 'cshields'         . '@' . 'mozilla.com',
	    'Marketing'      => 'cnovak'           . '@' . 'mozilla.com',
        );

        $headers  = "From: <contribute-form" . "@" . "mozilla.org>";
        $headers .= "\r\nReply-To: <{$data['address']}>";

        if (array_key_exists($data['area'], $map)) {
            $headers .= "\r\nCc: <{$map[$data['area']]}>";
        }

        $to      = 'contribute' . '@' . 'mozilla.org';
        $subject = "Inquiry about Mozilla {$data['area']}";
        $message = "E-mail: {$data['address']}\r\n"
            . "Area of Interest: {$data['area']}\r\n"
            . "Comment: {$data['comments']}\r\n";

        return mail($to, $subject, $message, $headers);
    }

    // }}}
    // {{{ protected function sendAutoResponse()

    protected function sendAutoResponse()
    {
        $data = $this->data;

        $message = $this->getAutoResponseMessage($data['area']);

        $message = str_replace("\r\n", "\n", $message);
        $message = str_replace("\r", "\n", $message);
        $message = str_replace("\n", "\r\n", $message);

        if ($message == '') {
            return false;
        }

        $headers  = "From: <contribute-form" . "@" . "mozilla.org>";

        $reply_to = $this->getAutoResponseReplyTo($data['area']);
        if ($reply_to != '') {
            $headers .= "\r\nReply-To: <{$reply_to}>";
        }

        $to      = $data['address'];
        $subject = "Inquiry about Mozilla {$data['area']}";

        return mail($to, $subject, $message, $headers);
    }

    // }}}
    // {{{ protected function get()

    protected function get($key, $default = '', $clean = true)
    {
        $value = $default;

        if (array_key_exists($key, $this->data)) {
            $value = $this->data[$key];
            if (get_magic_quotes_gpc()) {
                $value = stripslashes($value);
            }
            if ($clean) {
                $value = htmlspecialchars($value);
            }
        }

        return $value;
    }

    // }}}
    // {{{ protected function getAutoResponseReplyTo()

    protected function getAutoResponseReplyTo($area, $subarea = '')
    {
        switch ($area) {
        case 'Support':
            return 'jay' . '@' . 'jaygarcia.com';

        case 'Localization':
            return 'fiotakis' . '@' . 'otenet.gr';

        case 'QA':
            return 'qa-contribute' . '@' . 'mozilla.com';

        case 'Add-ons':
            return 'jorge' . '@' . 'mozilla.com';

        case 'Marketing':
            return 'cnovak' . '@' . 'mozilla.com';

        case 'Students':
            return 'jhaas' . '@' . 'mozilla.com';

        case 'Documentation':
            return 'jay' . '@' . 'jaygarcia.com';

        case 'Research':
            return 'jay' . '@' . 'jaygarcia.com';

        case 'Thunderbird':
            return 'jzickerman' . '@' . 'mozilla.com';

        case 'Accessibility':
            return 'jay' . '@' . 'jaygarcia.com';

        case 'Firefox Suggestions':
            return 'jay' . '@' . 'jaygarcia.com';

        case ' ':
            return 'dboswell' . '@' . 'mozilla.com';
        }
    }

    // }}}
    // {{{ protected function getAutoResponseMessage()

    protected function getAutoResponseMessage($area, $subarea = '')
    {
        switch ($area) {
        case 'Support':
            // {{{ Support
            return <<<TEXT
Thanks for your interest in helping people with support questions and welcome to the Mozilla community.

A great way to get started with helping users is to use our Army of Awesome page to quickly respond to questions people have about Firefox. You can find it at:

http://support.mozilla.com/army-of-awesome

If you're interested in finding about other ways to get involved with our support community, the following page has some useful information:

https://support.mozilla.com/kb/superheroes-wanted

If you have any questions about this, feel free to write me back.

Jay
TEXT;
            // }}}
        case 'QA':
            // {{{ QA
            return <<<TEXT
Thanks for your interest in helping with testing.

To get started, download a development build of Firefox and then
join us for the next Test Day.

You can download development builds at

https://www.mozilla.com/firefox/channel/

We hold Test Days every Friday online from 9am to 5pm PDT.  You
can join by clicking on this link.

http://chat.mibbit.com/?server=irc.mozilla.org&channel=#testday

We look forward to talking with you more soon.

Juan Becerra
Mozilla QA
http://quality.mozilla.org/
TEXT;
            // }}}
        case 'Add-ons':
            // {{{ Add-ons
            return <<<TEXT
Hello,

Thank you for your interest in Mozilla.

For more information about add-on development, I recommend taking a look at the Add-on Developer Hub. This site has documentation, tools and ways to get in touch with other developers.

https://addons.mozilla.org/developers/

You can get started with one of the tutorials, such as XUL School:

https://developer.mozilla.org/en/XUL_School

There's a also the Add-ons Forum, where you can post questions and talk with other add-ons developers.

https://forums.mozilla.org/addons/

If you are interested in testing add-ons, you can join the quality team:

http://quality.mozilla.org/

They hold regular add-on test days, and they should become much more important now that Firefox is being released more frequently and add-on compatibility is more important. You can also install the Add-on Compatibility Reporter add-on and test add-ons that haven't been upgraded for compatibility:

https://addons.mozilla.org/en-US/developers/addon/add-on-compatibility-reporter/

If you have any questions about any of this, feel free to write back.

Regards,

Jorge Villalobos
Add-ons Developer Relations Lead
TEXT;
            // }}}
        case 'Marketing':
            // {{{ Marketing
            return <<<TEXT
Thanks for your interest in getting involved with Mozilla.

Help us spread the word about Firefox by grabbing a Firefox button and put it on your site, blog, Facebook or wherever.

http://affiliates.mozilla.org

If you'd like to learn more about other ways to help us with marketing, please feel free to write me back.

Thanks,
Chelsea
TEXT;
            // }}}
        case 'Students':
            // {{{ Students
            return <<<TEXT
Hi there,

Thank you for your inquiry about getting involved with the Mozilla Student Reps program.

To get started, please visit the Mozilla Student Reps website and sign-up for the newsletter to receive updates: 

http://www.mozilla.com/newsletter/studentreps

We are currently restructuring the Student Reps program and will be re-launching with new projects and opportunities in the coming months. During this time, we will be updating resources and notifying you via email of different ways to spread Firefox and stay involved with Mozilla.

Want to spread Firefox now and compete for fun prizes? Check out the Firefox Affiliates program: https://affiliates.mozilla.org

If you are interested in getting involved in a particular functional area in the Mozilla Project, please visit: http://www.mozilla.org/contribute/areas.html. You can also learn more about volunteer projects near your area here: http://www.mozilla.org/contribute/local

Join the Community Marketing email listserv to tell us about a project you're interested in leading, or hear about ways other contributors are forwarding Mozilla's mission around the world: https://lists.mozilla.org/listinfo/marketing

Please let me know if you need anything else.

Cheers,

Jason Haas
Community Manager (Students)
http://studentreps.mozilla.com
TEXT;
            // }}}
        case 'Documentation':
            // {{{ Documentation
            return <<<TEXT
Hello! Thanks for your interest in helping with Mozilla's documentation. There are several ways you can help:

Write Firefox Knowledge Base articles
http://support.mozilla.com/en-US/kb/improve-knowledge-base

Write Thunderbird Knowledge Base articles
http://support.mozillamessaging.com/en-US/kb/improve-knowledge-base

Help with Mozilla Developer Network docs
http://developer.mozilla.org/Project:en/How_to_Help 

Thanks again for your interest, and welcome to the Mozilla Contributor Community.

Jay
TEXT;
            // }}}
        case 'Firefox Suggestions':
            // {{{ Firefox Suggestions
            return <<<TEXT
Thanks for your interest in providing feedback about Firefox.

I'd recommend trying out a preview release of the next version of Firefox to see the latest features we've been working on. You can download that at

http://www.mozilla.com/firefox/channel/

After trying that out, you can share your thoughts at

http://input.mozilla.com/release/feedback

Jay
TEXT;
            // }}}
        case ' ':
            // {{{ Other
            return <<<TEXT
Thank you for your interest in getting involved with Mozilla.

A great way to get started is to spread the word about Firefox. Grab a button and put it on your site, blog, Facebook or wherever.

https://affiliates.mozilla.org/

If you'd like to learn more about other ways to help out, take a look at

http://www.mozilla.org/contribute/areas.html

If there's a type of activity you're interested in, please feel free to write me back and I'll be happy to help you get started on a project.

David
TEXT;
            // }}}
        }
    }

    // }}}
}

class ContributeValidationException extends Exception
{
}

?>
