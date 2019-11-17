const anchors = document.querySelectorAll('a[href*="#"]')

for (let anchor of anchors) {
    anchor.addEventListener('click', function (e) {
        e.preventDefault()

        const blockID = anchor.getAttribute('href').substr(1)

        document.getElementById(blockID).scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        })
    })
}

const startBtn=document.querySelectorAll('#start');
for (let btn of startBtn){
    btn.addEventListener('click',function () {
        location.pathname='login/login.php'
    })
}

