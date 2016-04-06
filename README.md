# cache-wp-rest-api<br>
A mu-plugin file to specifically cache wp rest api endpoints output.<br> 


info: This method is far from complete, use at your own discretion and evaluate carefully before use. <br>

<h3>Install:</h3>>
1. Check your wp-content folder, if there is not a folder in there called "mu-plugins" create one. <br>
2. Use the php file api-cache.php<br>
3. Thats it, on the first page load, the method will cache the output and save to a json file, it will load this file and exit on the next visit.<br>

<h3>Requirements</h3>
1. Php - curl extension<br>
2. Wp rest api - https://wordpress.org/plugins/rest-api/<br>

<h3>Brief Method Overview:</h3>
1. Check if the url matches v2 api structure<br>
2. Check if the endpoint is in the variable allowed endpoints<br> 
3. Check / Create the cache folder<br>
4. Check if the cache file exists, if yes load and exit.<br>
5. If cache file does not exist, curl the page and save content to file<br>

<h3>To do:</h3>
1. Method to clear cached files - cronjob<br>
2. Method to clear cached files - savepost<br>

<h3>Issues / Further Development</h3>
1. The method uses curl. This is not ideal as we are in fact loading page content twice, but I could not find any hooks/ filters to grab the output with todate. To watch this in future. <br>
2. If there is any output other than json, this will also be cached, we need to create a method to identify when this happens
