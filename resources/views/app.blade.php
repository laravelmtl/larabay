<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaraBay, by Laravel MTL</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png" />


    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.indigo-pink.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
<section class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
            <h3>LaraBay &amp; Co</h3>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
            <a href="#overview" class="mdl-layout__tab is-active">Overview</a>
            <a href="#overview" class="mdl-layout__tab">Features</a>
            <a href="#overview" class="mdl-layout__tab">Details</a>
            <a href="#overview" class="mdl-layout__tab">Technology</a>
            <a href="#overview" class="mdl-layout__tab">FAQ</a>
        </div>
    </header>
    <main class="mdl-layout__content">
        <section class="mdl-layout__tab-panel is-active" id="overview">
            @if (count($errors) > 0)
                <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp mdl-color--red-100">
                    <div class="mdl-cell mdl-cell--12-col">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="white-text">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif

            @yield('content')
            <br><br>
        </section>
        <footer class="mdl-mega-footer">
            <div class="mdl-mega-footer--bottom-section">
                <div class="mdl-logo">
                    LaraBay & Co
                </div>
                <ul class="mdl-mega-footer--link-list">
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Privacy and Terms</a></li>
                </ul>
            </div>
        </footer>
    </main>
</div>

<script src="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="../../js/modal.js"></script>
@yield('javascript')
</body>
</html>
