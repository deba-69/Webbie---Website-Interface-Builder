function createNav ()
{
    let nav = document.querySelector('.navbar');

    nav.innerHTML = `
    <div class="nav">
        <img src="img/dark-logo.png" class="brand-logo" alt="">
        <div class="nav-items">
            <div class="search">
                <input type="text" class="search-box" placeholder="Type">
                <button class="search-btn">search</button>
            </div>
            <a>
            <img src="img/user.png" alt="" id="user-img">
            <div class="login-logout-popup hide">
                <p class="account-info">Log in as, name</p>
                <button class="btn" id="user-btn">Log Out</button> 
            </div>
            </a>
            <a href="cart.html"><img src="img/cart.png" alt=""></a><sup>5</sup>
        </div>
    
    </div>
    <ul class="links-container">
        <li class="list-item"><a href="index.html" class="link">home</a></li>
        <li class="list-item"><a href="search.html" class="link">Product</a></li>
        <li class="list-item"><a href="aboutUs.html" class="link">About Us</a></li>
        <li class="list-item"><a href="delivery.html" class="link">Delivery</a></li>
    </ul>`;
}

createNav();


const userImageBtn = document.querySelector('#user-img');
const userPop = document.querySelector('.login-logout-popup');
const popupText = document.querySelector('.account-info');
const actionBtn = document.querySelector('#user-btn');

userImageBtn.addEventListener('click', () => {
    userPop.classList.toggle('hide');
})


//search-box