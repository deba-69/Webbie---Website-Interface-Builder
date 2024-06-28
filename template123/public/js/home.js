//const setupSlidingEffect = () =>{
    const productContainers = [...document.querySelectorAll('.product-container')];
    const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
    const preBtn = [...document.querySelectorAll('.pre-btn')];
    //console.log(containerWidth);
    productContainers.forEach((item, i) => {
        let containerDimension = item.getBoundingClientRect();
        let containerWidth = containerDimension.width;
        console.log(containerWidth);

        nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
        })

        preBtn[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth;
        })
    })



const getProducts = (tag) => {

}

const createProductSlider = (data, parent, title) => {

    let slideContainer = document.querySelector('${parent}');
    slideContainer.innerHTML += `
    <section class="product">
        <h2 class="product-category">Shirts</h2>
        <button class="pre-btn"><img src="img/arrow.png" alt="na"></button>
        <button class="nxt-btn"><img src="img/arrow.png" alt="na"></button>
        ${createProductCards(data)}
    </section>
    `;
    setupSlidingEffect();
}

const createProductCards = (data,parent) =>{
    let start = '<div class="product-container">';
    let middle = '';
    let end = '</div>';
    
    for(let i=0;i<data.length;i++)
    {
        middle+= `<div class="product-card">
        <div class="product-image">
            <span class="discount-tag">50% off</span>
            <img src="img/card5.png" alt="" class="product-thumb">
            <button class="card-btn">add to wishlist</button>
        </div>
        <div class="product-info">
            <h2 class="product-brand">brand</h2>
            <p class="product-short-des"> a short line about...</p>
            <span class="price">$20</span>
            <span class="actual-price">$40</span>
        </div>
    </div>`;
    }

        return start + middle + end;
}

const add_product_to_cart_or_wishlist = (type, product) => {


    return 'Added';
}

