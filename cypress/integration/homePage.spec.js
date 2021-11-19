/// <reference types="cypress" />
describe('Loading main page', function(){
    it('1. Testing specific header', function(){
        cy.visit('/');
        cy.get('[data-cy="home_text"]').should('exist');
        cy.get('[data-cy="home_text"]').invoke('text').should('equal','Venta de casas y departamentos exclusivos de lujo');
    });
    it('2. Testing icon section', function(){
        cy.get('[data-cy="us_header"]').should('exist');
        cy.get('[data-cy="us_header"]').should('have.prop','tagName').should('equal','H2');
        //icons
        cy.get('[data-cy="us_icons"]').should('exist');
        cy.get('[data-cy="us_icons"]').find('.icono').should('have.length', 3);
    });
    it('3. Testing Property section', function(){
        cy.get('[data-cy="property_add"]').should('have.length',3);
        cy.get('[data-cy="property_add"]').should('not.have.length',5);

        //Testing the button and the link
        cy.get('[data-cy="property_link"]').should('have.class','boton-amarillo-block');
        cy.get('[data-cy="property_link"]').first().should('have.value','Ver propiedad');
        cy.get('[data-cy="property_link"]').first().click();
        cy.get('[data-cy="property-header"]').should('exist');
        // cy.wait(1000);
        cy.go('back');
    });
    it('4. Testing see all property button', function(){
        cy.get('[data-cy="seeAll_properties_btn"]').should('exist');
        cy.get('[data-cy="seeAll_properties_btn"]').should('have.class','boton-verde');
        cy.get('[data-cy="seeAll_properties_btn"]').invoke('attr','onclick').should('equal',"location.href='/propiedades?'");
        cy.get('[data-cy="seeAll_properties_btn"]').click();
        cy.get('[data-cy="properties_list"]').invoke('text').should('equal','Casas y departamentos en ventas');
        // cy.wait(1000);
        cy.go('back');
    });
    it('5. Contact_us', function(){
        cy.get('[data-cy="contact_section"]').should('exist');
        cy.get('[data-cy="contact_section"]').find('h2').invoke('text').should('equal','Encuentra la casa de tus sueños');
        cy.get('[data-cy="contact_section"]').find('p').invoke('text').should('equal','Llena el formulario de contacto y un asesor se pondrá en contacto contigo.');
        
        cy.get('[data-cy="contact_section"]').find('input').should('have.class','boton-amarillo');
        cy.get('[data-cy="contact_section"]').find('input').invoke('attr','onclick').should('equal',"location.href='/contacto?'")
        cy.get('[data-cy="contact_section"]').find('input').click();
        cy.get('[data-cy="contact_header"]').invoke('text').should('equal','Contacto');
        // cy.wait(1000);
        cy.go('back');
    });

    it('6. Blog section', function(){
        cy.get('[data-cy="blog_section"]').should('exist');
        cy.get('[data-cy="blog_section"]').find('h3').invoke('text').should('equal','Nuestro blog');
        cy.get('[data-cy="blog_section"]').find('img').should('have.length', 2);
        

        cy.get('[data-cy="testimonial_section"]').should('exist');
        cy.get('[data-cy="testimonial_section"]').find('h3').invoke('text').should('equal','Testimoniales');
        // cy.get('[data-cy="testimonial_section"]');
    });
});