function counter() {
    var x = document.getElementById('count');
    if(parseInt(x.innerHTML)<=0)
        location.href='../membership/login.php';
    else
        x.innerHTML = parseInt(x.innerHTML)-1;
}
setInterval(function(){counter();}, 1000);