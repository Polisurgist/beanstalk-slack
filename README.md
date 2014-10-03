# Beanstalk -> Slack Integration
##### Post your Beanstalk deploy commits to directly to a chosen/dynamic Slack channel

### What is it?

beanstalk-slack.php is a single PHP file that will update SlackHQ with your BeanstalkApp deployments.

### Instructions

Upload the beanstalk-slack.php file to your web server, fill in the config blanks with your access tokens / urls from beanstalk & Slack. 
Don't forget to update the post-hook field with the url to the beanstalk-slack.php file on your server, eg; http://yourdomain.com/beanstalk-slack.php See [Beanstalk Support](http://support.beanstalkapp.com/customer/portal/articles/75806-how-do-i-trigger-hooks-before-and-after-a-deployment-
) for directions. 
