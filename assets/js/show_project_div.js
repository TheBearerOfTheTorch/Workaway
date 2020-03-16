
//When review button is clicked it will hide the previous div and only show the review div
$("#director_all_jobs_link").click(function(){
    $("#All_project_container").toggle(1000);
    $("#review_project_container").hide(1000);
  });

//When review button is clicked it will hide the previous div and only show the review div
$("#review_all_work_link").click(function(){
   $("#review_project_container").toggle(1000);
    $("#All_project_container").hide(1000);
    
  });