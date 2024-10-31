<?php
/*
Plugin Name:Related Post By Tag
Plugin URI: http://plugins.svn.wordpress.org/related-post-by-tag/
Description:Returns a list of the related Post based on Tag. 
Author: Gaurav Kumar
Version: 1
Author URI:http://www.linkedin.com/in/gkumar25 
*/

global $tags, $tag_query;

function related_by_tag_widget() {

     if (have_posts()) : 
               while (have_posts()) : the_post(); 
   
          $posttags =get_the_tags();
          $i=0; 
           if ($posttags  ) {
                  foreach($posttags as $key=> $tag) {
                                 
                     $tags[$i] =$tag->name;
                     $i++;                   
              }
           }
   
            endwhile; 
     endif; 

     get_post_by_tag($tags);
}

function init_related_by_tag(){
	register_sidebar_widget("Post By Tag", "related_by_tag_widget");
}

        add_action("plugins_loaded", "init_related_by_tag");

   function get_post_by_tag($tags)
    {
       $show_tags_or =join(",",$tags);
       $tag_query='tag='.$show_tags_or.'';
       query_posts($tag_query);
       show_post_by_tag();    

     }  

function show_post_by_tag(){
     include('related-post-by-tag-layout.php'); 
}
?>





