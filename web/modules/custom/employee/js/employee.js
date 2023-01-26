(function($, Drupal, drupalSettings){
    'use strict';
    //JQuery.ready can run only once when the DOM is loaded and digging every time from the very beginning.
    $(document).ready(function(){
       //alert('Hello');
    });
    //Drupal.behaviors can be run multiple times during page execution. Moreover, they can be run 
    //whenever a new element gets introduced into the document (i.e. during AJAX content loading).
    // So, the advantage of Drupal behaviors over the document.ready() is that they are automatically 
    //re-applied to any content which is loaded through AJAX.
    Drupal.behaviors.Employee = {
        attach: function(context, settings){
          var current_user_name = drupalSettings.employee.current_user;
          console.log(current_user_name);     
        }
    };
})(jQuery, Drupal, drupalSettings)