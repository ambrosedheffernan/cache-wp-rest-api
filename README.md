# cache-wp-rest-api
A mu-plugin file to specifically cache wp rest api endpoints output. 


info: This method is far from complete, use at your own discretion and evaluate carefully before use. 

Install:
1. Check your wp-content folder, if there is not a folder in there called "mu-plugins" create one. 
2. Use the php file api-cache.php
3. Thats it, on the first page load, the method will cache the output and save to a json file, it will load this file and exit on the next visit.

Requirements
1. Php - curl extension
2. Wp rest api - https://wordpress.org/plugins/rest-api/

Brief Method Overview:
1. Check if the url matches v2 api structure
2. Check if the endpoint is in the variable allowed endpoints 
3. Check / Create the cache folder
4. Check if the cache file exists, if yes load and exit.
5. If cache file does not exist, curl the page and save content to file

To do:
1. Method to clear cached files - cronjob
2. Method to clear cached files - savepost

Issues / Further Development
1. The method uses curl. This is not ideal as we are in fact loading page content twice, but I could not find any hooks/ filters to grab the output with todate. To watch this in future. 
2. If there is any output other than json, this will also be cached, we need to create a method to identify when this happens
