# Node Data to Json format converter based on API key.

Code: https://github.com/devashishgurjar/nodeDataToJsonConverter

- What Is This?
---------------
This module is intended to convert Node data of page content type to
Json format in Drupal 8. This module has altered site settings form to inject
extra field named "Site API Key" to save random string as API key in it.

- How To Use This Module
------------------------
Please follow below steps to use this module:

1. As a common process, enable the module and use it within Drupal.

2. Save configuration of "Site API Key" at path i.e "/admin/config/system/site-
   information" and enter any string u want to use as a key.

3. Browse to path "http://<site_base_url>/page_json/<SITE_API_KEY>/<NODE_ID>"
   to see json format of node. If you visit with wrong key or nid (not of page
   content type) you will see "access denied".

- Features & use of it:
-----------------------
1. As an administrative user of a Drupal 8 site you can set up a site wide API key.

2. As Anonymous/Authenticated user you can access page content in JSON format
   on your site, if you have the "Site API Key" and "Node ID" of the content of
   type "page".

3. In Case of Incorrect API key, Non-numeric NODE_ID, NODE_ID of a Node which
   does not exist or not of type "page" will return {"error":"access denied"}.

- References:
-------------
1. https://www.drupal.org/docs/8/api/configuration-api/configuration-override-system
2. https://www.drupal.org/docs/8/api/configuration-api/simple-configuration-api
3. https://www.google.co.in/search?q=json+representation+of+node+drupal+8&rlz=1C1DFOC_enIN653IN653&oq=json+representation+of+node+drupal+8&aqs=chrome..69i57j69i61.19238j0j7&sourceid=chrome&ie=UTF-8
4. https://drupal.stackexchange.com/questions/191419/drupal-8-node-serialization-to-json
5. Drupal 8 Form API Drupal 8 JsonResponse
6. https://www.drupal.org/project/examples

- Total time to complete task:
------------------------------
3 Hours

Thanks
