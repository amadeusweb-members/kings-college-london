<?php
contentBox('logout', 'container');
h2('Logout successful');
echo returnLine('<div class="alert alert-success" role="alert">
<h3 class="alert-heading mb-3">DEMO MODE NOTICE.</h3>
<p class="mb-0">To simulate another user role, please <a href="%url%login/">click login</a>.</p>
</div>');
contentBox('end');
//echo '<script>location.reload();</script>';
