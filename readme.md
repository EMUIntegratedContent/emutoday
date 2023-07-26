# EMU Today

[//]: # ([![Build Status]&#40;https://travis-ci.com/chyke007/credible.svg?branch=master&#41;]&#40;https://travis-ci.com/chyke007/credible&#41;)
![version](https://img.shields.io/badge/version-1.3.0-blue)
![Laravel Version](https://img.shields.io/badge/Laravel-v10.2.x-yellow)
![Vue.js Version](https://img.shields.io/badge/Vue.js-v3.2.45-green)

[//]: # (![Docker Version]&#40;https://img.shields.io/badge/Docker-v20.10.8-purple&#41;)
<hr>
<p>EMU Today is Eastern Michigan University's digital hub for stories and news around campus. Discover upcoming events and important announcements to stay current on what's happening at EMU.</p>
<hr>

<h2>July 2023 Updates (v 1.3.0)</h2>
<ul>
<li>Updated all Vue components to version 3.</li>
<li>Upgraded Laravel framework to version 10.</li>
<li>Upgraded CKEditor to version 5.</li>
<li>Use of flatpickr for all datepickers.</li>
<li>Re-worked the toggle button in all admin queues.</li>
</ul>

<h2>Local Installation</h2>
<h3>Step 1</h3> 
<p>Install <a href="https://www.docker.com/products/docker-desktop/" target="_blank">Docker Desktop</a>. Be sure to choose the appropriate operating system. Start Docker desktop once it’s installed. Also, make sure you have git installed on your machine.</p>

<h3>Step 2</h3>
<p>Using a terminal, clone the emutoday github repository into an empty directory on your local machine.</p>
<pre>git clone https://github.com/EMUIntegratedContent/emutoday</pre>
<p>Then go into that new directory</p>
<pre>cd /path/to/emutoday</pre>

<h3>Step 3</h3> 
Obtain the **.env** file (stored outside this repo) and place it in the root of the emutoday directory. This file
contains application keys and passwords.

<h3>Step 4</h3>
**FIRST TIME ONLY** 
- Download the `oauth.php` file (stored outside this repo) to your local machine at the directory `/path/to/emutoday/app/Http/Requests`.
- Most of the `public/imgs` subdirectories are not included in the GitHub repo. Download the imgs directory (stored outside this repo) to your local machine and place the missing subdirectories into `/path/to/emutoday/public`.

<h3>Step 5</h3>
<p>Bring the Docker containers up, building the Docker images as well.</p>

`docker compose up --build`

On subsequent starts, you should run this command without the 
<br>`--build` flag. 
You can also start and stop containers from the Docker Desktop GUI.

Note that the first time, composer dependencies will install in the
background, so startup will take a few minutes. It should be quicker subsequently. 

<h3>Step 6</h3>
**FIRST TIME ONLY**
Download the `emutoday.sql` file (stored outside this repo) to your local machine. In this case, we assume you downloaded it to `/path/to/emutoday.sql`. 

Docker created our database container with the name <br>`emutoday-db-1` and, using our database user and password, we can dump the contents of this file into the database called emutoday.

`docker exec -i emutoday-db-1 mysql --user=root --password=secret
emutoday < /path/to/emutoday.sql`


<h3>Step 7</h3> 
You should now be able to access the local copy of the EMU Today website by typing `localhost:8080` into your web browser.


All done!

<hr>

<h2>Notes when pulling on remote servers</h2>
Since the servers are locked down with elevated user privileges, you'll need to make sure some directories allow write access before running
`composer update`:

    sudo -u [elevatedUserName] git pull
    chmod 775 -R vendor/
    chmod 775 composer.lock
    chmod 775 -R bootstrap/

At this point you should be able to run 
    `composer update`


If composer.lock or the vendor/ directory are still giving a problem, remove, them and re-create with 775 and the elevated user as the owner (you'll need to confer with IT about setting up privileges if you don't have them already).
