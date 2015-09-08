#Personal-Data-Locker Source code

An open source learning record store. Personal-Data-Locker shows data in meaningful form using charts and tables. It is build using [laravel](http://laravel.com/) a PHP framework. Personal-Data-Locker is an API which allows user to generate statements. Statements can be generated from its chrome extension available on [chrome extension store](https://chrome.google.com/webstore/detail/pdl/ajnahfidcbfdnpflgagajffjkgffhgon?hl=en-US). Extension source code will be available soon.

###Personal-Data-Locker Chrome Extension

You can download Personal-Data-Locker extension [here](https://chrome.google.com/webstore/detail/pdl/ajnahfidcbfdnpflgagajffjkgffhgon?hl=en-US). After installing our extension, it will ask for "SID" and "AUTh", Copy "SID" and "AUTH" from your Personal-Data-Locker dashboard and click "Authenticate". After successful authentication it will start generating statements on page refresh and when new tab is opened.

Extension generates statements with 4 different "activity name", there details are below

1. Listening - when user listen any audio stream like soundcloud etc
2. Reading   - when opened page do not have any audio or video content and user viewed that page for 30 seconds
3. Surfing   - when opened page do not have any audio or video content and user viewed that page for very short time
4. Watching  - when user opened youtube, vimeo and dailymotion, and viewed that page for more than 20 seconds
