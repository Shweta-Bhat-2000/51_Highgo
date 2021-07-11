var navigation  = new Array();  // This is for the navigation.
// ==================== Navigation ==================== //
navigation[0]    = '<div id="cssmenu">';
navigation[1]    = '<ul>';
navigation[2]    = '<li><a href="../about/about_two_heart.html">About Two Hearts</a>';
navigation[3]    = '</li>';
navigation[4]   = '<li><a href="../about/about_our_partners.html" >About Our Partners</a></li>';
navigation[5]   = '</ul>';
navigation[6]   = '</div><!-- Close TAB NAVIGATION -->';

function show(i)
 {
  for (x in i)
  {
   document.write(i[x]+'\n')
  }
 }