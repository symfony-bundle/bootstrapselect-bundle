Bootstrap Select Bundle for Symfony
===================================

Add the Bootstrap-Select and jQuery frameworks inside the Symfony2 framework.

Installation
------------

This bundle requires JQuery Bundle, and it will be installed automatically.

### Add bundle to your composer.json file

    // ...
    "require": {
        // ...
        "symfony-bundle/bootstrap-select-bundle": "1.6.*";
        // for bootstrap-select 1.6
        // ...
    },
    "scripts": {
        // ...
        "post-install-cmd": [
            // ...
            // insert the both lines before Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets
            "Anezi\\Bundle\\JQueryBundle\\Composer\\ScriptHandler::copyJQueryToBundle",
            "Anezi\\Bundle\\BootstrapSelectBundle\\Composer\\ScriptHandler::copyFilesToBundle",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
            // ...
        ],
        "post-update-cmd": [
            // ...
            // insert the both lines before Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets
            "Anezi\\Bundle\\JQueryBundle\\Composer\\ScriptHandler::copyJQueryToBundle",
            "Anezi\\Bundle\\BootstrapSelectBundle\\Composer\\ScriptHandler::copyFilesToBundle",
            "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
            // ...
        ]
    },

### Add bundle to your application kernel

    // app/AppKernel.php
    
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Anezi\Bundle\JQueryBundle\JQueryBundle(),
            new Anezi\Bundle\BootstrapSelectBundle\BootstrapSelectBundle(),
            // ...
        );
    }

### Download the bundle using Composer

    $ composer update symfony-bundle/bootstrap-select-bundle
    
### Install assets

Update assets using composer post command:

    $ composer run-script post-update-cmd

Usage
-----

Refer to the jquery and bootstrap files in your HTML template, e.g.:

    <script type="text/javascript" src="{{ asset('bundles/jquery/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bundles/bootstrapselect/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bundles/bootstrapselect/css/bootstrap-select.min.css') }}"></script>

License
-------

This bundle is available under the MIT license.
