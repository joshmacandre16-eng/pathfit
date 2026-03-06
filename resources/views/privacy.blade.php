<?php
// This file is kept for backward compatibility.
// Please use route('privacy', 'privacy-policy') for the main privacy policy page.
// The privacy policy is now available at /privacy/{slug} with the following sections:
// - privacy-policy (overview)
// - information-we-collect
// - how-we-use
// - data-protection
// - cookies
// - third-party
// - your-rights
// - childrens-privacy
// - changes
// - contact

return redirect()->route('privacy', 'privacy-policy');
?>

