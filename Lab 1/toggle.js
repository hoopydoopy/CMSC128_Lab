function showPassword(){
    var password = document.querySelector('[name=password]');

    
    if(password.getAttribute('type')==='password'){

        password.setAttribute('type', 'text');
        document.getElementById("font").style.color='white';

    }else{

        password.setAttribute('type', 'password');
        document.getElementById("font").style.color='black';

    }
}