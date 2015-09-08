#Personal-Data-Locker Source code

An open source learning record store; Personal-Data-Locker shows data in meaningful form using charts and tables. It is build using [laravel](http://laravel.com/) a PHP framework. Personal-Data-Locker is an API which allows user to generate statements. Statements can be generated from its chrome extension available on [chrome extension store](https://chrome.google.com/webstore/detail/pdl/ajnahfidcbfdnpflgagajffjkgffhgon?hl=en-US). Extension source code will be available soon.

###Personal-Data-Locker Installation

To install Personal-Data-Locker, clone Personal-Data-Locker from [github](https://github.com/Personal-Data-Locker/code). Remember to clone it in "www" folder or "htdocs" folder. If you downloaded zip from github then extract it directly in "www" or "htdocs" fodler. After that create a new database and import file named "import.sql" in that database. After database creation and file import open that file "app/config/database.php", at line 57 change hostname to your hostname (mostly its localhost), at line 58 enter database name and at line 59 and 60 enter mysql username and password.

###Personal-Data-Locker Chrome Extension

You can download Personal-Data-Locker extension [here](https://chrome.google.com/webstore/detail/pdl/ajnahfidcbfdnpflgagajffjkgffhgon?hl=en-US). After installing our extension, it will ask for "SID" and "AUTH", Copy "SID" and "AUTH" from your Personal-Data-Locker dashboard and click "Authenticate". After successful authentication it will start generating statements on page refresh and when new tab is opened.

Extension generates statements with 4 different "activity name", there details are below

1. Listening - when users listen to any audio stream like soundcloud etc
2. Reading   - when open page do not have any audio or video content and user view that page for 30 seconds
3. Surfing   - when open page do not have any audio or video content and user view that page for very short time
4. Watching  - when user open youtube, vimeo and dailymotion, and view that page for more than 20 seconds
