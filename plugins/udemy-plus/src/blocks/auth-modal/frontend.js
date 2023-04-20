document.addEventListener('DOMContentLoaded', () => {
    //select class open-modal
    const openModalBtn = document.querySelectorAll('.open-modal')
     //select class wp-block-udemy-plus-auth-modal
    const modalEl = document.querySelector('.wp-block-udemy-plus-auth-modal')
    const modalCloseEl = document.querySelectorAll(
        '.modal-overlay, .modal-btn-close'
    )

    // lopping through every element to listen for a click event
    openModalBtn.forEach((el) => {
        el.addEventListener('click', event => {
            event.preventDefault();
            // we opened the modal by adding a class that modifies the display property
            modalEl.classList.add('modal-show')
        })
    })

    modalCloseEl.forEach((el) => {
        el.addEventListener('click', event => {
            event.preventDefault();
            // we remove class
            modalEl.classList.remove('modal-show')
        })
    })

    //inside this element we are selecting the anchor elements which are the links for the tabs
    const tabs = document.querySelectorAll('.tabs a')
    const signinForm = document.querySelector('#signin-tab')
    const signupForm = document.querySelector('#signup-tab')

    //looping through the elements to apply click events
    tabs.forEach((tab) => {
        tab.addEventListener('click', event => {
            event.preventDefault()

            //passing a funtion to handle each iteration , we are going to refer to each item in the array as current tab
            //looping through the tabs to remove the active tab class
            tabs.forEach((currentTab) => {
                //the class can be removed by calling the current tab class list to remove function pass in the active tab class
                currentTab.classList.remove('active-tab')
            })

            //console.log(event.currentTarget) this property is an object for the element that triggered the event
            event.currentTarget.classList.add('active-tab')

            //getAttribute will grab any attributes value from an elenment
            const activeTab =  event.currentTarget.getAttribute('href')

            if(activeTab === '#signin-tab'){
                signinForm.style.display = 'block';
                signupForm.style.display = 'none';
            } else {
                signinForm.style.display = 'none';
                signupForm.style.display = 'block';
            }
        })
    })

    signupForm.addEventListener('submit', event => {
        event.preventDefault();

        //select from registration form fieldset
        const signupFieldset = signupForm.querySelector('fieldset')
        signupFieldset.setAttribute('disabled', true)

        const singupStatus = signupForm.querySelector('#signup-status')
        singupStatus.innerHTML = `
        <div class="modal-status modal-status-info">
            Please wait! We are creating your account.
        </div>
        `
    })
})