const foot = document.querySelector('.footer-content');

function wRite()
{
    let footer = document.querySelector('footer');

    footer.innerHTML = `
    <div class="footer-content">
    <p class="logo" style="font-size: 100px; height: 100px; color: #fff; font-weight: 700; font-family: 'Brush Script MT', cursive;margin: auto;">Clothing</p>
    <div class="footer-ul-container">
        <ul class="category">
        <li><a href="#" class="footer-link">t-shirts</a></li>
        <li><a href="#" class="footer-link">jeans</a></li>
        <li><a href="#" class="footer-link">trousers</a></li>
        <li><a href="#" class="footer-link">sweatshirts</a></li>
        <li><a href="#" class="footer-link">shoes</a></li>
        <li><a href="#" class="footer-link">casuals</a></li>
        <li><a href="#" class="footer-link">formals</a></li>
        </ul>

        <ul class="category">
        <li><a href="#" class="footer-link">t-shirts</a></li>
        <li><a href="#" class="footer-link">jeans</a></li>
        <li><a href="#" class="footer-link">trousers</a></li>
        <li><a href="#" class="footer-link">sweatshirts</a></li>
        <li><a href="#" class="footer-link">shoes</a></li>
        <li><a href="#" class="footer-link">casuals</a></li>
        <li><a href="#" class="footer-link">formals</a></li>
        </ul>

    </div>
   </div>     `;
}

wRite();