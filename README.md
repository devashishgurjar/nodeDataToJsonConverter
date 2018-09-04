# SiteInformation Form Alter Module

*This repository has the drupal-8 custom module to alter the existing Drupal-8 "Site Information" form and represent page type node in JSON format

Features:

*As an administrative user of a Drupal 8 site you can set up a site wide API key.

*As Anonymous/Authenticated user you can access page content in JSON format on your site if you have the following :

*Site API Key Node ID of the content of type page. How to use Site Information Form Alter Module? Enable the module,

*Login in as a administrator,
-Goto /admin/config/system/site-information
-Enter the Site API key for Eg : FOOBAR12345 and Save the Form.

*Go to the link of the format http://dev-drupal8tutorialsite.pantheonsite.io/page_json/<SITE API KEY>/<NODE_ID>

*key which you entered and saved in site-information form, <NODE_ID> - The Unique node id of the content you want to Access. Note : The content should be of type Page.
Eg : http://dev-drupal8tutorialsite.pantheonsite.io/page_json/FOOBAR12345/17

*Incorrect API key, Non-numeric NODE_ID, NODE_ID of a Node which does not exist or not of type page will return {"error":"access denied"}

References:

https://www.drupal.org/docs/8/api/configuration-api/configuration-override-system
https://www.drupal.org/docs/8/api/configuration-api/simple-configuration-api
https://www.google.co.in/search?q=json+representation+of+node+drupal+8&rlz=1C1DFOC_enIN653IN653&oq=json+representation+of+node+drupal+8&aqs=chrome..69i57j69i61.19238j0j7&sourceid=chrome&ie=UTF-8
https://drupal.stackexchange.com/questions/191419/drupal-8-node-serialization-to-json
Drupal 8 Form API Drupal 8 JsonResponse
https://github.com/taherj/siteapi
core/modules/automated_cron



Total time to complete task:
- 6 Hours
