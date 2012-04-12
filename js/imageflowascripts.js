jQuery(document).ready(function(){
jQuery('#imgFlowCont li span').css('display','none');
jQuery('.quest').toggle(function(){
jQuery('.flists span:visible').slideUp('slow');
jQuery(this).parent().find('span').slideDown('slow');
return false;
}, 
function(){
jQuery(this).parent().find('span').slideUp('slow');
});
});