<div id="community-sub">
  <h3>Want to help?</h3>
  <p>Send us a note and we can get you started right away.</p>
  <p class="note">This is for volunteer inquiries.  If you are interested in a job, please visit our <a href="http://www.mozilla.com/about/careers.html">Careers</a> page.</p>

  <form id="get-involved-form" action="/contribute/email/" method="post" accept-charset="utf-8">
    <p><label for="get-involved-email-input">Your email address</label><input type="text" name="address" class="filled" id="get-involved-email-input" value="" placeholder="Your email address" /></p>
    <p><label for="get-involved-interest">Area of interest</label>
      <select id="get-involved-interest" name="area">
        <option selected="selected" disabled="disabled" value="">Area of interest?</option>
        <option value="Support">Helping Users</option>
        <option value="Localization">Localization</option>
        <option value="QA">Testing and QA</option>
        <option value="Coding">Coding</option>
        <option value="Add-ons">Add-ons</option>
        <option value="Marketing">Marketing</option>
        <option value="Students">Student Reps</option>
        <option value="Documentation">Developer Documentation</option>
        <option value="Research">User Research</option>
        <option value="Thunderbird">Thunderbird</option>
        <option value="Accessibility">Accessibility</option>
        <option value="Firefox Suggestions">Firefox Suggestions</option>
        <option value=" ">Other</option>
      </select>
    </p>
    <p class="comments"><label for="get-involved-comments">Comments</label><textarea id="get-involved-comments" name="comments" class="filled" rows="4" cols="12">Hi! I'm interested in...</textarea></p>
<?php /* hide the checkbox until we have newsletter signups working    
    <p><label class="check" for="subscribe-check"><input type="checkbox" name="subscribe" id="subscribe-check" > Send me email with weekly Mozilla news and contribution information.</label></p>
*/ ?>
    <p>
      <input type="hidden" name="robot" value="">
      <input type="hidden" name="cmd" value="sendemail">
      <button type="submit" class="submit">Submit</button>
    </p>
    <p><a href="/about/policies/privacy-policy.html">Mozilla Privacy Policy</a></p>
  </form>
</div>
<script type="text/javascript" src="/script/1.0/mozilla-input-placeholder.js"></script>
