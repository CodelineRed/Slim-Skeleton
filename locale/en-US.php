<?php
# See http://php.net/manual/de/function.sprintf.php if you want to use placeholders in strings
return [
    'included' => 'Included',
    'example' => 'This is a %1$s example page with number %2$s.',
    'db-records' => 'Database records',
    'user' => 'User',
    'password' => 'Password',
    'password-repeat' => 'Password again',
    'user-name' => 'User name',
    'login' => 'Login',
    'id' => 'ID',
    'name' => 'Name',
    'role' => 'Role',
    'created-at' => 'Created at',
    'updated-at' => 'Updated at',
    'success' => 'Success',
    'construction' => 'This service is temporarily not available',
    'failed-csrf' => 'Failed CSRF check',
    'not-allowed-method' => 'Method must be one of',
    'page-not-found' => 'Page not found',
    'unauthorized' => 'Unauthorized',
    'auth-code' => 'Authentication Code',
    'code' => 'Code',
    'submit' => 'Submit',
    'guest' => 'Guest',
    'member' => 'Member',
    'admin' => 'Admin',
    'superadmin' => 'Superadmin',
    'enable-2fa' => 'Enable two factor auth',
    'enable-2fa-step1' => '1. Install "Google Authenticator" (<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">Android</a> or <a href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank">iOS</a>) on your mobile device.',
    'enable-2fa-step2' => '2. Enter "Secret" into the app or scan the QR code.<br/>Handle "Secret" like a password and save it.',
    'enable-2fa-step3' => '3. Enter code from the app into input field.',
    '2fa-secret' => 'Secret',
    'recovery-codes' => 'Recovery Codes',
    'recovery-codes-text' => 'Treat this codes like passwords and save them.<br/>You will see them only this time.',
    'back-to' => 'Back to',
    '2fa-enabled' => 'Two factor auth is enabled',

    // navigation labels
    'page-index-label' => 'Home',
    'page-example-label' => 'Example page',
    'user-show-label' => 'Profile',
    'user-register-label' => 'Register',
    'user-login-label' => 'Login',
    'user-logout-label' => 'Logout',
    'user-two-factor-label' => 'Enable two factor authentication',
    'langswitch-label' => 'EN',
    'langswitch-image' => '<img src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/us.svg" style="max-height: 20px;">',

    // flash messages
    'register-flash-m1' => 'User name is taken',
    'register-flash-m2' => 'User name too short (at least %1$s characters)',
    'register-flash-m3' => 'Password too short (at least %1$s characters)',
    'register-flash-m4' => 'Password was repeated incorrectly',
    'register-flash-m5' => 'Registration complete',
    'register-flash-m6' => 'Captcha failed',
    'register-flash-m7' => 'User name too long (max %1$s characters)',
    'register-flash-m8' => 'User name can only contains: a-z, A-Z, 0-9, _, -',
    'register-flash-m9' => 'User name not allowed',
    'register-flash-m10' => 'Password must include at least one number',
    'register-flash-m11' => 'Password must include at least one lowercase letter',
    'register-flash-m12' => 'Password must include at least one uppercase letter',
    'register-flash-m13' => 'Password must include at least one symbol',

    // misc
    // decimal point
    'dp' => '.',
    // thousands separator
    'ts' => ',',
    'date' => 'Y-m-d',
    'time' => 'g:ia',
    'datetime' => 'Y-m-d g:ia',
    'timezone' => 'America/New_York',
];
