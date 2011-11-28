<div id="community-sub">

    <h3>Want to help?</h3>

    <p>Send us a note and we can get you started right away.</p>
    <p class="note">This is for volunteer inquiries.  If you are interested in a job, please visit our <a href="http://www.mozilla.com/about/careers.html">Careers page</a>.</p>

    <?php

    if ($error) {
        echo '<ul class="field-errors">';

        switch ($error) {
        case 'email':
            echo '<li>Whoops! Be sure to enter a valid email address.</li>';
            break;
        case 'area':
            echo '<li>Please select an area of interest.</li>';
            break;
        case 'comments':
            echo '<li>Please tell us more about your interests.</li>';
            break;
        case 'robot':
        case 'referer':
            echo '<li>Whoops! We had trouble with that one. Please try again.</li>';
            break;
        }

        echo '</ul>';
    }

    ?>

    <form id="get-involved-form" action="#community-sub" method="post" accept-charset="utf-8">

        <div class="field required email-field<?= ($error === 'email') ? ' field-error' : ''; ?>">
            <label for="get-involved-email-input">Your email address</label>
            <span class="error-wrapper">
                <input type="email" id="get-involved-email-input" name="address" value="<?= $form->getClean('address'); ?>" placeholder="Your email address" />
            </span>
        </div>

        <div class="field required area-field<?= ($error === 'area') ? ' field-error' : ''; ?>">
            <label for="get-involved-interest">Area of interest</label>
            <span class="error-wrapper">
                <select id="get-involved-interest" name="area">
                    <?php
                    $areas = array(
                        ''                    => 'Area of interest?',
                        'Support'             => 'Helping Users',
                        'Localization'        => 'Localization',
                        'QA'                  => 'Testing and QA',
                        'Coding'              => 'Coding',
                        'Add-ons'             => 'Add-ons',
                        'Marketing'           => 'Marketing',
                        'Students'            => 'Student Reps',
                        'Webdev'              => 'Web Development',
                        'Documentation'       => 'Developer Documentation',
                        'IT'                  => 'Systems Administration',
                        'Research'            => 'User Research',
                        'Thunderbird'         => 'Thunderbird',
                        'Accessibility'       => 'Accessibility',
                        'Firefox Suggestions' => 'Firefox Suggestions',
                        ' '                   => 'Other',
                    );
                    $area = $form->getClean('area');
                    foreach ($areas as $value => $title) {
                        echo '<option';
                        echo ' value="' . $value . '"';
                        if ($area == $value) {
                            echo ' selected="selected"';
                        }
                        if ($value == '') {
                            echo ' disabled="disabled"';
                        }
                        echo '>' . $title . '</option>';
                    }

                    ?>
                </select>
            </span>
        </div>

        <div class="field required comments-field<?= ($error === 'comments') ? ' field-error' : ''; ?>">
            <label for="get-involved-comments">Comments</label>
            <span class="error-wrapper">
                <textarea id="get-involved-comments" name="comments" rows="4" cols="12" placeholder="Hi! I’m interested in …"><?= $form->getClean('comments'); ?></textarea>
            </span>
        </div>

        <?php /* hide the checkbox until we have newsletter signups working
        <p>
            <label class="check" for="subscribe-check"><input type="checkbox" name="subscribe" id="subscribe-check" > Send me email with weekly Mozilla news and contribution information.</label>
        </p>
        */ ?>

        <div class="field footer-field">
            <input type="hidden" name="robot" value="" />
            <input type="hidden" name="submit" value="1" />
            <button type="submit" class="submit">Submit</button>
        </div>

        <p class="disclaimer">
            <a href="/about/policies/privacy-policy.html">Mozilla Privacy Policy</a>
        </p>
    </form>
</div>
<script type="text/javascript" src="/script/1.0/mozilla-input-placeholder.js"></script>
