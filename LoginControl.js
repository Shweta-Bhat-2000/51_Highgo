boolean static click_val = false
function change_text(){
    var name = document.getElementById('loginbtn')
	if (name.textContent == 'Login/Register') {
		document.getElementById('loginbtn').textContent = 'Logout'
		location.href = 'login.html'
		document.getElementById('loginbtn').href = 'login.html'
		click_val = true
	} 
	else {
		document.getElementById('loginbtn').textContent = 'Login/Register' 
		click_val = false
	}	
}