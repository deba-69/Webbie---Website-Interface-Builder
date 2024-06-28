//create small p-cards

const createSmallCards = (data) =>{
    return `
    <div class="sm-product">
        <img src="img/product image 1.png" alt="" class="sm-product-img">
        <div class="sm-text">
            <p class="sm-product-name">BRAND</p>
            <p class="sm-des">this is a short line about</p>
        </div>
        <div class="item-counter">
            <button class="counter-btn decrement">-</button>
            <p class="item-count">1</p>
            <button class="counter-btn increment">+</button>
        </div>
        <p class="sm-price">$20</p>
        <button class="sm-delete-btn"><img src="img/close.png" alt="" ></button>
    </div>    
    `;
}

const setProducts = (name) =>{


    setupEvents(name);
}

const updateBill = () =>{

}

const setupEvents = (name) =>{

    const counterMinus = document.querySelectorAll(`.${name} .decrement`);
    const counterPlus = document.querySelectorAll(`.${name} .increment`);
    const counts = document.querySelectorAll(`.${name} .item-count`);
    const price = document.querySelectorAll(`.${name} .sm-price`);
    const deleteBtn = document.querySelectorAll(`.${name} .sm-delete-btn`);

}