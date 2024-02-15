<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BO. Magazine</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    color: #000;
    font-family: sans-serif;
    letter-spacing: 1px;
    font-weight: 300;
}
body{
    overflow-x: hidden;
}

nav{
    height: 6rem;
    width: 100vw;
    background-color: #131418;
    display: flex;
    position: relative;
    background: #fff;
}

.logo {
    display: block;
    position: absolute;
    cursor: pointer;
    left: 5%;
    top: 55%;
    transform: translate(-5%, -50%);
}

.logo img {
            max-width: 65px;
        }


/*Styling Hamburger Icon*/
.hamburger div{
    width: 30px;
    height:3px;
    background: #231815;
    margin: 5px;
    transition: all 0.3s ease;
}
.hamburger{
    display:block;
    position: absolute;
    cursor: pointer;
    right: 5%;
    top: 50%;
    transform: translate(-5%, -50%);
    z-index: 2;
    transition: all 0.7s ease;
}

/*Stying for small screens*/
.nav-links{
    position: fixed;
    background: #fff;
    height: 100vh;
    width: 100%;
    flex-direction: column;
    clip-path: circle(50px at 90% -20%);
    -webkit-clip-path: circle(50px at 90% -10%);
    transition: all 1s ease-out;
    pointer-events: none;
    padding-top: 150px;
}
.nav-links.open{
    clip-path: circle(1000px at 90% -10%);
    -webkit-clip-path: circle(1000px at 90% -10%);
    pointer-events: all;
}
.nav-links li{
    opacity: 0;
    text-align: center;
    padding-bottom: 50px;
}
.nav-links li a {
    text-decoration: none;
    margin: 0 0.7vw;
    font-size: 20px;
    font-weight: 400;
}
.nav-links li:nth-child(1){
    transition: all 0.5s ease 0.2s;
}
.nav-links li:nth-child(2){
    transition: all 0.5s ease 0.4s;
}
.nav-links li:nth-child(3){
    transition: all 0.5s ease 0.6s;
}
.nav-links li:nth-child(4){
    transition: all 0.5s ease 0.7s;
}
.nav-links li:nth-child(5){
    transition: all 0.5s ease 0.8s;
}
.nav-links li:nth-child(6){
    transition: all 0.5s ease 0.9s;
}
.nav-links li:nth-child(7){
    transition: all 0.5s ease 1s;
}
li.fade{
    opacity: 1;
}

/*Animating Hamburger Icon on Click*/
.toggle .line1{
    transform: rotate(-45deg) translate(-5px,6px);
}
.toggle .line2{
    opacity: 0;
}
.toggle .line3{
    transform: rotate(45deg) translate(-5px,-6px);
}

@media screen and (min-width: 768px) {
    nav {
        width: 433px;
    }

    .nav-links {
        position : inherit;
        height : 130vh;
    }

    .nav-links.open {
    -webkit-clip-path: circle(1020px at 90% -10%);
    }
}

    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="/"><img src="/img/로고.png" alt="BO. Magazine Logo"></a>
            </div>
            <div class="hamburger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Magazine</a></li>
                <li><a href="#">Issues</a></li>
                <li><a href="#">063Diary</a></li>
                <li><a href="/contact">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <script>
        // 햄버거 메뉴 클릭 시 애니메이션
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");
        const links = document.querySelectorAll(".nav-links li");

        hamburger.addEventListener('click', ()=>{
           // Links 애니메이션
            navLinks.classList.toggle("open");
            links.forEach(link => {
                link.classList.toggle("fade");
            });

            // 햄버거 애니메이션
            hamburger.classList.toggle("toggle");
        });
    </script>
</body>
</html>
