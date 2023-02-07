<?php
/*$sites = [
 *   '8080.www.drupal.org.mysite.test' => 'example.com',
 * ];
 */
# make the root drupal site aware of site1 && site2:
$sites['multisite.domain1.com'] = 'domain1';//domain1 will be directory name which is in sites/domain1, domain1.com will be site name
$sites['multisite.domain2.com'] = 'domain2';
