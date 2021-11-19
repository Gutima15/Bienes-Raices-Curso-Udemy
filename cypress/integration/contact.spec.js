/// <reference types="cypress" />
describe('Testing Contact page form', function(){
    it('1. Contact page basics', function(){
        cy.visit('/contacto');
        cy.get('[data-cy="contact_header"]').should('exist');
        cy.get('[data-cy="contact_header"]').invoke('text').should('equal','Contacto')
        
        cy.get('[data-cy="contact_form_header"]').should('exist');
        cy.get('[data-cy="contact_form_header"]').invoke('text').should('equal','Llene el formulario de contacto')
    });

    it('2. Filling form', function(){
        cy.visit('/contacto');
        cy.get('[data-cy="name-input"]').type('Roberto Camacho');
        cy.get('[data-cy="mjs-input"]').type('Deseo comprar una casa en la zona de Heredia');        
        cy.get('[data-cy="compra_venta-select"]').select('Compra');
        cy.get('[data-cy="price-input"]').type('15000000');
        cy.get('[data-cy="contact-radio"]').eq(0).check();
        
        cy.get('[data-cy="phone-input"]').type('85774360');
        cy.get('[data-cy="date-input"]').type('2021-11-10');
        cy.get('[data-cy="time-input"]').type('12:30');

        cy.get('[data-cy="contact-form"]').submit();
        cy.get('[data-cy="alert-p"]').should('exist');
        cy.get('[data-cy="alert-p"]').invoke('text').should('equal','Mensaje enviado correctamente.');
        cy.get('[data-cy="alert-p"]').should('have.class','alerta').and('have.class','exito').and('not.have.class','error');
        



    });
});