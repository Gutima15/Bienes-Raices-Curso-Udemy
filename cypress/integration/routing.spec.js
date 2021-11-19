/// <reference types="cypress" />
describe('Testing header & footer navigation', function(){
    it('1. Testing header',function(){
        cy.visit('/');
        cy.get('[data-cy="header-navigation"]').should('exist');
        cy.get('[data-cy="header-navigation"]').should('have.prop','class').should('equal','navegacion')
        cy.get('[data-cy="header-navigation"]').find('input').should('have.length',6);

        cy.get('[data-cy="header-navigation"]').find('input').eq(0).invoke('attr','onclick').should("equal","location.href='/'")
        cy.get('[data-cy="header-navigation"]').find('input').eq(1).invoke('attr','onclick').should("equal","location.href='/nosotros'")
        cy.get('[data-cy="header-navigation"]').find('input').eq(1).should('have.value','Nosotros');
        
        cy.get('[data-cy="header-navigation"]').find('input').eq(2).invoke('attr','onclick').should("equal","location.href='/propiedades'")
        cy.get('[data-cy="header-navigation"]').find('input').eq(2).should('have.value','Propiedades');
        
        cy.get('[data-cy="header-navigation"]').find('input').eq(3).invoke('attr','onclick').should("equal","location.href='/blog'")
        cy.get('[data-cy="header-navigation"]').find('input').eq(3).should('have.value','Blog');
        
        cy.get('[data-cy="header-navigation"]').find('input').eq(4).invoke('attr','onclick').should("equal","location.href='/contacto'")
        cy.get('[data-cy="header-navigation"]').find('input').eq(4).should('have.value','Contactos');
        
        var rightLink = cy.get('[data-cy="header-navigation"]').find('input').eq(5).invoke('attr','onclick').should("equal","location.href='/login'")
        var rightValue = cy.get('[data-cy="header-navigation"]').find('input').eq(5).should('have.value','¿Eres administrador?');
        if(rightLink && rightValue){ //Testing login.
            cy.get('[data-cy="header-navigation"]').find('input').eq(5).click();
            cy.get('[data-cy="email-input"]').type('sample@sample.com').should('have.value', 'sample@sample.com');
            cy.get('[data-cy="password-input"]').type('sample1234').should('have.value', 'sample1234');
            cy.get('[data-cy="login-button"]').click();
            cy.get('[data-cy="header-navigation"]').find('input').eq(0).invoke('attr','onclick').should("equal","location.href='/admin'");
            cy.get('[data-cy="header-navigation"]').find('input').eq(5).invoke('attr','onclick').should("equal","location.href='/sesionClose'");
            cy.get('[data-cy="header-navigation"]').find('input').eq(5).should('have.value','Cerrar sesión');
            cy.go('back');
            cy.go('back');
        }
    });
    it('2. Testing footer',function(){
        cy.get('[data-cy="footer-navigation"]').should('exist');
        cy.get('[data-cy="footer-navigation"]').find('input').should('have.length',4);

        cy.get('[data-cy="footer-navigation"]').find('input').eq(0).invoke('attr','onclick').should("equal","location.href='/nosotros'")
        cy.get('[data-cy="footer-navigation"]').find('input').eq(0).should('have.value','Nosotros');
        
        cy.get('[data-cy="footer-navigation"]').find('input').eq(1).invoke('attr','onclick').should("equal","location.href='/propiedades'")
        cy.get('[data-cy="footer-navigation"]').find('input').eq(1).should('have.value','Propiedades');
        
        cy.get('[data-cy="footer-navigation"]').find('input').eq(2).invoke('attr','onclick').should("equal","location.href='/blog'")
        cy.get('[data-cy="footer-navigation"]').find('input').eq(2).should('have.value','Blog');
        
        cy.get('[data-cy="footer-navigation"]').find('input').eq(3).invoke('attr','onclick').should("equal","location.href='/contacto'")
        cy.get('[data-cy="footer-navigation"]').find('input').eq(3).should('have.value','Contactos');
    });
});