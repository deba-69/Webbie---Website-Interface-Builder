const actualPrice = document.querySelector('#actual-price');
const discountPercentage = document.querySelector('#discount');
const sellingPrice = document.querySelector('#sell-price');

discountPercentage.addEventListener('input', () => {
    if(discountPercentage.value > 100)
    {
        discountPercentage.value = 90;
    }
    else
    {
        let discount  = actualPrice.value * discountPercentage.value / 100;
        sellingPrice.value = actualPrice.value - discount;
    }
})

sellingPrice.addEventListener('input', () => {
    let discount = (sellingPrice.value / actualPrice.value) * 100;
    discountPercentage.value = discount;
})

//upload image

let uploadImages = document.querySelectorAll('.fileupload');
let imagePaths = [];

const productName = document.querySelector('#product-name');
const shortLine = document.querySelector('#short-des');
const des = document.querySelector('#des');

let sizes = [];

const stock = document.querySelector('#stock');
const tags = document.querySelector('#tags');
const tac = document.querySelector('#tac');

const addProductBtn = document.querySelector('#add-btn');
const saveDraft = document.querySelector('#save_btn');

const showAlert = (mssg) =>{
    let alertBox = document.querySelector('.alert-box');
    let alertMssg = document.querySelector('.alert-msg');
    alertMssg.innerHTML = mssg;
    alertBox.classList.add('show');

    setTimeout(() => {
        alertBox.classList.remove('show');
    }, 3000);
    return false;
}

const storeSizes = () =>{
    sizes = [];
    let sizeCheckBox = document.querySelectorAll('.size-checkbox');
    sizeCheckBox.forEach(item =>{
        if(item.checked){
            sizes.push(item.value);
        } 
    })
}

const validateForm = () =>{
    if(!productName.value.length){
        return showAlert('enter product name');
    }else if(shortLine.value.length > 100 || shortLine.value.length <10){
        return showAlert('short dscription must be between 10 to 100 letters long');
    }else if(!des.value.length){
        return showAlert('enter detail description about the product');
    }else if(!imagePaths.lenth){
        return showAlert('upload atleast one product image');
    }else if(!sizes.length){
        return showAlert('select at least one size');
    }else if(!actualPrice.value.length || !discount.value.length || !sellingPrice.value.length){
        return showAlert('you must add pricings');
    }else if(stock.value < 20){
        return showAlert('you should have atleast 20 items in stock');
    }else if(!tags.value.length){
        return showAlert('enter few tags to help ranking your product in search');
    }else if(!tac.checked){
        return showAlert('you must agree to our terms and conditions');
    }
}

const productData = () =>{
    return data = {
        name: productName.value,
        shortDes: shortLine.value,
        des: des.value,
        images: imagePaths,
        sizes: sizes,
        actualPrice: actualPrice.value,
        discount: discountPercentage.value,
        sellPrice: sellingPrice.value,
        stock: stock.value,
        tags: tags.value,
        tac: tac.checked,
        email: user.email
    }
}
addProductBtn.addEventListener('click', () =>{
    storeSizes();

    if(validateForm()){
        //loader.style.display = 'block';
        let data = productData();

    }

})
