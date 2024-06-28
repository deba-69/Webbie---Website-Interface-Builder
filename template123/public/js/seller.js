let loader = document.querySelector('.loader');

const becomeSellerElement = document.querySelector('.become-seller');
const productListingElement = document.querySelector('.product-listing');
const applyForm = document.querySelector('.apply-form');
const showApplyFormBtn = document.querySelector('#apply-btn');

window.onload = () => {
    becomeSellerElement.classList.remove('hide')
    
}
showApplyFormBtn.addEventListener('click', () => {
    becomeSellerElement.classList.add('hide');
    applyForm.classList.remove('hide');
})