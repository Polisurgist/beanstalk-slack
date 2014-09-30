# BeanstalkAPP -> SlackHQ Integration
##### Post your deploy commits to directly to a chosen/dynamic slack channel

### What is it?

post-hook.php is a single PHP file that (when configured) will update SlackHQ with your beanstalkApp deployments.

### Instructions

Upload the post-hook.php file to your web server, fill in the config blanks with your access tokens / urls from beanstalk & Slack. 
Don't forget to update the post-hook field with the url to the post-hook.php file on your server. See [Beanstalk Support](http://support.beanstalkapp.com/customer/portal/articles/75806-how-do-i-trigger-hooks-before-and-after-a-deployment-
) for directions. 
