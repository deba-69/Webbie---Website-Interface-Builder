const productImages = document.querySelectorAll(".product-images img");
const productImageSlide = document.querySelector('.image-slider');

let activeImageSlide = 0;
productImages.forEach((item,i) => {
    item.addEventListener('click', () => {
        productImages[activeImageSlide].classList.remove('active');
        item.classList.add('active');
        activeImageSlide = i;
        productImageSlide.style.backgroundImage = `url('${item.src}')`;

    })
})


// toggle

const sizeBtns = document.querySelectorAll('.size-radio-btn');
let checkedBtn = 0;

sizeBtns.forEach((item,i) => {
    item.addEventListener('click',() => {
        sizeBtns[checkedBtn].classList.remove('check');
        item.classList.add('check');
        checkedBtn = i;
    })
})

const setdata = (data) =>{
    let title = document.querySelector('title');
    title.innerHTML+=data.name;

    productImages.forEach((img,i) => {
        if(data.images[0]){
            img.src = data.images[i];
        }else{
            img.style.display = 'none';
        }
    })

    productImages[0].click();

    sizeBtns.forEach(item => {
        if(!data.sizes.includes(item.innerHTML)){
            item.style.display = 'none';
        }
    })

    const name = document.querySelector('.product-brand');
    const shortDes = document.querySelector('.product-short-des');
    const des = document.querySelector('.des');
    title.innerHTML += name.innerHTML = data.name;
    shortDes.innerHTML = data.shortDes;
    des.innerHTML = data.des;

    const sellPrice = document.querySelector('.product-price');


    //wishlist and cart button

    const wishlistBtn = document.querySelector('.wishlist-btn');
    wishlistBtn.addEventListener('click', () =>{
        wishlistBtn.innerHTML = add_product_to_cart_or_wishlist('wishlist',data);
    })

    const cartBtn = document.querySelector('.cart-btn');
    cartBtn.addEventListener('click', () =>{
        cartBtn.innerHTML = add_product_to_cart_or_wishlist('wishlist',data);
    })
    

} 