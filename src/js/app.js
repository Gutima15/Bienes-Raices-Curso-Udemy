document.addEventListener('DOMContentLoaded',function(){
    eventListeners();
    darkMode();
})

function eventListeners(){
    const mobileMenu= document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navResponsive);

    //showing conditional radiobuttons results
    const contactMethod = document.querySelectorAll('input[name="contact[contact_radio]"]')
    contactMethod.forEach(function(input){
        input.addEventListener('click',showContactMethod);
    });
}

function navResponsive(){
    const nav = document.querySelector('.navegacion');
    // if(nav.classList.contains('mostrar')){
    //     nav.classList.remove('mostrar');
    // }else{
    //     nav.classList.add('mostrar');
    // } todo lo de arriba se traduce en un toggle
    nav.classList.toggle('mostrar');
}

function darkMode(){
    const darkModePreference = window.matchMedia('(prefers-color-scheme: dark)');
    if(darkModePreference.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }

    darkModePreference.addEventListener('change', function(){
        if(darkModePreference.matches){
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    })

    const darkModeButton = document.querySelector('.dark-mode-button');
    darkModeButton.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    })
}

function showContactMethod(event) {
        const contactDiv = document.querySelector('#contact');
        if(event.target.value === 'télefono'){
            contactDiv.innerHTML = `
                <label for="numTe">Número</label>
                <input data-cy="phone-input" type="tel" name="contact[phone]" id="phone" placeholder="Tu teléfono">
                <p>Elija la fecha y hora para ser contactado</p>
                <label for="fecha">Fecha de contacto</label>
                <input data-cy="date-input" type="date" name="contact[date]" id="fecha">
                <label for="hora">Hora</label>
                <input data-cy="time-input" type="time" name="contact[hour]" id="hora" min="09:00" max="18:00">
            `;
        } else {
            contactDiv.innerHTML = `
                <label for="nameEm">E-mail</label>
                <input data-cy="email-input" type="email" name="contact[email]" id="email" placeholder="Tu email" required>
            `;
        }
}
