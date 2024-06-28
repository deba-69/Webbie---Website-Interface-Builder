window.onload = () =>{


}

const getAddress = () =>{
    let address = document.querySelector('#address').value;
    let street = document.querySelector('#street').value;
    let city = document.querySelector('#city').value;
    let state = document.querySelector('#state').value;
    let pincode = document.querySelector('#pincode').value;
    let landmark = document.querySelector('#landmark').value;

    if(!address.length || !street.length || !city.length || !state.length || !pincode.length || !landmark.length)
    {
        showAlert('fill all the inputs first')
    }
    else{
        return {address, street, city, state, pincode, landmark};
    }
}