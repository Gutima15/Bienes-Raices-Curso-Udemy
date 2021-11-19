/// <reference types="cypress" />
describe('Testing login page', function(){

    it('1. Testing wrong password',function(){
        cy.visit('/login');
        
        cy.get('[data-cy="heading-loading"]').should('exist').should('have.text', 'Iniciar sesión');
        cy.get('[data-cy="login-form"]').should('exist');


        cy.get('[data-cy="email-input"]').type('sample@sample.com').should('have.value', 'sample@sample.com');
        cy.get('[data-cy="password-input"]').type('Password1').should('have.value', 'Password1');
        
        cy.get('[data-cy="login-button"]').click();
        cy.get('[data-cy="alert-div"]').should('exist').should('have.class','alerta').and('have.class','error');
        cy.get('[data-cy="alert-div"]').invoke('text').should('equal','El usuario o contraseña es incorrecto');
        cy.get('[data-cy="alert-div"]').invoke('text').should('not.equal','La contraseña es incorrecta');
    });

    it('2. Testing wrong user',function(){
        
        cy.get('[data-cy="email-input"]').type('test@test.com').should('have.value', 'test@test.com');
        cy.get('[data-cy="password-input"]').type('sample1234').should('have.value', 'sample1234');
        
        cy.get('[data-cy="login-button"]').click();
        cy.get('[data-cy="alert-div"]').should('exist').should('have.class','alerta').and('have.class','error');
        cy.get('[data-cy="alert-div"]').invoke('text').should('equal','El usuario o contraseña es incorrecto');
        cy.get('[data-cy="alert-div"]').invoke('text').should('not.equal','El usuario es incorrecto');
    });

    it('2. Testing none inputs',function(){
        cy.get('[data-cy="login-button"]').click();
        cy.get('[data-cy="alert-div"]').eq(0).should('have.class','alerta').and('have.class','error').and('have.text','El email es obligatorio');
        cy.get('[data-cy="alert-div"]').eq(1).should('have.class','alerta').and('have.class','error').and('have.text','El password es obligatorio');
    });
});